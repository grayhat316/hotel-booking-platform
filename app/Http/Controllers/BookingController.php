<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Room $room)
    {
        return view('public.booking', compact('room'));
    }

    public function store(Request $request, Room $room)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'required|string|max:20',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:' . $room->capacity,
            'special_requests' => 'nullable|string|max:500',
        ]);

        $checkIn = \Carbon\Carbon::parse($request->check_in);
        $checkOut = \Carbon\Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->price * $nights;

        $booking = Booking::create([
            'room_id' => $room->id,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'guest_phone' => $request->guest_phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
            'nights' => $nights,
            'total_price' => $totalPrice,
            'special_requests' => $request->special_requests,
            'status' => 'pending',
        ]);

        return redirect(url('/booking/confirmation/' . $booking->id))
            ->with('success', 'Your booking request has been submitted successfully!');
    }

    public function confirmation(Booking $booking)
    {
        return view('public.booking-confirmation', compact('booking'));
    }

    public function index()
    {
        $bookings = Booking::with('room')->latest()->get();
        return view('public.bookings', compact('bookings'));
    }
}
