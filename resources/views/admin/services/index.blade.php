@extends('layouts.admin')

@section('title', 'Services Management')

@section('services_active', 'active')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-concierge-bell me-2"></i>Services</h5>
        <a href="{{ route('admin.services.create') }}" class="btn btn-gold btn-sm">
            <i class="fas fa-plus me-1"></i> Create Service
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Price</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->name }}</td>
                        <td><span class="badge bg-info">{{ $service->type ?? 'N/A' }}</span></td>
                        <td>{{ $service->capacity ?? 'N/A' }}</td>
                        <td>${{ number_format($service->price, 2) }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.services.show', $service->id) }}" class="btn btn-sm btn-outline-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this service?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No services found. <a href="{{ route('admin.services.create') }}">Create one</a>.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
