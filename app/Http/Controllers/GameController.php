<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use App\Models\TransactionDetail;
use App\Models\Transaction;
use App\Rules\PriceRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function index()
    {
        $category = Category::all();
        if (Auth::check() && Auth::user()->role_id == 1) {

            return view('addGame', [
                'title' => 'Add Game',
                'active' => 'addGame',
                'categories' => $category
            ]);
        } else {
            return redirect('/login')->with('error', 'Please login or Register');
        }
    }

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
                'price' => ['required', 'numeric', new PriceRule],
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

    public function search(Request $request)
    {
        $game01 = Game::join('categories', "categories.id", 'games.category_id')->paginate(8);

        // Search by game name
        if ($request->get('search_game')) {
            $search = $request->get('search_game');
            $game = Game::where('game_name', 'like', '%' . $search . '%')->paginate(8);
        }

        return view('search', [
            'title' => 'Search',
            'active' => 'search',
            'games' => $game ?? $game01
        ]);
    }

    public function detail(Game $game)
    {
        if (Auth::check()) {
            $transaction = Transaction::join('transaction_details', 'transaction_details.transaction_id', 'transactions.id')->where('transaction_details.game_id', $game->id)->where('user_id', Auth::user()->id)->first();
            // dd($transaction);

            if ($game->is_adult == 0) {
                return view('detailgame', [
                    'title' => $game->game_name,
                    'active' => 'detail',
                    'game' => $game,
                    'transaction' => $transaction
                ]);
            } else {
                return view('checkage', [
                    'title' => 'Check Age',
                    'active' => 'checkage',
                    'game' => $game
                ]);
            }
        } else {
            if ($game->is_adult == 0) {
                return view('detailgame', [
                    'title' => $game->game_name,
                    'active' => 'detail',
                    'game' => $game,
                ]);
            } else {
                return view('checkage', [
                    'title' => 'Check Age',
                    'active' => 'checkage',
                    'game' => $game
                ]);
            }
        }
    }

    public function checkAge(Request $request, Game $game)
    {
        $day = (int) $request->day;
        $month = (int) $request->month;
        $year = (int) $request->year;
        $transaction = Transaction::join('transaction_details', 'transaction_details.transaction_id', 'transactions.id')->where('transaction_details.game_id', $game->id)->where('user_id', Auth::user()->id)->first();

        // Validasi Bulan Februari
        if ($month == 2) {
            if ($day == 29 && $year % 4 == 0) {
                $birthDate = $request->day . '-' . $request->month . '-' . $request->year;
                $currentDate = date("d-m-Y");
                $ageDiff = date_diff(date_create($birthDate), date_create($currentDate));

                $age = $ageDiff->format('%y');
                $ageConvert = (int) $age;

                if ($ageConvert >= 17) {
                    return view('detailgame', [
                        'title' => $game->game_name,
                        'active' => 'detail',
                        'game' => $game,
                        'transaction' => $transaction
                    ]);
                } else {
                    return redirect('/')->with('error', 'You must be at least 17 years old to play this game');
                }
            } else if ($day == 29 && $year % 4 != 0) {
                return back()->with('error', 'Invalid date');
            } else {
                $birthDate = $request->day . '-' . $request->month . '-' . $request->year;
                $currentDate = date("d-m-Y");
                $ageDiff = date_diff(date_create($birthDate), date_create($currentDate));

                $age = $ageDiff->format('%y');
                $ageConvert = (int) $age;

                if ($ageConvert >= 17) {
                    return view('detailgame', [
                        'title' => $game->game_name,
                        'active' => 'detail',
                        'game' => $game,
                        'transaction' => $transaction
                    ]);
                } else {
                    return redirect('/')->with('error', 'You must be at least 17 years old to play this game');
                }
            }
        }

        // Validasi Bulan April, Juni, September, November
        if ($month == 4 || $month == 6 || $month == 9 || $month == 11) {
            if ($day == 31) {
                return back()->with('error', 'Invalid date');
            } else {
                $birthDate = $request->day . '-' . $request->month . '-' . $request->year;
                $currentDate = date("d-m-Y");
                $ageDiff = date_diff(date_create($birthDate), date_create($currentDate));

                $age = $ageDiff->format('%y');
                $ageConvert = (int) $age;

                if ($ageConvert >= 17) {
                    return view('detailgame', [
                        'title' => $game->game_name,
                        'active' => 'detail',
                        'game' => $game,
                        'transaction' => $transaction
                    ]);
                } else {
                    return redirect('/')->with('error', 'You must be at least 17 years old to play this game');
                }
            }
        }

        // Validasi Selain bulan Februari dan April, Juni, September, November
        $birthDate = $request->day . '-' . $request->month . '-' . $request->year;
        $currentDate = date("d-m-Y");
        $ageDiff = date_diff(date_create($birthDate), date_create($currentDate));

        $age = $ageDiff->format('%y');
        $ageConvert = (int) $age;

        if ($ageConvert >= 17) {
            return view('detailgame', [
                'title' => $game->game_name,
                'active' => 'detail',
                'game' => $game,
                'transaction' => $transaction
            ]);
        } else {
            return redirect('/')->with('error', 'You must be at least 17 years old to play this game');
        }
    }

    public function addToCart($id)
    {
        $game = Game::findOrFail($id);
        $cart = Cookie::get('cart');

        if (Auth::check()) {
            if (!$cart) {
                $cart = json_decode($cart, true);
                $cart[$id] = $game;

                Cookie::queue('cart', json_encode($cart), 60);

                return redirect('/')->with('success', 'Game success added to cart');
            } else {
                $cart = json_decode($cart, true);

                if (array_key_exists($id, $cart)) {
                    return redirect('/')->with('error', 'This game already in your cart');
                } else {
                    $cart[$id] = $game;

                    Cookie::queue('cart', json_encode($cart), 60);

                    return redirect('/')->with('success', 'Game success added to cart');
                }
            }
        } else {
            return redirect("/login")->with('error', 'Please login or Register');
        }
    }

    public function detailShoppingCart()
    {
        if (Auth::check()) {
            $cart = Cookie::get('cart');
            if (!$cart) {
                return redirect()->back()->with('error', 'Your cart is empty');
            } else {
                $cart = json_decode($cart, true);
                $game = Game::with('category')->whereIn('id', array_keys($cart))->get();
                $total = 0;

                foreach ($cart as $key => $value) {
                    $total += $value['price'];
                }

                // dd($cart);
                // dd($total);

                return view('shoppingcart', [
                    'title' => 'Shopping Cart',
                    'active' => 'shoppingcart',
                    'games' => $game,
                    'total' => $total
                ]);
            }
        } else {
            return redirect('/login')->with('error', 'Please login or Register');
        }
    }

    public function deleteCart($id)
    {
        $cart = Cookie::get('cart');

        if (!$cart) {
            return redirect('/')->with('error', 'Your cart is empty');
        } else {
            $cart = json_decode($cart, true);

            if (array_key_exists($id, $cart)) {
                unset($cart[$id]);
                Cookie::queue('cart', json_encode($cart), 60);

                return redirect('/shopping-cart')->with('success', 'Game success deleted from cart');
            } else {
                return redirect('/shopping-cart')->with('error', 'Game not found in cart');
            }
        }
    }
}
