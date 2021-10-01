<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required',
            'price' => 'required|int',
            'discount' => 'int|nullable',
            'quantity' => 'required',
            'categories' => 'required',
        ]);

        $validData = $this->uploadImage($request, $validData);

        $product = auth()->user()->products()->create($validData);
        $product->categories()->sync($validData['categories']);


        return redirect(route('admin.products.gallery.create',$product));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit' , compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Product $product)
    {
        $validData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required',
            'price' => 'required|int',
            'discount' => 'int|nullable',
            'quantity' => 'required',
            'categories' => 'required',
        ]);

        if($product->image != $validData['image']){

            // Delete outdated
            if(\File::exists(public_path($product->image)))
                \File::delete(public_path($product->image));

            $validData = $this->uploadImage($request, $validData);
        }

        $product->update($validData);
        $product->categories()->sync($validData['categories']);

        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        if(\File::exists(public_path($product->image)))
            \File::delete(public_path($product->image));

        $product->delete();

        return back();
    }

    /**
     * @param Request $request
     * @param array $validData
     * @return array
     */
    private function uploadImage(Request $request, array $validData): array
    {
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

        Product::resize_crop_image(300, 300, $src, $dest);

        // Thumbnail relative patch
        $thumb = $destinationPatch . $name;

        $validData['image'] = $thumb;
        return $validData;
    }
}
