<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use App\Rules\PriceRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ManageGameController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 1) {
                $category = Category::all();
                $games01 = Game::join('categories', "categories.id", 'games.category_id')->paginate(8);

                if ($request->get('category')) {
                    $checked = $_GET['category'];
                    $games = Game::join('categories', "categories.id", 'games.category_id')->where('category_id', $checked)->paginate(8);
                }
                if ($request->get('search')) {
                    $search = $request->get('search');
                    $games = Game::join('categories', "categories.id", 'games.category_id')->where('game_name', 'like', '%' . $search . '%')->paginate(8);
                }

                return view('manageGame', [
                    'title' => 'Manage Game',
                    'active' => 'manageGame',
                    'categories' => $category,
                    'games' => $games ?? $games01,
                ]);
            }
        } else {
            return redirect('/login')->with('error', 'Please login or Register');
        }
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->back()->with('success', 'Delete Successfully');
    }

    public function edit(Game $game)
    {
        if (Auth::check() && Auth::user()->role_id == 1) {
            $categories = Category::all();

            return view('editGame', [
                'title' => 'Edit Game',
                'active' => 'manageGame',
                'game' => $game,
                'categories' => $categories,
            ]);
        } else {
            return redirect('/login')->with('error', 'Please login or Register');
        }
    }


    public function update(Request $request, Game $game)
    {
        $request->validate(
            [
                'description' => 'required|max:500',
                'long_description' => 'required|max:2000',
                'category_id' => 'required',
                'price' => ['required', 'numeric', new PriceRule],
                'cover' => 'required|image|mimes:jpg|max:100024',
                'trailer' => 'required|mimetypes:video/webm|max:100000024',
            ],
            [
                'description.required' => 'Game description is required',
                'description.max' => 'Game description must be less than 500 characters',
                'long_description.required' => 'Game long description is required',
                'long_description.max' => 'Game long description must be less than 2000 characters',
                'category_id.required' => 'Game category is required',
                'price.required' => 'Game price is required',
                'price.numeric' => 'Game price must be numeric',
                'cover.required' => 'Game cover is required',
                'cover.image' => 'Game cover must be an image',
                'cover.mimes' => 'Game cover extension must be jpg file',
                'cover.max' => 'Game cover must be less than 100 kilobytes',
                'trailer.required' => 'Game trailer is required',
                'trailer.mimetypes' => 'Game trailer extension must be webm file',
                'trailer.max' => 'Game trailer must be less than 100 megabytes',
            ]
        );

        $game->description = $request->description;
        $game->long_description = $request->long_description;
        $game->category_id = $request->category_id;
        $game->price = $request->price;

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName =  time() . "-" . $cover->getClientOriginalName();
            $cover->move(public_path('covers'), $coverName);
            $game->cover = $coverName;
        }
        if ($request->hasFile('trailer')) {
            $trailer = $request->file('trailer');
            $trailerName =  time() . '.' . $trailer->getClientOriginalExtension();
            $trailer->move(public_path('videos/trailers'), $trailerName);
            $game->trailer = $trailerName;
        }

        $game->save();

        return redirect('/manage-game')->with('success', 'Update Successfully');
    }
}
