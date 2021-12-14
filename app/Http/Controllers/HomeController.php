<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get all games
        // dd(TransactionDetail::all());
        // dd(Transaction::all());
        $games = Game::join('categories', "categories.id", 'games.category_id')->inRandomOrder()->take(8)->get();

        return view('home', [
            'title' => 'Home',
            'active' => 'home',
            'games' => $games,
        ]);
    }
}
