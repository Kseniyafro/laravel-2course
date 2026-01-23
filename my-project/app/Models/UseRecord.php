<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UseRecord extends Model
{
    protected $table = 'uses';
    
    protected $fillable = [  
        'thing_id',
        'place_id', 
        'user_id',
        'amount',
    ];

    // вещь которую передали
    public function thing() 
    {
        return $this->belongsTo(Thing::class, 'thing_id');
    }

    // место хранения
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
