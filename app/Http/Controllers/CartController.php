<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Cart;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('home.cart');
    }

    public function addToCart(Request $request, Product $product): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'quantity' => 'numeric'
        ]);

        $quantity = $request['quantity'] ?? 1;

        if(Cart::has($product)){
            if(Cart::count($product) <= $product->quantity - $quantity){
                Cart::update($product, $quantity);
            }else{
                // no inventory
                return redirect('/cart');
            }
        }else {
            Cart::put(
                [
                    'quantity' => $quantity,
                ],
                $product
            );
        }

        return redirect('/cart');
    }

    public function updateQuantity(Request $request): \Illuminate\Http\Response
    {
        $request->validate([
            'quantity' => 'required',
            'id' => 'required',
        ]);

        if(Cart::has($request['id'])){
            Cart::update($request['id'], [
                'quantity' => $request['quantity'],
            ]);
            return response(['status' => 'success']);
        }

        return response(['status' => 'error'], 404);
    }

    public function deleteCartItem($id): \Illuminate\Http\RedirectResponse
    {
        Cart::delete($id);
        return back();
    }
}
