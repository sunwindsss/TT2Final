<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TVShow;
use App\Models\ActorsInShows;
use App\Models\Actor;

class TemporaryTVShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $temporaryTVShows = TVShow::all();
    
        foreach ($temporaryTVShows as $temporaryTVShow) {
            $actors = ActorsInShows::where('show_id', $temporaryTVShow->id)
                ->join('actors', 'actors_in_shows.actor_id', '=', 'actors.id')
                ->get(['actors.full_name']);
    
            $temporaryTVShow->actors = $actors;
        }
    
        return view('temporary-tvshows.index', ['temporaryTVShows' => $temporaryTVShows]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
