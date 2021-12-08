<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class GameController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('addGame', [
            'title' => 'Add Game',
            'active' => 'addGame',
            'categories' => $category
        ]);
    }

    // store game
    public function store(Request $request)
    {
        $request->validate(
            [
                'game_name' => 'required|unique:games',
                'slug' => 'unique:games',
                'description' => 'required|max:500',
                'long_description' => 'required|max:2000',
                'category_id' => 'required',
                'release_date' => 'date_format:Y-m-d|nullable',
                'developer' => 'required',
                'publisher' => 'required',
                'price' => 'required|numeric|digits_between:1,7',
                'cover' => 'required|image|mimes:jpg|max:100024',
                'trailer' => 'required|mimetypes:video/webm|max:100000024',
                'is_adult' => 'boolean',
            ],
            [
                'game_name.required' => 'Game name is required',
                'game_name.unique' => 'Game name is already taken',
                'slug.unique' => 'Game slug is already taken',
                'description.required' => 'Game description is required',
                'description.max' => 'Game description must be less than 500 characters',
                'long_description.required' => 'Game long description is required',
                'long_description.max' => 'Game long description must be less than 2000 characters',
                'category_id.required' => 'Game category is required',
                'developer.required' => 'Game developer is required',
                'publisher.required' => 'Game publisher is required',
                'price.required' => 'Game price is required',
                'price.numeric' => 'Game price must be numeric',
                'price.digits_between' => 'Game price must be less than 1 millions',
                'cover.required' => 'Game cover is required',
                'cover.image' => 'Game cover must be an image',
                'cover.mimes' => 'Game cover extension must be jpg file',
                'cover.max' => 'Game cover must be less than 100 kilobytes',
                'trailer.required' => 'Game trailer is required',
                'trailer.mimetypes' => 'Game trailer extension must be webm file',
                'trailer.max' => 'Game trailer must be less than 100 megabytes',
            ]
        );

        $game = new Game();
        $game->game_name = $request->game_name;
        $game->slug = Str::slug($request->game_name, '-');
        $game->description = $request->description;
        $game->long_description = $request->long_description;
        $game->category_id = $request->category_id;
        $game->release_date = $request->release_date;
        $game->developer = $request->developer;
        $game->publisher = $request->publisher;
        $game->price = $request->price;

        if ($request->is_adult) {
            $game->is_adult = 1;
        } else {
            $game->is_adult = 0;
        }


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

        return redirect('/')->with('success', 'Game added successfully');
    }
}
