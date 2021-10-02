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
        $validData = $request->validate([
            'alt' => 'required|string',
            'image' => 'required',
        ]);

        $file = $request->file('image');

        // create new random name
        $name = \Str::random(12) . '.' . $file->getClientOriginalExtension();

        $destinationPatch = '/images/' . now()->year . '/' . now()->month . '/' . now()->day . '/';

        // save image
        $file->move(public_path($destinationPatch), $name);

        // image src
        $src = public_path($destinationPatch) . $name;

        // thumbnail src
        $dest = public_path($destinationPatch) . $name;

        Product::resize_crop_image(1170, 780 , $src, $dest);

        // Thumbnail relative patch
        $thumb = $destinationPatch . $name;

        $validData['image'] = $thumb;

        $product->galleries()->create($validData);

        return redirect(route('admin.products.gallery.index',$product));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function show(ProductGallery $productGallery,Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductGallery $productGallery,Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductGallery $productGallery,Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductGallery  $productGallery
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
