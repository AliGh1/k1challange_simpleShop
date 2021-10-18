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
                    <div class="col-span-4 lg:col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 flex" x-data="{ tab: '{{ $product->galleries()->first()->image }}' }">
                            <div class="mr-4 flex flex-col justify-between">
                                @foreach($product->galleries()->get() as $gallery)
                                    <div class="w-16 h-16 hover:opacity-60 transition ease-in-out  cursor-pointer rounded-lg border-b shadow overflow-hidden"
                                         :class="{ 'opacity-60': tab === '{{$gallery->image}}' }"
                                         @mouseenter="tab = '{{$gallery->image}}'">
                                        <img class="w-full h-full" src="{{ $gallery->image }}" alt="{{ $gallery->alt }}">
                                    </div>
                                @endforeach
                            </div>
                            @foreach($product->galleries()->get() as $gallery)
                                <div x-show="tab === '{{ $gallery->image }}'" class="cursor-zoom-in w-full aspect-w-1 aspect-h-1 md:aspect-none md:max-w-sm rounded-lg shadow overflow-hidden">
                                    <img class="w-full h-full object-center object-cover" @click="tab = '{{ $gallery->image }}-full'" src="{{ $gallery->image }}" alt="{{ $gallery->alt }}">
                                </div>
                                <div x-show="tab === '{{ $gallery->image }}-full'" @click="tab = '{{$gallery->image}}'">
                                    <div class="cursor-pointer fixed inset-0 bg-gray-800 opacity-70"></div>
                                    <img class="absolute inset-0 max-h-full mx-auto z-10" src="{{ $gallery->image }}" alt="{{ $gallery->alt }}">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="self-start col-span-4 lg:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-2">
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
                </div>
            </div>
        </div>
    </main>

</x-guest-layout>
