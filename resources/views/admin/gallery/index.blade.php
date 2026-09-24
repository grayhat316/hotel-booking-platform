@extends('layouts.admin')

@section('title', 'Gallery Management')

@section('gallery_active', 'active')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gallery Management</h2>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add New Gallery Item
    </a>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($galleryItems->count() > 0)
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($galleryItems as $item)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if($item->image)
                        <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($item->description, 100) }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.gallery.show', $item->id) }}" class="btn btn-info btn-sm text-white">Show</a>
                        <div>
                            <a href="{{ route('admin.gallery.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this gallery item?');">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-5">
        <h4 class="text-muted">No gallery items found.</h4>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary mt-3">Add Your First Gallery Item</a>
    </div>
@endif
@endsection
