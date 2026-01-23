<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers  = User::count();
        $totalAds    = Ad::count();
        $pendingAds  = Ad::pending()->count();
        $approvedAds = Ad::approved()->count();
        $rejectedAds = Ad::rejected()->count();

        $recentUsers    = User::latest()->take(5)->get();
        $recentAds      = Ad::with('user')->latest()->take(5)->get();
        $pendingAdsList = Ad::with('user')->pending()->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAds',
            'pendingAds',
            'approvedAds',
            'rejectedAds',
            'recentUsers',
            'recentAds',
            'pendingAdsList'
        ));
    }
}
