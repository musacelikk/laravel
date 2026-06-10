<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'reviewer_name' => [Auth::check() ? 'nullable' : 'required', 'string', 'max:100'],
            'reviewer_email' => ['nullable', 'email', 'max:255'],
            'rate' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'max:2000'],
        ]);

        Comment::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'reviewer_name' => $validated['reviewer_name'] ?? Auth::user()?->name,
            'reviewer_email' => $validated['reviewer_email'] ?? Auth::user()?->email,
            'rate' => $validated['rate'],
            'comment' => $validated['comment'],
            'ip' => $request->ip(),
            'status' => 'active',
        ]);

        $product->syncReviewStats();

        return redirect()
            ->to(route('products.show', $product).'#reviews')
            ->with('success', 'Thank you! Your review has been published.');
    }
}
