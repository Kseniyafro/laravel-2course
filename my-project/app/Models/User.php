<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // вещи которыми владеет
    public function ownedThings() 
    {
        return $this->hasMany(Thing::class, 'master');
    }

    // вещи которые использует 
    public function usedThings()
    {
        return $this->belongsToMany(
            Thing::class,      
            'uses',            // промежуточная таблица
            'user_id',       
            'thing_id'         
        )
        ->withPivot('amount', 'place_id')  // дополнительные поля из промежуточной таблицы
        ->withTimestamps();    // временные метки из промежуточной таблицы
    }

    // записи об использовании - история
    public function useRecords()
    {
        return $this->hasMany(UseRecord::class, 'user_id');
    }

    public function receivedThings()
    {
        return $this->hasManyThrough(
            Thing::class,
            UseRecord::class,
            'user_id',      
            'id',           
            'id',          
            'thing_id'       
        );
    }
}
