<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    // Relationship to TV Shows
    public function tvShow()
    {
        return $this->belongsTo(TVShow::class);
    }

    // Relationship to user table
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
