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
    <label for="parent_id">Parent Category (Sub Category)</label>
    <select name="parent_id" id="parent_id" class="form-control">
        <option value="0" {{ old('parent_id', $category?->parent_id ?? 0) == 0 ? 'selected' : '' }}>None (Top Level)</option>
        @foreach ($parentOptions as $option)
            <option value="{{ $option['id'] }}" {{ old('parent_id', $category?->parent_id) == $option['id'] ? 'selected' : '' }}>{{ $option['title'] }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="keywords">Keywords</label>
    <input type="text" name="keywords" id="keywords" class="form-control" value="{{ old('keywords', $category?->keywords) }}" placeholder="Computer Books, Php, Basic Python">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control summernote">{{ old('description', $category?->description) }}</textarea>
</div>

<div class="form-group">
    <label for="image">Image Upload</label>
    <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*">
    @error('image')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
    @if ($category?->imageUrl())
        <img src="{{ $category->imageUrl() }}" alt="" class="mt-2 img-thumbnail" style="max-height:100px;">
    @endif
</div>

<div class="form-group">
    <label for="status">Status *</label>
    <select name="status" id="status" class="form-control" required>
        <option value="active" {{ old('status', $category?->status ?? 'active') === 'active' ? 'selected' : '' }}>True (Active)</option>
        <option value="inactive" {{ old('status', $category?->status) === 'inactive' ? 'selected' : '' }}>False (Inactive)</option>
    </select>
</div>
