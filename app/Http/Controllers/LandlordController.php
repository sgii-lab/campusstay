<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\PropertyRequest;

class LandlordController extends Controller
{
    public function index()
    {
        $properties = Auth::user()->properties;
        $notifications = Auth::user()->notifications; // all notifications
        $unread = Auth::user()->unreadNotifications; // only unread    

        return view('landlord.dashboard', compact('properties', 'notifications', 'unread'));
    }

    public function create()
    {
        return view('landlord.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('image')?->store('properties', 'public');

        Auth::user()->properties()->create([
            'title' => $request->title,
            'location' => $request->location,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('landlord.dashboard')->with('success', 'Property submitted!');
    }

    public function approveRequest($id)
    {
        $request = PropertyRequest::findOrFail($id);
        $request->status = 'approved';
        $request->save();
    
        return back()->with('success', 'Request approved!');
    }
    
    public function rejectRequest($id)
    {
        $request = PropertyRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();
    
        return back()->with('success', 'Request rejected!');
    }
    


    public function edit(Property $property)
    {
        return view('landlord.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $property->update($request->only('title','location','price','description'));
        return redirect()->route('landlord.dashboard')->with('success', 'Property updated!');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('landlord.dashboard')->with('success', 'Property deleted!');
    }

}
