<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TVShow extends Model
{
    use HasFactory;

    protected $table = 'tv_shows';

    // Define the relationship to ActorsInShows
    public function actorsInShows()
    {
        return $this->hasMany(ActorsInShows::class, 'show_id');
    }

    // Relationship to TV Show ratings
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'tv_show_id');
    }

    // Relationship to TV Show watchlists
    public function watchlist()
    {
        return $this->hasMany(Watchlist::class, 'show_id');
    }

    // function so the separate TV show info view works
    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'actors_in_shows', 'show_id', 'actor_id');
    }
}
