<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $games = Game::join('categories', "categories.id", 'games.category_id')->inRandomOrder()->take(8)->get();

        return view('home', [
            'title' => 'Home',
            'active' => 'home',
            'games' => $games,
        ]);
    }
}
