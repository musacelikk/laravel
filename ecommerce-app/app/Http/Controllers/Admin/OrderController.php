<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()
            ->with('user')
            ->withCount('orderProducts')
            ->latest()
            ->paginate(15);

        return view('admin.orders.index', [
            'orders' => $orders,
            'totalCount' => Order::count(),
            'approvedCount' => Order::where('status', Order::STATUS_APPROVED)->count(),
            'pendingCount' => Order::where('status', Order::STATUS_PENDING)->count(),
            'cancelledCount' => Order::where('status', Order::STATUS_CANCELLED)->count(),
        ]);
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'orderProducts.product']);

        return view('admin.orders.show', [
            'order' => $order,
        ]);
    }

    public function accept(Order $order): RedirectResponse
    {
        if (! $order->isPending()) {
            return back()->with('error', 'Only pending orders can be accepted.');
        }

        $order->update(['status' => Order::STATUS_APPROVED]);

        return back()->with('success', 'Order #'.$order->id.' has been approved.');
    }

    public function cancel(Order $order): RedirectResponse
    {
        if (! $order->isPending()) {
            return back()->with('error', 'Only pending orders can be cancelled.');
        }

        DB::transaction(function () use ($order): void {
            $order->load('orderProducts.product');

            foreach ($order->orderProducts as $line) {
                if ($line->product) {
                    $line->product->increment('quantity', $line->amount);
                }
            }

            $order->update(['status' => Order::STATUS_CANCELLED]);
        });

        return back()->with('success', 'Order #'.$order->id.' has been rejected.');
    }
}
