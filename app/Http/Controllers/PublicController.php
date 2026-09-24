<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Food;
use App\Models\Service;
use App\Models\Gallery;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $rooms = Room::take(3)->get();
        $foods = Food::take(4)->get();
        $services = Service::take(3)->get();
        $gallery = Gallery::take(6)->get();

        return view('public.home', compact('rooms', 'foods', 'services', 'gallery'));
    }

    public function rooms()
    {
        $rooms = Room::all();
        return view('public.rooms', compact('rooms'));
    }

    public function roomShow(Room $room)
    {
        $relatedRooms = Room::where('id', '!=', $room->id)->limit(3)->get();
        return view('public.rooms-show', compact('room', 'relatedRooms'));
    }

    public function dining()
    {
        $foods = Food::all();
        return view('public.dining', compact('foods'));
    }

    public function conference()
    {
        $services = Service::where('type', 'conferencing')->get();
        return view('public.conference', compact('services'));
    }

    public function events()
    {
        $services = Service::where('type', 'event')->get();
        return view('public.events', compact('services'));
    }

    public function gallery()
    {
        $gallery = Gallery::all();
        return view('public.gallery', compact('gallery'));
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // In production, you'd send an email here
        // For now, just redirect back with a success message
        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}