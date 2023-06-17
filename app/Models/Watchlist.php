<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;

    public function tvShow()
    {
        return $this->belongsTo(TVShow::class, 'show_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
