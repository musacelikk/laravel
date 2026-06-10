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

    public function orders(): View
    {
        return view('admin.orders', [
            'orders' => $this->mockOrders(),
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
            'users' => User::query()->latest()->get(),
        ]);
    }

    public function social(): View
    {
        return view('admin.social.index', [
            'socials' => Social::query()->latest()->get(),
        ]);
    }

    private function mockOrders(): array
    {
        return [
            ['id' => 'ORD-1042', 'customer' => 'Ayşe Yılmaz', 'email' => 'ayse@mail.com', 'total' => 156.49, 'status' => 'Completed', 'status_class' => 'success', 'date' => '10 Jun 2026', 'items' => 3],
            ['id' => 'ORD-1041', 'customer' => 'Mehmet Kaya', 'email' => 'mehmet@mail.com', 'total' => 89.00, 'status' => 'Processing', 'status_class' => 'warning', 'date' => '09 Jun 2026', 'items' => 1],
            ['id' => 'ORD-1040', 'customer' => 'Zeynep Demir', 'email' => 'zeynep@mail.com', 'total' => 234.50, 'status' => 'Shipped', 'status_class' => 'info', 'date' => '08 Jun 2026', 'items' => 4],
            ['id' => 'ORD-1039', 'customer' => 'Can Öztürk', 'email' => 'can@mail.com', 'total' => 42.00, 'status' => 'Pending', 'status_class' => 'secondary', 'date' => '07 Jun 2026', 'items' => 1],
            ['id' => 'ORD-1038', 'customer' => 'Elif Arslan', 'email' => 'elif@mail.com', 'total' => 318.99, 'status' => 'Completed', 'status_class' => 'success', 'date' => '06 Jun 2026', 'items' => 5],
            ['id' => 'ORD-1037', 'customer' => 'Burak Şahin', 'email' => 'burak@mail.com', 'total' => 64.00, 'status' => 'Cancelled', 'status_class' => 'danger', 'date' => '05 Jun 2026', 'items' => 1],
        ];
    }
}
