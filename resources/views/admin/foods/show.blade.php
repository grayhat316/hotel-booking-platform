@extends('layouts.admin')

@section('title', $food->name)

@section('foods_active', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-utensils me-2"></i>Food Details</h5>
                <span class="badge bg-secondary">ID: {{ $food->id }}</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 text-center mb-3 mb-md-0">
                        @if($food->image)
                            <img src="{{ image_url($food->image) }}" alt="{{ $food->name }}" class="img-fluid rounded shadow-sm" style="max-height:250px;object-fit:cover;width:100%;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height:200px;">
                                <i class="fas fa-image fa-4x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-7">
                        <h4 class="mb-3">{{ $food->name }}</h4>
                        <table class="table table-borderless">
                            <tr>
                                <th class="text-muted" width="100">Category</th>
                                <td><span class="badge bg-secondary">{{ $food->category ?? 'Uncategorized' }}</span></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Price</th>
                                <td class="fw-bold text-success">${{ number_format($food->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Description</th>
                                <td>{{ $food->description ?? 'No description' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Added</th>
                                <td>{{ $food->created_at->format('M d, Y') }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Updated</th>
                                <td>{{ $food->updated_at->format('M d, Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.foods.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <div>
                    <a href="{{ route('admin.foods.edit', $food->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.foods.destroy', $food->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this food item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 @endsection
