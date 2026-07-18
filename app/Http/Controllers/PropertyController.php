<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Notifications\PropertyLiked;
use App\Notifications\PropertyRequested;
use App\Models\PropertyRequest;

class PropertyController extends Controller
{
    use AuthorizesRequests;

    // Homepage: show approved properties only
    public function index(Request $request)
    {
        $query = Property::query();

        $student = auth()->user();

        if ($student && $student->school_location) {
            $query->where('location', 'like', '%' . $student->school_location . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $query->where('status', 'approved');

        $properties = $query->latest()->paginate(10);

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

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('properties', 'public');
        }

        Auth::user()->properties()->create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'price' => $request->price,
            'image' => $path,
            'status' => 'pending',
            'landlord_id' => auth()->id, // ✅ fixed
        ]);

        return redirect()->route('landlord.dashboard')
            ->with('success', 'Listing submitted!');
    }

    public function edit(Property $property)
    {
        return view('landlord.edit-property', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
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
        $property->delete();
        return redirect()->route('landlord.dashboard')->with('success','Listing deleted!');
    }

    public function studentDashboard()
    {
        $requests = PropertyRequest::where('student_id', auth()->id())
            ->with('property')
            ->get();

        return view('student.dashboard', compact('requests'));
    }

    public function likedProperties()
    {
        $properties = Auth::user()->likedProperties;
        return view('student.likes', compact('properties'));
    }

    public function propertyRequests()
    {
        $requests = Auth::user()->propertyRequests()->with('property')->get();
        return view('student.requests', compact('requests'));
    }

    public function likeProperty(Property $property)
    {
        $property->landlord->notify(new PropertyLiked($property, Auth::user()));

        Auth::user()->likedProperties()->syncWithoutDetaching([$property->id]); // ✅ use property not method
        return back()->with('success', 'Property liked!');
    }

    public function requestProperty(Property $property)
    {
        $request = PropertyRequest::create([
            'property_id' => $property->id,
            'student_id' => auth()->id,
            'status' => 'pending',
        ]);

        $property->landlord->notify(new PropertyRequested($property, auth()->user()));

        return back()->with('success', 'Request submitted!');
    }
}
