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

    public function addToCart(Product $product)
    {
//        if(Cart::has($product)){
//            if(Cart::count($product) < $product->inventory){
//                Cart::update($product, 1);
//            }else{
//                alert()->error('متاسفانه محصول به سبد خرید اضافه نشد.','اتمام موجودی');
//                return redirect('/cart');
//            }
//        }else {
            Cart::put(
                [
                    'quantity' => 1,
                ],
                $product
            );
//        }

        return redirect('/cart');
    }

//    public function quantityChange(Request $request)
//    {
//        $data = $request->validate([
//            'quantity' => 'required',
//            'id' => 'required',
////            'cart' => 'required',
//        ]);
//
//        if(Cart::has($data['id'])){
//            Cart::update($data['id'], [
//                'quantity' => $data['quantity'],
//            ]);
//
//            return response(['status' => 'success']);
//        }
//
//        return response(['status' => 'error'], 404);
//    }
//
//    public function deleteFromCart($id)
//    {
//        Cart::delete($id);
//
//        alert()->success('محصول مورد نظر با موفقیت از سبد خرید حذف شد.');
//        return back();
//    }
}
