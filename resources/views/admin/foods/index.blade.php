@extends('layouts.admin')

@section('title', 'Dining / Foods')

@section('foods_active', 'active')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-utensils me-2"></i>Food Items</h5>
        <a href="{{ route('admin.foods.create') }}" class="btn btn-gold btn-sm">
            <i class="fas fa-plus me-1"></i> Add Food Item
        </a>
    </div>
    <div class="card-body">
        @if($foods->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($foods as $food)
                    <tr>
                        <td>{{ $food->id }}</td>
                        <td>
                            @if($food->image)
                                <img src="{{ $food->image_url }}" alt="{{ $food->name }}" class="rounded" width="60" height="60" style="object-fit:cover;">
                            @else
                                <span class="text-muted"><i class="fas fa-image fa-2x"></i></span>
                            @endif
                        </td>
                        <td><strong>{{ $food->name }}</strong></td>
                        <td><span class="badge bg-secondary">{{ $food->category }}</span></td>
                        <td>${{ number_format($food->price, 2) }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.foods.show', $food->id) }}" class="btn btn-outline-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.foods.edit', $food->id) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.foods.destroy', $food->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this food item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5 text-muted">
            <i class="fas fa-utensils fa-3x mb-3"></i>
            <p>No food items yet. <a href="{{ route('admin.foods.create') }}">Add your first food item</a>.</p>
        </div>
        @endif
    </div>
</div>
 @endsection
