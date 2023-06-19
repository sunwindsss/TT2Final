<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TVShow;
use App\Models\ActorsInShows;
use App\Models\Actor;

class AdminPanelController extends Controller
{
    public function index()
    {
        // Add logic here for the admin panel view
        return view('admin.admin');
    }
}
