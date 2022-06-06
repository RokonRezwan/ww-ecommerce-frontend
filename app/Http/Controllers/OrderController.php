<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function storeOrder(Request $request)
    {
        /* dd($request->all()); */
        $response = Http::post('http://127.0.0.1:8000/api/api-orders', $request->all());
        $succMsg = json_decode($response, true);

        $request->session()->flush('cart');

        return redirect()->route('welcome')->with(['orderSuccess'=> $succMsg]);
    }
}
