<?php

namespace App\Http\Controllers;

use App\Models\Thing;     
use App\Models\Place;     
use App\Models\User;        
use App\Models\UseRecord;   
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 

class UseController extends Controller
{
    public function create($thing_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $thing = Thing::findOrFail($thing_id);
        
        if ($thing->master !== Auth::id()) {
            return redirect()->route('things.show', ['thing' => $thing_id]);
        }
        
        $users = User::all();
        
        $places = Place::all();
        
        return view('use.create', [
            'thing' => $thing,   
            'users' => $users,    
            'places' => $places 
        ]);
    }
    
    public function store(Request $request, $thing_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $thing = Thing::findOrFail($thing_id);
        
        if ($thing->master !== Auth::id()) {
            return redirect()->route('things.show', ['thing' => $thing_id]);
        }
        
        $request->validate([
            'user_id' => 'required|exists:users,id',     // должен существовать в таблице users
            'place_id' => 'required|exists:places,id',   // должен существовать в таблице places
            'amount' => 'required|integer|min:1',       
        ]);
        
        $use = new UseRecord(); 
        
        $use->thing_id = $thing_id;            
        $use->user_id = $request->user_id;      
        $use->place_id = $request->place_id;    
        $use->amount = $request->amount;        
        
        $use->save();
        
        return redirect()->route('things.show', ['thing' => $thing_id]);
    }
}