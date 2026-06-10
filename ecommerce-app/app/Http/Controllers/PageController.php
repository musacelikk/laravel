<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('store.pages.about');
    }

    public function faq(): View
    {
        return view('store.pages.faq');
    }

    public function newsletter(): View
    {
        return view('store.pages.newsletter');
    }

    public function subscribe(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
