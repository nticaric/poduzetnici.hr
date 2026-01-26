<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $ads = Ad::active()->latest()->get();
        $profiles = User::where('is_public', true)->whereNotNull('slug')->get();

        $content = view('sitemap', compact('ads', 'profiles'))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
