<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class PropertyController extends Controller
{

    use AuthorizesRequests;
    // Homepage: show approved properties
    public function index()
    {
        $properties = Property::where('status', 'approved')->latest()->get();
        return view('home', compact('properties'));
    }

    // Landlord dashboard
    public function dashboard()
    {
        $properties = Auth::user()->properties;
        return view('landlord.dashboard', compact('properties'));
    }

    // Show create form
    public function create()
    {
        return view('landlord.create-property');
    }

    // Store new property
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:2048',

        ]);

        // Safely handle image
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')?->store('properties', 'public');
        }
        
    
        Auth::user()->properties()->create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'price' => $request->price,
            'image' => $path, // will be null if no image uploaded.
            'status' => 'pending',
            'landlord_id' => auth()->id(), //  make sure this is set
        ]);
        

        // $path = $request->file('image')?->store('properties', 'public');
        // Auth::user()->properties()->create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'location' => $request->location,
        //     'price' => $request->price,
        //     'image' => $path,
        //     'status' => 'pending',
        // ]);

    
        return redirect()->route('landlord.dashboard')
            ->with('success', 'Listing submitted!');
    }

    public function edit(Property $property)
    {
        //$this->authorize('update', $property); // optional: ensure landlord owns it
        return view('landlord.edit-property', compact('property'));
    }
    
    public function update(Request $request, Property $property)
    {
        //$this->authorize('update', $property);
    
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('title','description','location','price');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('properties', 'public');
        }

    
        $property->update($data);
    
        return redirect()->route('landlord.dashboard')->with('success','Listing updated!');
    }
    
    public function destroy(Property $property)
    {
        //$this->authorize('delete', $property);
        $property->delete();
    
        return redirect()->route('landlord.dashboard')->with('success','Listing deleted!');
    }
    
}
