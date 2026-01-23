<?php

namespace App\Http\Controllers;

use App\Models\Thing;      
use Illuminate\Http\Request;   
use Illuminate\Support\Facades\Auth;  

class ThingController extends Controller
{
    public function index()
    {
        $things = Thing::orderBy('id', 'desc')->get();
        return view('thing.index', ['things' => $things]);
    }

    public function create()
    {
        return view('thing.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',   
            'description' => 'max:500', 
            'wrnt' => 'date',     
        ]);

        $thing = new Thing;
    
        $thing->name = $request->name;
        $thing->description = $request->description;
        $thing->wrnt = $request->wrnt;
        
        $thing->master = Auth::id();
        $thing->save();

        return redirect()->route('things.index');
    }

    public function show(Thing $thing)
    {
        return view('thing.show', ['thing' => $thing]);
    }

    public function edit(Thing $thing)
    {
        if ($thing->master !== Auth::id()) {
            return redirect()->route('things.index');
        }
        return view('thing.edit', ['thing' => $thing]);
    }

    public function update(Request $request, Thing $thing)
    {
        if ($thing->master !== Auth::id()) {
            return redirect()->route('things.index');
        }
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'max:500',
            'wrnt' => 'date',
        ]);
        
        $thing->name = $request->name;
        $thing->description = $request->description;
        $thing->wrnt = $request->wrnt;
        
        $thing->save();
        
        return redirect()->route('things.show', ['thing' => $thing->id]);
    }

    public function destroy(Thing $thing)
    {
        if ($thing->master !== Auth::id()) {
            return redirect()->route('things.index');
        }
        
        $thing->delete();

        return redirect()->route('things.index');
    }
}