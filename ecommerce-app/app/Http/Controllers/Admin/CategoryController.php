<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\ImageUploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(private ImageUploader $uploader) {}

    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::query()->withCount('products')->orderBy('id')->paginate(10),
            'categoryTree' => Category::tree(),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.create', [
            'parentOptions' => Category::flatTree(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCategory($request);

        $validated['parent_id'] = $validated['parent_id'] ?? 0;
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploader->upload($request->file('image'), 'categories');
        }

        Category::create($validated);

        return redirect()->route('admin.catalog.categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category): View
    {
        $category->load(['parent', 'children', 'products']);

        return view('admin.categories.show', [
            'category' => $category,
        ]);
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category,
            'parentOptions' => Category::flatTree($category->id),
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $this->validateCategory($request, $category);

        $validated['parent_id'] = $validated['parent_id'] ?? 0;
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $this->uploader->delete($category->image);
            $validated['image'] = $this->uploader->upload($request->file('image'), 'categories');
        }

        $category->update($validated);

        return redirect()->route('admin.catalog.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->products()->exists()) {
            return back()->with('error', 'Cannot delete category with existing products.');
        }

        if ($category->children()->exists()) {
            return back()->with('error', 'Cannot delete category with subcategories.');
        }

        $this->uploader->delete($category->image);
        $category->delete();

        return redirect()->route('admin.catalog.categories.index')->with('success', 'Category deleted successfully.');
    }

    private function validateCategory(Request $request, ?Category $category = null): array
    {
        $slugRule = 'nullable|string|max:255|unique:categories,slug';
        if ($category) {
            $slugRule .= ','.$category->id;
        }

        $imageRule = $category ? 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';

        return $request->validate([
            'parent_id' => ['nullable', 'integer', 'min:0'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [$slugRule],
            'keywords' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => [$imageRule],
            'status' => ['required', 'in:active,inactive'],
        ]);
    }
}
