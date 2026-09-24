@extends('layouts.admin')

@section('title', 'Bookings Management')
@section('bookings_active', 'active')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="fas fa-calendar-check me-2"></i>Bookings Management</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ url('/admin/bookings') }}" class="btn btn-secondary">
            <i class="fas fa-sync-alt me-1"></i>Refresh
        </a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Guest</th>
                        <th>Room</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Guests</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th width="250">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->guest_name ?? 'N/A' }}</td>
                        <td>{{ $booking->room ? $booking->room->name : 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</td>
                        <td>{{ $booking->guests }}</td>
                        <td>KES {{ number_format($booking->total_price, 0) }}</td>
                        <td>
                            <span class="badge {{ $booking->status === 'confirmed' ? 'bg-success' : ($booking->status === 'pending' ? 'bg-warning text-dark' : ($booking->status === 'cancelled' ? 'bg-danger' : 'bg-info')) }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ url('/admin/bookings/' . $booking->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form action="{{ url('/admin/bookings/' . $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="check_in" value="{{ \Carbon\Carbon::parse($booking->check_in)->format('Y-m-d') }}">
                                            <input type="hidden" name="check_out" value="{{ \Carbon\Carbon::parse($booking->check_out)->format('Y-m-d') }}">
                                            <input type="hidden" name="guests" value="{{ $booking->guests }}">
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit" class="dropdown-item text-warning"><i class="fas fa-circle fa-xs"></i> Set Pending</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ url('/admin/bookings/' . $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="check_in" value="{{ \Carbon\Carbon::parse($booking->check_in)->format('Y-m-d') }}">
                                            <input type="hidden" name="check_out" value="{{ \Carbon\Carbon::parse($booking->check_out)->format('Y-m-d') }}">
                                            <input type="hidden" name="guests" value="{{ $booking->guests }}">
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="dropdown-item text-success"><i class="fas fa-circle fa-xs"></i> Set Confirmed</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ url('/admin/bookings/' . $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="check_in" value="{{ \Carbon\Carbon::parse($booking->check_in)->format('Y-m-d') }}">
                                            <input type="hidden" name="check_out" value="{{ \Carbon\Carbon::parse($booking->check_out)->format('Y-m-d') }}">
                                            <input type="hidden" name="guests" value="{{ $booking->guests }}">
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="dropdown-item text-danger"><i class="fas fa-circle fa-xs"></i> Set Cancelled</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ url('/admin/bookings/' . $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="check_in" value="{{ \Carbon\Carbon::parse($booking->check_in)->format('Y-m-d') }}">
                                            <input type="hidden" name="check_out" value="{{ \Carbon\Carbon::parse($booking->check_out)->format('Y-m-d') }}">
                                            <input type="hidden" name="guests" value="{{ $booking->guests }}">
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="dropdown-item text-info"><i class="fas fa-circle fa-xs"></i> Set Completed</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">No bookings found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
