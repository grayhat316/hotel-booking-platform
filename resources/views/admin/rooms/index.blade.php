@extends('layouts.admin')

@section('title', 'Rooms Management')

@section('rooms_active', 'active')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="fas fa-bed me-2"></i> Rooms Management</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Create New Room
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Capacity</th>
                    <th>Image</th>
                    <th width="180px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rooms as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td>{{ $room->name }}</td>
                        <td>${{ number_format($room->price, 2) }}</td>
                        <td>{{ $room->capacity }}</td>
                        <td>
                            @if($room->image)
                                <img src="{{ asset($room->image) }}" alt="{{ $room->name }}" class="img-thumbnail" width="80" height="80" style="object-fit: cover;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.rooms.show', $room->id) }}" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this room?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No rooms found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
