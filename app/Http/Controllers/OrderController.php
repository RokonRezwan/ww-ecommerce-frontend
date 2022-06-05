<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function storeOrder(Request $request)
    {
        return $request;
        $response = Http::post('http://example.com/users', [
            
        ]);
    }
}
