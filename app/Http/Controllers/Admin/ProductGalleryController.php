<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Product $product)
    {
        $galleries = $product->galleries()->get();
        return view('admin.galleries.index', compact(['product','galleries']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Product $product)
    {
        return view('admin.galleries.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request,Product $product)
    {
        if(count($product->galleries()->get()) > 5)
            return back()->withErrors('The maximum number of images for the product is 5');

        $validData = $request->validate([
            'alt' => 'required|string',
            'image' => 'required',
        ]);

        $validData = ProductGallery::uploadImage($request, $validData, 1178, 780);

        $product->galleries()->create($validData);

        return redirect(route('admin.products.gallery.index',$product));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductGallery  $gallery
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Product $product, ProductGallery $gallery)
    {
        return view('admin.galleries.edit', compact(['product','gallery']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductGallery  $gallery
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Product $product, ProductGallery $gallery)
    {
        $validData = $request->validate([
            'alt' => 'required|string',
            'image' => 'required',
        ]);

        if($gallery->image != $validData['image']){

            // Delete outdated
            if(\File::exists(public_path($gallery->image)))
                \File::delete(public_path($gallery->image));

            $validData = ProductGallery::uploadImage($request, $validData, 1178, 780);
        }

        $gallery->update($validData);

        return redirect(route('admin.products.gallery.index',$product));;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductGallery  $gallery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product, ProductGallery $gallery)
    {
        if(\File::exists(public_path($gallery->image)))
            \File::delete(public_path($gallery->image));

       $gallery->delete();

       return back();
    }
}
