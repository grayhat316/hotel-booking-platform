<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::all();
        return view('admin.foods.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.foods.create');
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
            'category' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
        ]);

        $data = $request->only(['name', 'description', 'price', 'category', 'image']);

        // Priority: file upload over URL
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/foods'), $imageName);
            $data['image'] = 'uploads/foods/' . $imageName;
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->input('image_url');
        } else {
            $data['image'] = null;
        }

        Food::create($data);

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return view('admin.foods.show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        return view('admin.foods.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
        ]);

        $data = $request->only(['name', 'description', 'price', 'category']);

        // Priority: file upload over URL
        if ($request->hasFile('image')) {
            // Delete old file-based image if exists
            if ($food->image && !str_starts_with($food->image, 'http') && file_exists(public_path($food->image))) {
                unlink(public_path($food->image));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/foods'), $imageName);
            $data['image'] = 'uploads/foods/' . $imageName;
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->input('image_url');
        } elseif ($request->has('image_url') && $request->input('image_url') === null) {
            // image_url explicitly cleared
            $data['image'] = null;
        } else {
            // Neither provided, keep existing
            $data['image'] = $food->image;
        }

        $food->update($data);

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        if ($food->image && !str_starts_with($food->image, 'http') && file_exists(public_path($food->image))) {
            unlink(public_path($food->image));
        }
        $food->delete();

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food item deleted successfully.');
    }
}
