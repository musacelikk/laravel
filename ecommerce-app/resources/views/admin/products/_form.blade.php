@php $product = $product ?? null; @endphp

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="title">Title *</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $product?->title) }}" required>
            @error('title')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="category_id">Category * (One-to-Many)</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                <option value="">Select category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product?->category_id) == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                @endforeach
            </select>
            @error('category_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $product?->slug) }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="keywords">Keywords</label>
            <input type="text" name="keywords" id="keywords" class="form-control" value="{{ old('keywords', $product?->keywords) }}">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description">Description *</label>
    <textarea name="description" id="description" class="form-control summernote @error('description') is-invalid @enderror" required>{{ old('description', $product?->description) }}</textarea>
    @error('description')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
</div>

<div class="form-group">
    <label for="detail">Detail</label>
    <textarea name="detail" id="detail" class="form-control summernote">{{ old('detail', $product?->detail) }}</textarea>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="price">Price *</label>
            <input type="number" step="0.01" min="0" name="price" id="price" class="form-control" value="{{ old('price', $product?->price) }}" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="compare_price">Compare Price</label>
            <input type="number" step="0.01" min="0" name="compare_price" id="compare_price" class="form-control" value="{{ old('compare_price', $product?->compare_price) }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="quantity">Quantity *</label>
            <input type="number" min="0" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $product?->quantity ?? 50) }}" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="status">Status *</label>
            <select name="status" id="status" class="form-control" required>
                <option value="active" {{ old('status', $product?->status ?? 'active') === 'active' ? 'selected' : '' }}>True</option>
                <option value="inactive" {{ old('status', $product?->status) === 'inactive' ? 'selected' : '' }}>False</option>
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="image">Main Image Upload {{ $product ? '' : '*' }}</label>
    <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*" {{ $product ? '' : 'required' }}>
    @error('image')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
    @if ($product?->imageUrl())
        <img src="{{ $product->imageUrl() }}" alt="" class="mt-2 img-thumbnail" style="max-height:100px;">
    @endif
</div>

<div class="form-group">
    <label for="gallery">Image Gallery (multiple upload)</label>
    <input type="file" name="gallery[]" id="gallery" class="form-control-file" accept="image/*" multiple>
    <small class="text-muted">Select multiple images for product gallery.</small>
</div>

@if ($product && $product->images->isNotEmpty())
    <div class="form-group">
        <label>Current Gallery</label>
        <div class="row">
            @foreach ($product->images as $galleryImage)
                <div class="col-md-2 text-center mb-2">
                    <img src="{{ $galleryImage->imageUrl() }}" class="img-thumbnail w-100" style="height:70px;object-fit:cover;">
                    <form action="{{ route('admin.catalog.products.images.destroy', [$product, $galleryImage]) }}" method="POST" class="mt-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-danger">Remove</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" name="brand" id="brand" class="form-control" value="{{ old('brand', $product?->brand ?? 'E-SHOP') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="rating">Rating</label>
            <input type="number" min="1" max="5" name="rating" id="rating" class="form-control" value="{{ old('rating', $product?->rating ?? 5) }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="review_count">Reviews</label>
            <input type="number" min="0" name="review_count" id="review_count" class="form-control" value="{{ old('review_count', $product?->review_count ?? 0) }}">
        </div>
    </div>
</div>

<div class="form-group">
    <div class="custom-control custom-checkbox custom-control-inline">
        <input type="checkbox" class="custom-control-input" id="is_new" name="is_new" value="1" {{ old('is_new', $product?->is_new) ? 'checked' : '' }}>
        <label class="custom-control-label" for="is_new">New</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline">
        <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product?->is_featured) ? 'checked' : '' }}>
        <label class="custom-control-label" for="is_featured">Featured</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline">
        <input type="checkbox" class="custom-control-input" id="is_deal" name="is_deal" value="1" {{ old('is_deal', $product?->is_deal) ? 'checked' : '' }}>
        <label class="custom-control-label" for="is_deal">On Sale</label>
    </div>
</div>
