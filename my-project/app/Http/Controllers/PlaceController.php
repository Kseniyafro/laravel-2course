<?php
namespace App\Http\Controllers;

use App\Models\Place;          
use Illuminate\Http\Request;   
use Illuminate\Support\Facades\Auth;  

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::orderBy('id', 'desc')->get();
        return view('place.index', ['places' => $places]);
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('place.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $request->validate([
            'name' => 'required|min:3',       
            'description' => 'max:500',         
        ]);
        
        $place = new Place;
        
        $place->name = $request->name;
        $place->description = $request->description;

        $place->repair = $request->has('repair') && $request->repair == 'on';
        $place->work = $request->has('work') && $request->work == 'on';
        
        $place->save();

        return redirect()->route('places.index');
    }

    public function show(Place $place)
    {
        return view('place.show', ['place' => $place]);
    }

    public function edit(Place $place)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('place.edit', ['place' => $place]);
    }

    public function update(Request $request, Place $place)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'max:500',
        ]);
        
        $place->name = $request->name;
        $place->description = $request->description;
        
        $place->repair = $request->has('repair') && $request->repair == 'on';
        $place->work = $request->has('work') && $request->work == 'on';
        
        $place->save();
        
        return redirect()->route('places.show', ['place' => $place->id]);
    }

    public function destroy(Place $place)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $place->delete();
        
        return redirect()->route('places.index');
    }
}