@extends('layouts.admin')

@section('title', 'Gallery Item Details')

@section('gallery_active', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Gallery Item Details</h4>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary btn-sm">Back to Gallery</a>
            </div>
            <div class="card-body">
                @if($gallery->image)
                    <div class="text-center mb-4">
                        <img src="{{ image_url($gallery->image) }}" alt="{{ $gallery->title }}" class="img-fluid rounded" style="max-height: 400px;">
                    </div>
                @else
                    <div class="text-center mb-4 bg-light rounded py-5">
                        <span class="text-muted">No image available</span>
                    </div>
                @endif>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 150px;">Title</th>
                            <td>{{ $gallery->title }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $gallery->description }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $gallery->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $gallery->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex gap-2">
                <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-primary">Edit Gallery Item</a>
                <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this gallery item?');">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
