@extends('layouts.admin')

@section('title', 'Edit Service')

@section('services_active', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Service: {{ $service->name }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" id="serviceForm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="name" class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $service->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="type" class="form-label fw-bold">Type</label>
                            <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $service->type) }}" placeholder="e.g., Spa, Dining, Conference">
                            @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $service->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="capacity" class="form-label fw-bold">Capacity</label>
                            <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity', $service->capacity) }}" min="0">
                            @error('capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-bold">Price ($) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $service->price) }}" required min="0">
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Image</label>
                        <div class="mb-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="image_source" id="image_source_upload" value="upload" checked>
                                <label class="form-check-label" for="image_source_upload">Upload File</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="image_source" id="image_source_url" value="url">
                                <label class="form-check-label" for="image_source_url">Paste URL</label>
                            </div>
                        </div>
                        <div id="upload_section">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div id="url_section" style="display: none;">
                            <input type="text" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url" value="{{ old('image_url', $service->image_url) }}" placeholder="https://example.com/image.jpg">
                            @error('image_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        @if($service->image)
                        <div class="mt-2">
                            <small class="text-muted">Current image:</small>
                            <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="img-thumbnail mt-1" style="max-height: 100px;">
                        </div>
                        @endif
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-gold"><i class="fas fa-save me-1"></i> Update Service</button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary"><i class="fas fa-times me-1"></i> Cancel</a>
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
        const uploadRadio = document.getElementById('image_source_upload');
        const urlRadio = document.getElementById('image_source_url');
        const uploadSection = document.getElementById('upload_section');
        const urlSection = document.getElementById('url_section');

        function toggleImageSource() {
            if (urlRadio.checked) {
                uploadSection.style.display = 'none';
                urlSection.style.display = 'block';
            } else {
                uploadSection.style.display = 'block';
                urlSection.style.display = 'none';
            }
        }

        uploadRadio.addEventListener('change', toggleImageSource);
        urlRadio.addEventListener('change', toggleImageSource);
    });
</script>
@endpush
