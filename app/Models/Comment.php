<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'ticket_id',
        'user_id',
        'body',
    ];

    // this comment belongs to a ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // this comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
