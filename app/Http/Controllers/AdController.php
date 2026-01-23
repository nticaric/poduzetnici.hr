<?php
namespace App\Http\Controllers;

use App\Enums\AdStatus;
use App\Enums\UserRole;
use App\Models\Ad;
use App\Models\User;
use App\Notifications\NewAdSubmittedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::active()->latest()->paginate(12);

        return view('ads.index', compact('ads'));
    }

    public function create()
    {
        return view('ads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'type'              => 'required|in:offer,demand',
            'category'          => 'required|string|in:Prodaja poslovanja,Partnerstva,Oprema i alati,Usluge,Oglasni prostor,Pitanja i odgovori',
            'location'          => 'required|string|max:255',
            'price'             => 'nullable|numeric|min:0',
            'duration_days'     => 'required|integer|in:7,14,30',
            'is_anonymous'      => 'nullable|boolean',
            'uploaded_images'   => 'nullable|array|max:5',
            'uploaded_images.*' => 'url',
        ]);

        $slug = Str::slug($validated['title']) . '-' . uniqid();

        $images = $request->input('uploaded_images', []);

        $ad = $request->user()->ads()->create([
            'title'         => $validated['title'],
            'slug'          => $slug,
            'description'   => $validated['description'],
            'images'        => $images,
            'type'          => $validated['type'],
            'category'      => $validated['category'],
            'location'      => $validated['location'],
            'price'         => $validated['price'] ?? null,
            'duration_days' => $validated['duration_days'],
            'expires_at'    => now()->addDays((int) $validated['duration_days']),
            'is_anonymous'  => $request->boolean('is_anonymous'),
            'status'        => AdStatus::Pending,
        ]);

        // Notify all admins about the new ad
        $admins = User::where('role', UserRole::Admin)->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewAdSubmittedNotification($ad));
        }

        return redirect()->route('ads.index')->with('status', 'Oglas je uspješno kreiran i čeka odobrenje administratora.');
    }

    public function show($id)
    {
        if (is_numeric($id)) {
            $ad = Ad::findOrFail($id);
        } else {
            $ad = Ad::where('slug', $id)->firstOrFail();
        }

        // Only show approved ads to non-owners and non-admins
        if (!$ad->isApproved()) {
            if (!auth()->check() || (auth()->id() !== $ad->user_id && !auth()->user()->isAdmin())) {
                abort(404);
            }
        }

        // Increment view count (don't count owner's views)
        if (!auth()->check() || auth()->id() !== $ad->user_id) {
            $ad->incrementViews();
        }

        return view('ads.show', compact('ad'));
    }

    public function edit($id)
    {
        $ad = Ad::findOrFail($id);

        if (auth()->id() !== $ad->user_id) {
            abort(403);
        }

        return view('ads.edit', compact('ad'));
    }

    public function update(Request $request, $id)
    {
        $ad = Ad::findOrFail($id);

        if (auth()->id() !== $ad->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'type'              => 'required|in:offer,demand',
            'category'          => 'required|string|in:Prodaja poslovanja,Partnerstva,Oprema i alati,Usluge,Oglasni prostor,Pitanja i odgovori',
            'price'             => 'nullable|numeric|min:0',
            'is_anonymous'      => 'nullable|boolean',
            'uploaded_images'   => 'nullable|array|max:5',
            'uploaded_images.*' => 'url',
            'existing_images'   => 'nullable|array',
        ]);

        $images = array_merge(
            $request->input('existing_images', []),
            $request->input('uploaded_images', [])
        );

        // If the ad was rejected, set it back to pending for re-review
        $newStatus = $ad->isRejected() ? AdStatus::Pending : $ad->status;

        $ad->update([
            'title'        => $validated['title'],
            'description'  => $validated['description'],
            'type'         => $validated['type'],
            'category'     => $validated['category'],
            'price'        => $validated['price'],
            'is_anonymous' => $request->boolean('is_anonymous'),
            'images'       => array_slice($images, 0, 5),
            'status'       => $newStatus,
        ]);

        // If ad was re-submitted for review, notify admins
        if ($newStatus === AdStatus::Pending && $ad->wasChanged('status')) {
            $admins = User::where('role', UserRole::Admin)->get();
            foreach ($admins as $admin) {
                $admin->notify(new NewAdSubmittedNotification($ad));
            }
        }

        return redirect()->route('ads.show', $ad->id)->with('status', 'Oglas uspješno ažuriran!');
    }

    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);

        if (auth()->id() !== $ad->user_id) {
            abort(403);
        }

        $ad->delete();

        return redirect()->route('dashboard')->with('status', 'Oglas uspješno obrisan!');
    }
}
