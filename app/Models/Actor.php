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
}
