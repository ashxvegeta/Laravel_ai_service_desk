<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'priority',
    ];

    // Relationship with User model Each Ticket belongs to ONE User
    public  function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
