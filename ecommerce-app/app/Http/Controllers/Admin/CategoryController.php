<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::query()->withCount('products')->orderBy('title')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.create', [
            'categories' => Category::query()->orderBy('title')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'parent_id' => ['nullable', 'integer', 'min:0'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'keywords' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $validated['parent_id'] = $validated['parent_id'] ?? 0;
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category,
            'categories' => Category::query()->where('id', '!=', $category->id)->orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'parent_id' => ['nullable', 'integer', 'min:0'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug,'.$category->id],
            'keywords' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $validated['parent_id'] = $validated['parent_id'] ?? 0;
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->products()->exists()) {
            return back()->with('error', 'Cannot delete category with existing products.');
        }

        if ($category->children()->exists()) {
            return back()->with('error', 'Cannot delete category with subcategories.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
