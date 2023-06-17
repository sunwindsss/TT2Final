<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
