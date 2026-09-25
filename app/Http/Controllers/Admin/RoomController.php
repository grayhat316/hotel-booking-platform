<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url|max:2048',
        ]);

        $data = $request->all();

        if ($request->has('image_url') && $request->input('image_url')) {
            $data['image'] = $request->input('image_url');
        } elseif ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/rooms'), $imageName);
            $data['image'] = 'uploads/rooms/' . $imageName;
        }

        unset($data['image_url']);
        unset($data['image_type']);

        Room::create($data);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url|max:2048',
        ]);

        $data = $request->all();

        if ($request->has('image_url') && $request->input('image_url')) {
            $data['image'] = $request->input('image_url');
        } elseif ($request->hasFile('image')) {
            // Delete old local image if exists
            if ($room->image && !str_starts_with($room->image, 'http') && file_exists(public_path($room->image))) {
                unlink(public_path($room->image));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/rooms'), $imageName);
            $data['image'] = 'uploads/rooms/' . $imageName;
        } else {
            unset($data['image']);
        }

        unset($data['image_url']);
        unset($data['image_type']);

        $room->update($data);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        if ($room->image && !str_starts_with($room->image, 'http') && file_exists(public_path($room->image))) {
            unlink(public_path($room->image));
        }
        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room deleted successfully.');
    }
}