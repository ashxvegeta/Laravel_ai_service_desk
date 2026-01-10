<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Embedding extends Model
{
    //
    protected $fillable = ['content', 'embedding', 'source'];

    protected $casts = [
        'embedding' => 'array', // Cast JSON to array
    ];
}
