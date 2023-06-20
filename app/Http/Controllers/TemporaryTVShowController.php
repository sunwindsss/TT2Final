<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TVShow;
use App\Models\ActorsInShows;
use App\Models\Actor;
use App\Models\Rating;
use App\Models\Watchlist;


class TemporaryTVShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $temporaryTVShows = TVShow::all();

        // Load the actors for each TV show
        foreach ($temporaryTVShows as $temporaryTVShow) {
            $actors = ActorsInShows::where('show_id', $temporaryTVShow->id)
                ->join('actors', 'actors_in_shows.actor_id', '=', 'actors.id')
                ->get(['actors.full_name']);

            $temporaryTVShow->actors = $actors;
        }

        // Load the watchlist status for each TV show
        $user = auth()->user();
        if ($user) {
            $temporaryTVShows->load(['watchlist' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }]);
        }
        
        return view('temporary-tvshows.index', ['temporaryTVShows' => $temporaryTVShows]);
    }
    
    // Function to handle TV show rating requests
    public function rate(Request $request)
    {
        $validatedData = $request->validate([
            'tv_show_id' => 'required|exists:tv_shows,id',
            'rating' => 'required|numeric|min:1|max:10',
        ]);

        $user = auth()->user();

        if ($user) {
            $tvShow = TVShow::findOrFail($validatedData['tv_show_id']);

            $existingRating = Rating::where('tv_show_id', $tvShow->id)
                ->where('user_id', $user->id)
                ->first();

            if ($existingRating) {
                $existingRating->delete();
            }

            $rating = new Rating();
            $rating->tv_show_id = $tvShow->id;
            $rating->user_id = $user->id;
            $rating->rating = $validatedData['rating'];
            $rating->save();

            return redirect()->back()->with('success', 'Show rated successfully.');
        }

        return redirect()->back()->with('error', 'Please register to rate shows.');
    }


    public function deleteRating(Rating $rating)
    {
        $rating->delete();
        return redirect()->back()->with('success', 'Rating deleted successfully.');
    }

    public function addToWatchlist(TVShow $tvShow)
    {
        $user = auth()->user();
        
        if ($user) {
            $watchlistEntry = new Watchlist();
            $watchlistEntry->show_id = $tvShow->id;
            $watchlistEntry->user_id = $user->id;
            $watchlistEntry->watchlist_status = 1;
            $watchlistEntry->save();
    
            return redirect()->back()->with('success', 'Added to watchlist.');
        }
    
        return redirect()->back()->with('error', 'Please register to add to watchlist.');
    }

    public function removeFromWatchlist(Watchlist $watchlist)
    {
        $watchlist->delete();
    
        return redirect()->back()->with('success', 'Removed from watchlist.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
    
        // Check if the search field is empty, and if it is, just bring the user back to the home view
        if (empty($search)) {
            return redirect()->route('home');
        }
    
        $temporaryTVShows = TVShow::where('name', 'like', '%' . $search . '%')->get();
    
        // Load the actors for each TV show
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
