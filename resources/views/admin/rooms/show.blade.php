@extends('layouts.admin')

@section('title', 'Room Details')

@section('rooms_active', 'active')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-eye me-2"></i> Room Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        @if($room->image)
                            <img src="{{ asset($room->image) }}" alt="{{ $room->name }}" class="img-fluid rounded mb-3" style="width: 100%; max-height: 300px; object-fit: cover;">
                        @else
                            <div class="bg-light text-center p-5 rounded mb-3">
                                <i class="fas fa-image fa-3x text-muted"></i>
                                <p class="text-muted mt-2">No image available</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-7">
                        <table class="table table-borderless">
                            <tr>
                                <th width="120"><i class="fas fa-hashtag me-1"></i> ID</th>
                                <td>{{ $room->id }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-tag me-1"></i> Name</th>
                                <td>{{ $room->name }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-align-left me-1"></i> Description</th>
                                <td>{{ $room->description }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-dollar-sign me-1"></i> Price</th>
                                <td>${{ number_format($room->price, 2) }} per night</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-users me-1"></i> Capacity</th>
                                <td>{{ $room->capacity }} guests</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-calendar-plus me-1"></i> Created</th>
                                <td>{{ $room->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-calendar-check me-1"></i> Updated</th>
                                <td>{{ $room->updated_at->format('M d, Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to Rooms
                </a>
                <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i> Edit Room
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
