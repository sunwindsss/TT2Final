<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    // Define the relationship to ActorsInShows
    public function actorsInShows()
    {
        return $this->hasMany(ActorsInShows::class, 'actor_id');
    }

    // function so the separate TV show info view works
    public function tvShows()
    {
        return $this->belongsToMany(TVShow::class, 'actors_in_shows', 'actor_id', 'show_id');
    }
}
