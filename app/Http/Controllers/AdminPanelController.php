<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TVShow;
use App\Models\ActorsInShows;
use App\Models\Actor;
use App\Models\Rating;
use App\Models\Watchlist;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminPanelController extends Controller
{
    public function index()
    {
        // Add logic here for the admin panel view
        return view('admin.admin');
    }

    public function createTVShow()
    {
        return view('admin.addtvshow');
    }

    public function storeTVShow(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'fixed_score' => 'required|numeric|min:0.1|max:10.0',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the uploaded picture
        // Str::slug() method generates a slug version of the TV show name, 
        // which is then combined with the original file extension to create a unique filename.
        $picture = $request->file('picture');
        $pictureName = Str::slug($validatedData['name']) . '.' . $picture->getClientOriginalExtension();
        $picturePath = $picture->storeAs('public/tv_shows', $pictureName);
        $picturePath = str_replace('public/', '', $picturePath);

        // Create the TV show
        $tvShow = new TVShow();
        $tvShow->name = $validatedData['name'];
        $tvShow->description = $validatedData['description'];
        $tvShow->fixed_score = $validatedData['fixed_score'];
        $tvShow->picture = $picturePath;
        $tvShow->save();

        return redirect()->route('admin.admin')->with('success', 'TV Show added successfully.');
    }

    public function createActor()
    {
        return view('admin.addactor');
    }

    public function storeActor(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required',
            'age' => 'required|integer',
            'biography' => 'required',
        ]);

        // Create the actor
        $actor = new Actor();
        $actor->full_name = $validatedData['full_name'];
        $actor->age = $validatedData['age'];
        $actor->biography = $validatedData['biography'];
        $actor->save();

        return redirect()->route('admin.admin')->with('success', 'Actor added successfully.');
    }

    public function linkActorView()
    {
        $actors = Actor::all(['id', 'full_name']);
        $shows = TVShow::all(['id', 'name']);
        
        return view('admin.linkactor', compact('actors', 'shows'));
    }

    public function linkActor(Request $request)
    {
        $validatedData = $request->validate([
            'actor_id' => 'required|exists:actors,id',
            'show_id' => 'required|exists:tv_shows,id',
        ]);

        $actor = Actor::findOrFail($validatedData['actor_id']);
        $show = TVShow::findOrFail($validatedData['show_id']);

        $actor->actorsInShows()->create([
            'show_id' => $show->id,
            'actor_id' => $actor->id,
        ]);

        return redirect()->route('admin.admin')->with('success', 'Actor linked to show successfully.');
    }

    public function createDeleteTVShow()
    {
        $tvShows = TVShow::all();
        return view('admin.deletetvshow', compact('tvShows'));
    }

    public function deleteTVShow(Request $request)
    {
        $tvShowId = $request->input('tv_show');

        // Retrieve the TV Show by its ID
        $tvShow = TVShow::findOrFail($tvShowId);

        // Delete the TV Show's picture from storage
        if ($tvShow->picture) {
            Storage::delete('public/' . $tvShow->picture);
        }

        // Delete the TV Show from the database
        $tvShow->delete();

        // Remove any associated entries from the actors_in_shows table
        ActorsInShows::where('show_id', $tvShowId)->delete();

        // Remove any associated ratings for the TV Show
        Rating::where('tv_show_id', $tvShowId)->delete();

        // Remove any associated watchlist entries for the TV Show
        Watchlist::where('show_id', $tvShowId)->delete();

        return redirect()->route('admin.admin')->with('success', 'TV Show deleted successfully.');
    }

    public function deleteActor()
    {
        $actors = Actor::all();
        return view('admin.deleteactor', compact('actors'));
    }

    public function destroyActor(Request $request)
    {
        $actorId = $request->input('actor');

        // Delete the actor from the database
        Actor::destroy($actorId);

        // Remove any associated records from the actors_in_shows table
        ActorsInShows::where('actor_id', $actorId)->delete();

        return redirect()->route('admin.admin')->with('success', 'Actor deleted successfully.');
    }

}
