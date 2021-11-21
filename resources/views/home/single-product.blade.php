<x-guest-layout>

    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Single Products') }}
            </h2>
            <x-cart-link />
        </div>
    </header>

    <!-- Page Content -->
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-4 gap-4">

                    <!-- product interview section -->
                    <div class="grid grid-cols-2 col-span-4 lg:col-span-3 p-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">

                        <!-- Product Gallery -->
                        <div class="col-span-2 sm:col-span-1 p-3 flex" x-data="{ tab: '{{ $product->galleries()->first()?->image }}' }">

                            <!-- Gallery Indicator -->
                            <div class="mr-4 flex flex-col {{ $product->galleries()->count() == 5 ? 'justify-between' : 'justify-start space-y-3.5' }}">
                                @foreach($product->galleries()->get() as $gallery)
                                    <div class="w-16 h-16 hover:opacity-60 transition ease-in-out  cursor-pointer rounded-lg border-b shadow overflow-hidden"
                                         :class="{ 'opacity-60': tab === '{{$gallery->image}}' }"
                                         @mouseenter="tab = '{{$gallery->image}}'">
                                        <img class="w-full h-full" src="{{ $gallery->image }}" alt="{{ $gallery->alt }}">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Single Image -->
                            @foreach($product->galleries()->get() as $gallery)
                                <div x-show="tab === '{{ $gallery->image }}'" class="cursor-zoom-in w-full aspect-w-1 aspect-h-1 md:aspect-none md:max-w-sm">
                                    <img class="w-full h-full object-center object-cover rounded-lg shadow overflow-hidden" @click="tab = '{{ $gallery->image }}-full'" src="{{ $gallery->image }}" alt="{{ $gallery->alt }}">
                                </div>
                                <div x-show="tab === '{{ $gallery->image }}-full'" @click="tab = '{{$gallery->image}}'">
                                    <div class="cursor-pointer z-20 fixed inset-0 bg-gray-800 opacity-70"></div>
                                    <img class="absolute inset-0 max-h-full mx-auto z-20" src="{{ $gallery->image }}" alt="{{ $gallery->alt }}">
                                </div>
                            @endforeach
                        </div>

                        <!-- Product details -->
                        <div class="p-3 col-span-2 sm:col-span-1 relative flex flex-col">
                            <h4 class="font-semibold text-lg text-gray-800 tracking-wide leading-relaxed">{{ $product->title }}</h4>

                            <!-- Categories -->
                            <div class="mt-2 space-x-2">
                                @foreach($product->categories()->get() as $category)
                                    <a href="#" class="text-sm font-medium text-blue-400 hover:text-blue-700 transition duration-150 ease-in-out">{{ $category->name}}</a>
                                @endforeach
                            </div>

                            <!-- Product Inventory -->
                            <div class="mt-6 whitespace-nowrap">
                                <span class="text-gray-600">Inventory:</span>
                                @if(!$product->quantity)
                                    <span class="font-semibold leading-5 text-red-600">
                                        Out of stock
                                    </span>
                                @elseif($product->quantity < 5)
                                    <span class="font-semibold leading-5 text-yellow-600">
                                        Only {{ $product->quantity }}
                                    </span>
                                @else
                                    <span class="font-semibold leading-5 text-green-600">
                                        In Stock
                                    </span>
                                @endif
                            </div>

                            <!-- Product Price -->
                            <div class="mt-4 flex items-baseline space-x-1.5">
                                <span class="text-gray-600">Price:</span>
                                @if($product->discount)
                                    <div class="text-gray-800">${{ $product->discount }}</div>
                                @endif

                                <div class="{{ ($product->discount ? 'text-sm text-red-600 line-through' : 'text-gray-800')  }} ">
                                    ${{ $product->price }}
                                </div>
                            </div>

                            <!-- discount percent -->
                            <div class="mt-4">
                                @if($product->discount)
                                    <span class="text-gray-600">You Save:</span>
                                    <span class="text-sm text-gray-800">
                                        ${{ $product->price - $product->discount }} ({{ round(100 * ($product->price - $product->discount) / $product->price, 2) }}%)
                                    </span>
                                @endif
                            </div>

                            @auth
                                <!-- like product -->
                                <div class="absolute right-0 bottom-0 flex space-x-1.5">
                                    <span class="text-md text-gray-700">
                                        {{ $product->likes()->count() }}
                                    </span>
                                    <form action="{{ route('like') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="likeable_type" value="{{ get_class($product) }}"/>
                                        <input type="hidden" name="likeable_id" value="{{ $product->id }}"/>
                                        <button type="submit">
                                            <svg class="fill-current {{ auth()->user()->isLiked($product) ? 'text-red-500' : 'text-gray-200' }} w-5 h-5" viewBox="0 0 16 16">
                                                <path d="M8.612 2.347 8 2.997l-.612-.65c-1.69-1.795-4.43-1.795-6.12 0-1.69 1.795-1.69 4.706 0 6.502l.612.65L8 16l6.12-6.502.612-.65c1.69-1.795 1.69-4.706 0-6.502-1.69-1.795-4.43-1.795-6.12.001z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endauth
                        </div>
                    </div>

                    <!-- add to cart section -->
                    <div class="self-start col-span-4 lg:sticky lg:top-4 lg:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4">
                            <!-- Product Price -->
                            <div class="mt-2 flex items-baseline space-x-1.5">
                                <span class="text-gray-600">Price:</span>
                                @if($product->discount)
                                    <div class="text-gray-800">${{ $product->discount }}</div>
                                @endif

                                <div class="{{ ($product->discount ? 'text-sm text-red-600 line-through' : 'text-gray-800')  }} ">
                                    ${{ $product->price }}
                                </div>
                            </div>

                            <!-- Product Inventory -->
                            <div class="mt-2 whitespace-nowrap">
                                <span class="text-gray-600">Inventory:</span>
                                @if(!$product->quantity)
                                    <span class="font-semibold leading-5 text-red-600">
                                        Out of stock
                                    </span>
                                @elseif($product->quantity < 5)
                                    <span class="font-semibold leading-5 text-yellow-600">
                                        Only {{ $product->quantity }}
                                    </span>
                                @else
                                    <span class="font-semibold leading-5 text-green-600">
                                        In Stock
                                    </span>
                                @endif
                            </div>

                            <!-- Product Quantity -->
                            <div class="mt-2">
                                @if($product->quantity - Cart::count($product))
                                    <form class="flex items-center" id="add-to-cart" method="POST" action="{{ route('cart.add', compact('product')) }}">
                                        @csrf
                                        <x-label for="quantity" :value="__('Quantity:')" />

                                        <select id="quantity" name="quantity" class="ml-4 py-1 text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @foreach(range(1 , $product->quantity - Cart::count($product)) as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                @else
                                    <span class="mt-1.5 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-600">{{ Cart::count($product) }} in your cart</span>
                                @endif
                            </div>

                            <!-- Add to Cart -->
                            @if($product->quantity && Cart::count($product) < $product->quantity)

                                <span onclick="document.getElementById('add-to-cart').submit()" class="self-end w-full mt-4 block px-4 py-2 text-sm font-semibold text-center rounded-md text-green-600 cursor-pointer hover:text-white leading-5 bg-green-200 hover:bg-green-600 focus:outline-none focus:bg-green-600 transition duration-150 ease-in-out">
                                    Add to Cart
                                </span>
                            @else
                                <span class="self-end w-full mt-4 block px-4 py-2 opacity-70 text-sm font-semibold text-center rounded-md text-gray-600 cursor-not-allowed leading-5 bg-gray-200">
                                    Out of stock
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 col-span-4 lg:col-span-3 p-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <h5 class="font-semibold text-xl text-gray-800 leading-tight">Product Description</h5>

                        <p class="mt-4 text-gray-600 text-md">
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-guest-layout>
