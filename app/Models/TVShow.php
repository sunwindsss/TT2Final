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
}
