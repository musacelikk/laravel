<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::query()->with('category')->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'categories' => Category::query()->where('status', 'active')->orderBy('title')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['brand'] = $validated['brand'] ?? 'E-SHOP';
        $validated['is_new'] = $request->boolean('is_new');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_deal'] = $request->boolean('is_deal');
        $validated['rating'] = $validated['rating'] ?? 5;
        $validated['review_count'] = $validated['review_count'] ?? 0;

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::query()->where('status', 'active')->orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $this->validateProduct($request, $product);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['brand'] = $validated['brand'] ?? 'E-SHOP';
        $validated['is_new'] = $request->boolean('is_new');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_deal'] = $request->boolean('is_deal');

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    private function validateProduct(Request $request, ?Product $product = null): array
    {
        $slugRule = 'nullable|string|max:255|unique:products,slug';
        if ($product) {
            $slugRule .= ','.$product->id;
        }

        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [$slugRule],
            'keywords' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'detail' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'compare_price' => ['nullable', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'image' => ['required', 'string', 'max:500'],
            'brand' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:active,inactive'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'review_count' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
