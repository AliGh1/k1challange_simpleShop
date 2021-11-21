<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        $request->validate([
            'min' => 'nullable|integer|min:0',
            'max' => 'nullable|integer|min:0',
            'search' => 'nullable|string',
            'category' => 'nullable|exists:categories,name',
            'orderby' => ['nullable',Rule::in(['sold', 'likes', 'max_price', 'min_price', 'latest'])],
        ]);

        $products = Product::query()->withCount('likes')
            ->selectRaw('ifNull(`discount`, `price`) as `final_price`');

        if(isset($request->min)){
            $products->having('final_price', '>=', $request->min);
        }

        if(isset($request->max)){
            $products->having('final_price', '<=', $request->max);
        }

        if(isset($request->search)){
            $products->where('title', 'LIKE', "%{$request->search}%");
        }

        if(isset($request->category)){
            $products->whereRelation('categories', 'name', 'LIKE', $request->category);
        }

        match($request->orderby){
            'sold' => $products->orderByDesc('sold'),
            'likes' => $products->orderByDesc('likes_count'),
            'max_price' => $products->orderByDesc('final_price'),
            'min_price' => $products->orderBy('final_price'),
            default => $products->latest()
        };

        $products = $products->paginate(15)->withQueryString();

        return view('home.products', compact('products'));
    }

    public function show(Product $product)
    {
        return view('home.single-product', compact('product'));
    }
}
