<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Rules\CardCVVCVCRule;
use App\Rules\CardExpiredYearRule;
use App\Rules\CardNumberRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function idxTransaction()
    {
        if (Auth::check()) {
            $cart = Cookie::get('cart');
            $cart = json_decode($cart, true);
            if ($cart) {
                $total = 0;

                foreach ($cart as $key => $value) {
                    $total += $value['price'];
                }
                return view('transaction', [
                    'title' => 'Transaction',
                    'active' => 'transaction',
                    'total' => $total
                ]);
            } else {
                return redirect('/')->with('error', 'Sorry, cart is empty');
            }
        } else {
            return redirect('/login')->with('error', 'Please login or Register');
        }
    }

    public function storeTransaction(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'card_name' => 'required|min:6',
                'card_number' => ['required', new CardNumberRule],
                'expired_month' => ['required', 'numeric', 'min:1', 'max:12'],
                'expired_year' => ['required', 'numeric', new CardExpiredYearRule],
                'cvc_cvv' => ['required', 'numeric', new CardCVVCVCRule],
                'card_country' =>   'required',
                'postal_code' => 'required|numeric',
            ]);
            $cart = Cookie::get('cart');
            $cart = json_decode($cart, true);
            $total = 0;

            $transaction = new Transaction();
            $transaction->user_id = Auth::user()->id;
            $transaction->uuid_transaction = Str::uuid()->toString();
            $transaction->card_name = $request->card_name;
            $transaction->card_number = $request->card_number;
            $transaction->expired_month = $request->expired_month;
            $transaction->expired_year = $request->expired_year;
            $transaction->cvc_cvv = $request->cvc_cvv;
            $transaction->card_country = $request->card_country;
            $transaction->postal_code = $request->postal_code;

            foreach ($cart as $key => $value) {
                $total += $value['price'];
            }
            $transaction->total = $total;
            $transaction->save();
            foreach ($cart as $key => $value) {

                $transactionDetail = new TransactionDetail();
                $transactionDetail->transaction_id = $transaction->id;
                $transactionDetail->game_id = $cart[$key]['id'];

                $transactionDetail->save();
            }
            $transaction->total = $total;

            Cookie::queue(Cookie::forget('cart'));
            return redirect('/transaction/' . $transaction->uuid_transaction)->with('success', 'Transaction Success');
        } else {
            return redirect('/login')->with('error', 'Please login or Register');
        }

        return redirect('/')->with('success', 'Transaction Success');
    }

    public function receiptTransaction($uuid)
    {
        $transaction = Transaction::where('uuid_transaction', $uuid)->first();
        $transactionDetails = TransactionDetail::where('transaction_id', $transaction->id)->get();
        $total = 0;
        foreach ($transactionDetails as $key => $value) {
            $game = Game::find($value->game_id);
            $transactionDetails[$key]->game = $game;
            $total += $game->price;
        }
        $transaction->total = $total;
        return view('receipt', [
            'title' => 'Receipt',
            'active' => 'receipt',
            'transactions' => $transaction,
            'transactionDetails' => $transactionDetails,
            'total' => $total
        ]);
    }
}
