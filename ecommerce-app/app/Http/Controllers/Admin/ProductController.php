<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\ImageUploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(private ImageUploader $uploader) {}

    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::query()->with('category')->latest()->paginate(10),
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

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploader->upload($request->file('image'), 'products');
        }

        $product = Product::create($validated);
        $this->storeGalleryImages($request, $product);

        return redirect()->route('admin.catalog.products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product): View
    {
        $product->load(['category', 'images']);

        return view('admin.products.show', [
            'product' => $product,
        ]);
    }

    public function edit(Product $product): View
    {
        $product->load('images');

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

        if ($request->hasFile('image')) {
            $this->uploader->delete($product->image);
            $validated['image'] = $this->uploader->upload($request->file('image'), 'products');
        }

        $product->update($validated);
        $this->storeGalleryImages($request, $product);

        return redirect()->route('admin.catalog.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->uploader->delete($product->image);

        foreach ($product->images as $image) {
            $this->uploader->delete($image->image);
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.catalog.products.index')->with('success', 'Product deleted successfully.');
    }

    public function destroyImage(Product $product, ProductImage $productImage): RedirectResponse
    {
        if ($productImage->product_id !== $product->id) {
            abort(404);
        }

        $this->uploader->delete($productImage->image);
        $productImage->delete();

        return back()->with('success', 'Gallery image removed.');
    }

    private function storeGalleryImages(Request $request, Product $product): void
    {
        if (! $request->hasFile('gallery')) {
            return;
        }

        foreach ($request->file('gallery') as $file) {
            $path = $this->uploader->upload($file, 'products/gallery');

            $product->images()->create([
                'title' => $product->title,
                'image' => $path,
            ]);
        }
    }

    private function validateProduct(Request $request, ?Product $product = null): array
    {
        $slugRule = 'nullable|string|max:255|unique:products,slug';
        if ($product) {
            $slugRule .= ','.$product->id;
        }

        $imageRule = $product
            ? 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            : 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048';

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
            'image' => [$imageRule],
            'gallery.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'brand' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:active,inactive'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'review_count' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
