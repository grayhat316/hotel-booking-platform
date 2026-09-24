
@extends('layouts.admin')

@section('title', 'Create Room')

@section('rooms_active', 'active')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-plus-circle me-2"></i> Create New Room</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('admin/rooms') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="fas fa-tag me-1"></i> Room Name
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left me-1"></i> Description
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">
                            <i class="fas fa-dollar-sign me-1"></i> Price (per night)
                        </label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="capacity" class="form-label">
                            <i class="fas fa-users me-1"></i> Capacity
                        </label>
                        <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity') }}" required>
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-image me-1"></i> Room Image
                        </label>
                        
                        <!-- Toggle Switch -->
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

                        <!-- Upload Input -->
                        <div id="uploadSection">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            <small class="text-muted">Upload a JPEG, PNG, GIF, or JPG file (max 2MB).</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- URL Input -->
                        <div id="urlSection" style="display: none;">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                <input type="url" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url" placeholder="https://example.com/image.jpg" value="{{ old('image_url') }}">
                            </div>
                            <small class="text-muted">Paste a full URL (e.g., from Unsplash, Google Images).</small>
                            @error('image_url')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Room
                        </button>
                        <a href="{{ url('admin/rooms') }}" class="btn btn-secondary">
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
