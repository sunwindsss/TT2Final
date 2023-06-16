<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorsInShows extends Model
{
    use HasFactory;

    protected $table = 'actors_in_shows';

    // Define the relationship to TVShow
    public function tvShow()
    {
        return $this->belongsTo(TVShow::class, 'show_id');
    }

    // Define the relationship to Actor
    public function actor()
    {
        return $this->belongsTo(Actor::class, 'actor_id');
    }
}
