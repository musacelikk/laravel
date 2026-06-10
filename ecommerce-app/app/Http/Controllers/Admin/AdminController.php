<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Faq;
use App\Models\Message;
use App\Models\Product;
use App\Models\Social;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $products = Product::query()->with('category')->latest()->take(5)->get();

        return view('admin.dashboard', [
            'productCount' => Product::count(),
            'categoryCount' => Category::count(),
            'totalStock' => Product::sum('quantity'),
            'featuredCount' => Product::where('is_featured', true)->count(),
            'products' => $products,
        ]);
    }

    public function comments(): View
    {
        return view('admin.comments.index', [
            'comments' => Comment::query()->with(['product', 'user'])->latest()->get(),
        ]);
    }

    public function faq(): View
    {
        return view('admin.faq.index', [
            'faqs' => Faq::query()->latest()->get(),
        ]);
    }

    public function messages(): View
    {
        return view('admin.messages.index', [
            'messages' => Message::query()->latest()->get(),
        ]);
    }

    public function users(): View
    {
        return view('admin.users.index', [
            'users' => User::query()->with('roles')->latest()->get(),
        ]);
    }

    public function social(): View
    {
        return view('admin.social.index', [
            'socials' => Social::query()->latest()->get(),
        ]);
    }

}
