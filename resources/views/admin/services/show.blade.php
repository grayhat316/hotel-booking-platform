@extends('layouts.admin')

@section('title', $service->name)

@section('services_active', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-concierge-bell me-2"></i>Service Details</h5>
                <div>
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit me-1"></i> Edit</a>
                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this service?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash me-1"></i> Delete</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 mb-3">
                        @if($service->image)
                            <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="img-fluid rounded w-100" style="object-fit: cover; max-height: 300px;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 200px;">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-7">
                        <h3 class="mb-3">{{ $service->name }}</h3>
                        <table class="table table-borderless">
                            <tr>
                                <th class="text-muted" width="120">Type</th>
                                <td><span class="badge bg-info fs-6">{{ $service->type ?? 'N/A' }}</span></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Capacity</th>
                                <td>{{ $service->capacity ? $service->capacity . ' people' : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Price</th>
                                <td class="fs-5 fw-bold text-success">${{ number_format($service->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Created</th>
                                <td>{{ $service->created_at?->format('M d, Y') }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Updated</th>
                                <td>{{ $service->updated_at?->format('M d, Y') }}</td>
                            </tr>
                        </table>
                        @if($service->description)
                        <div class="mt-3">
                            <h6 class="text-muted">Description</h6>
                            <p>{{ $service->description }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Back to Services</a>
            </div>
        </div>
    </div>
</div>
@endsection
