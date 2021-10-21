<x-guest-layout>

    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Single Products') }}
            </h2>
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
                        <div class="p-3 col-span-2 sm:col-span-1 flex flex-col">
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
                                        ${{ $product->price - $product->discount }} ({{ 100 * ($product->price - $product->discount) / $product->price }}%)
                                    </span>
                                @endif
                            </div>
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
                            <div class="mt-2 flex items-center">
                                <x-label for="quantity" :value="__('Quantity:')" />

                                <select id="quantity" name="quantity" class="ml-4 py-1 text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @for($i = 1; $i <= $product->quantity; ++$i)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Add to Cart -->
                            @if($product->quantity)
                                <a href="{{ route('product.show', compact('product')) }}" class="self-end w-full mt-4 block px-4 py-2 text-sm font-semibold text-center rounded-md text-green-600 cursor-pointer hover:text-white leading-5 bg-green-200 hover:bg-green-600 focus:outline-none focus:bg-green-600 transition duration-150 ease-in-out">
                                    Add to Cart
                                </a>
                            @else
                                <a class="self-end w-full mt-4 block px-4 py-2 opacity-70 text-sm font-semibold text-center rounded-md text-gray-600 cursor-not-allowed leading-5 bg-gray-200">
                                    Out of stock
                                </a>
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
