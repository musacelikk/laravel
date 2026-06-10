<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('store.pages.about', [
            'setting' => Setting::query()->first(),
            'recentMessages' => Message::query()->latest()->take(5)->get(),
        ]);
    }

    public function contact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Message::create([
            'name' => trim($validated['first_name'].' '.$validated['last_name']),
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => 'Contact Form',
            'message' => $validated['message'],
            'ip' => $request->ip(),
            'status' => 'new',
        ]);

        return redirect()->to(route('pages.about').'#contact')->with('success', 'Mesajınız alındı. En kısa sürede dönüş yapacağız.');
    }

    public function faq(): View
    {
        return view('store.pages.faq', [
            'faqs' => Faq::query()->where('status', 'active')->orderBy('id')->get(),
        ]);
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
