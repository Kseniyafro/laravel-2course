<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    protected $fillable = [
        'name',
        'description', 
        'wrnt',
        'master',
    ];

    // создатель вещи 
    public function owner()
    {
        return $this->belongsTo(User::class, 'master');  
    }

    // использования этой вещи - история передач
    public function uses() 
    {
        return $this->hasMany(UseRecord::class, 'thing_id');
    }

    // текущий пользователь вещи
    public function currentUser() 
    {
        return $this->hasOne(UseRecord::class, 'thing_id')->latest();
    }

    // место хранения вещи
    public function currentPlace()
    {
        return $this->hasOneThrough(
            Place::class,     
            UseRecord::class,   // промежуточная модель
            'thing_id',       
            'id',               
            'id',              
            'place_id'          
        )->latest();            
    }
}
