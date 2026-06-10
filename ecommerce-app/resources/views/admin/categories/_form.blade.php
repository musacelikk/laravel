@php $category = $category ?? null; @endphp

<div class="form-group">
    <label for="title">Title *</label>
    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $category?->title) }}" required>
    @error('title')<span class="invalid-feedback">{{ $message }}</span>@enderror
</div>

<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $category?->slug) }}" placeholder="Auto-generated from title if empty">
    @error('slug')<span class="invalid-feedback">{{ $message }}</span>@enderror
</div>

<div class="form-group">
    <label for="parent_id">Parent Category</label>
    <select name="parent_id" id="parent_id" class="form-control">
        <option value="0" {{ old('parent_id', $category?->parent_id ?? 0) == 0 ? 'selected' : '' }}>None (Top Level)</option>
        @foreach ($categories as $parent)
            @if (!$category || $parent->id !== $category->id)
                <option value="{{ $parent->id }}" {{ old('parent_id', $category?->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->title }}</option>
            @endif
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="keywords">Keywords</label>
    <input type="text" name="keywords" id="keywords" class="form-control" value="{{ old('keywords', $category?->keywords) }}" placeholder="fashion, clothing, women">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $category?->description) }}</textarea>
</div>

<div class="form-group">
    <label for="image">Image URL</label>
    <input type="url" name="image" id="image" class="form-control" value="{{ old('image', $category?->image) }}" placeholder="https://images.unsplash.com/...">
</div>

<div class="form-group">
    <label for="status">Status *</label>
    <select name="status" id="status" class="form-control" required>
        <option value="active" {{ old('status', $category?->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ old('status', $category?->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
