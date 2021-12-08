<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get all games join categories
        $games = Game::join('categories', "categories.id", 'games.category_id')->get();
        return view('home', [
            'title' => 'Home',
            'active' => 'home',
            'games' => $games,
        ]);
    }
}
