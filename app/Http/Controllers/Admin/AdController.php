<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdStatus;
use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Notifications\AdStatusChangedNotification;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ad::with('user');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('firstname', 'like', "%{$search}%")
                            ->orWhere('lastname', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $ads = $query->latest()->paginate(20)->withQueryString();
        $statuses = AdStatus::options();

        return view('admin.ads.index', compact('ads', 'statuses'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ad $ad)
    {
        $ad->load(['user', 'reviewer']);

        return view('admin.ads.show', compact('ad'));
    }

    /**
     * Approve the specified ad.
     */
    public function approve(Ad $ad)
    {
        $ad->approve(auth()->user());
        $ad->user->notify(new AdStatusChangedNotification($ad));

        return back()->with('status', 'Oglas uspješno odobren.');
    }

    /**
     * Reject the specified ad.
     */
    public function reject(Request $request, Ad $ad)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $ad->reject(auth()->user(), $validated['rejection_reason']);
        $ad->user->notify(new AdStatusChangedNotification($ad));

        return back()->with('status', 'Oglas odbijen.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ad $ad)
    {
        $ad->delete();

        return redirect()->route('admin.ads.index')
            ->with('status', 'Oglas uspješno obrisan.');
    }
}
