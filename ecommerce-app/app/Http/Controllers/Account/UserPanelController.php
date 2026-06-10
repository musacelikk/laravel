<?php

namespace App\Http\Controllers\Account;

use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserPanelController extends Controller
{
    public function profile(): View
    {
        return view('store.account.profile', [
            'user' => auth()->user(),
        ]);
    }

    public function updateProfile(Request $request, UpdateUserProfileInformation $updater): RedirectResponse
    {
        $updater->update($request->user(), $request->all());

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request, UpdateUserPassword $updater): RedirectResponse
    {
        $updater->update($request->user(), $request->all());

        return back()->with('success', 'Password updated successfully.');
    }

    public function orders(): View
    {
        return view('store.account.orders', [
            'orders' => auth()->user()->orders()->with('orderProducts.product')->latest()->get(),
        ]);
    }

    public function reviews(): View
    {
        return view('store.account.reviews', [
            'reviews' => Comment::query()
                ->where('user_id', auth()->id())
                ->with('product')
                ->latest()
                ->get(),
        ]);
    }

    public function destroyReview(Comment $comment): RedirectResponse
    {
        abort_unless($comment->user_id === auth()->id(), 403);

        $product = $comment->product;
        $comment->delete();

        if ($product) {
            $product->syncReviewStats();
        }

        return redirect()
            ->route('account.reviews')
            ->with('success', 'Review deleted successfully.');
    }

    public function products(): View
    {
        return view('store.account.products', [
            'products' => Product::query()
                ->where('user_id', auth()->id())
                ->with('category')
                ->latest()
                ->get(),
        ]);
    }
}
