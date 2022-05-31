<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        //
    }

    public function cart()
    {
        return view('cart');
    }

    public function addToCart($id)
    {
        $product = Http::get(config('app.backend_url').'/api/api-products/'.$id)->json();
        $cart = session()->get('cart', []);

        $pr=0; 

        foreach ($product['product']['prices'] as $key => $price) {
            if ($price['start_date'] <= Carbon::now() && $price['end_date'] >= Carbon::now()) {  
                $pr = $price['amount'];
                break;
            }
            elseif($price['price_type_id'] == 1){
                $pr = $price['amount'];
            }
        }
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product['product']['name'],
                "quantity" => 1,
                "price" => $pr,
                "image" => $product['product']['image']
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function checkout()
    {
        return view('confirm-order');
    }
}
