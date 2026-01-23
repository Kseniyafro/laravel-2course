<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [ 
        'name',
        'description',
        'repair',
        'work',   
    ];

    // использования в этом месте - кто что хранит здесь
    public function uses() 
    {
        return $this->hasMany(UseRecord::class, 'place_id');
    }

    public function things()
    {
        return $this->hasManyThrough(
            Thing::class,       
            UseRecord::class, 
            'place_id',       
            'id',            
            'id',               
            'thing_id'        
        );
    }
}
