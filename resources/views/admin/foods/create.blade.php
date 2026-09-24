@extends('layouts.admin')

@section('title', 'Add Food Item')

@section('foods_active', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Add New Food Item</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/foods') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price (KES) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category') }}" placeholder="e.g., Main Course, Dessert, Drink">
                            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <div class="d-flex mb-3">
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="image_type" id="typeUpload" value="upload" checked>
                                <label class="btn btn-outline-primary" for="typeUpload">
                                    <i class="fas fa-upload me-1"></i> Upload File
                                </label>
                                <input type="radio" class="btn-check" name="image_type" id="typeUrl" value="url">
                                <label class="btn btn-outline-primary" for="typeUrl">
                                    <i class="fas fa-link me-1"></i> Paste URL
                                </label>
                            </div>
                        </div>
                        <div id="uploadSection">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            <small class="text-muted">Upload JPEG, PNG, GIF, or JPG (max 2MB).</small>
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div id="urlSection" style="display: none;">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                <input type="url" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url" placeholder="https://example.com/image.jpg" value="{{ old('image_url') }}">
                            </div>
                            <small class="text-muted">Paste a full URL (e.g., from Unsplash, Google Images).</small>
                            @error('image_url') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-gold">
                            <i class="fas fa-save me-1"></i> Save Food Item
                        </button>
                        <a href="{{ url('admin/foods') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeUpload = document.getElementById('typeUpload');
        const typeUrl = document.getElementById('typeUrl');
        const uploadSection = document.getElementById('uploadSection');
        const urlSection = document.getElementById('urlSection');

        typeUpload.addEventListener('change', function() {
            if (this.checked) {
                uploadSection.style.display = 'block';
                urlSection.style.display = 'none';
            }
        });

        typeUrl.addEventListener('change', function() {
            if (this.checked) {
                uploadSection.style.display = 'none';
                urlSection.style.display = 'block';
            }
        });
    });
</script>
@endpush
