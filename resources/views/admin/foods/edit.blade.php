@extends('layouts.admin')

@section('title', 'Edit Food Item')

@section('foods_active', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Food Item</h5>
                <span class="text-muted small">ID: {{ $food->id }}</span>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.foods.update', $food->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $food->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $food->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $food->price) }}" required>
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category', $food->category) }}" placeholder="e.g., Main Course, Dessert, Drink">
                            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        @if($food->image)
                        <div class="mb-2">
                            <img src="{{ image_url($food->image) }}" alt="{{ $food->name }}" class="rounded" width="100" height="100" style="object-fit:cover;">
                            <div class="form-text">Current image</div>
                        </div>
                        @endif
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text">Upload a new image to replace. Max 2MB. JPEG, PNG, GIF, JPG.</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-gold">
                            <i class="fas fa-save me-1"></i> Update Food Item
                        </button>
                        <a href="{{ route('admin.foods.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                        <form action="{{ route('admin.foods.destroy', $food->id) }}" method="POST" class="ms-auto" onsubmit="return confirm('Delete this food item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 @endsection
