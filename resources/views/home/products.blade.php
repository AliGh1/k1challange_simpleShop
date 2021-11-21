<x-guest-layout>

    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>
            <x-cart-link />
        </div>
    </header>

    <!-- Page Content -->
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-4 lg:col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white grid grid-cols-6 gap-6">
                            @foreach($products as $product)
                                <x-product-card class="col-span-6 sm:col-span-3 md:col-span-2" :product="$product"/>
                            @endforeach
                        </div>
                        <div class="mt-4 px-6 pb-4">
                            {{ $products->render() }}
                        </div>
                    </div>

                    <div class="self-start col-span-4 lg:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-3">
                            <form action="{{ route('products.index') }}" method="GET">
                                <!-- search -->
                                <div>
                                    <x-label for="search" :value="__('Search')" />
                                    <x-input id="search" class="block mt-1 w-full" type="text" name="search" :value="old('search')"/>
                                </div>

                                <!-- Min Price -->
                                <div class="mt-4">
                                    <x-label for="min_price" :value="__('Min Price')" />
                                    <x-input id="min_price" class="block mt-1 w-full" type="number" name="min_price" min="0" :value="old('min_price')"/>
                                </div>

                                <!-- Product Price -->
                                <div class="mt-4">
                                    <x-label for="max_price" :value="__('Max Price')" />
                                    <x-input id="max_price" class="block mt-1 w-full" type="number" name="max_price" min="0" :value="old('max_price')"/>
                                </div>

                                <!-- Category -->
                                <div class="mt-4">
                                    <label for="category" class="block font-medium text-sm text-gray-700">{{ __('Category') }}</label>

                                    <select id="category" name="category" class="block mt-1 w-full rounded-md shadow-sm border-gray-300
                                        focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value=""></option>
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{ $category->name }}" @if(old('category_name') == $category->name) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Category -->
                                <div class="mt-4">
                                    <label for="orderby" class="block font-medium text-sm text-gray-700">{{ __('Order By') }}</label>

                                    <select id="orderby" name="orderby" class="block mt-1 w-full rounded-md shadow-sm border-gray-300
                                        focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="latest" @if(old('orderby') == 'latest') selected @endif>Latest</option>
                                        <option value="sold" @if(old('orderby') == 'sold') selected @endif>Sold</option>
                                        <option value="likes" @if(old('orderby') == 'likes') selected @endif>Likes</option>
                                        <option value="max_price" @if(old('orderby') == 'max_price') selected @endif>Max Price</option>
                                        <option value="min_price" @if(old('orderby') == 'min_price') selected @endif>Min Price</option>
                                    </select>
                                </div>

                                <!-- submit button -->
                                <div class="mt-4">
                                    <x-button class="w-full justify-center">
                                        {{ __('Search and filter') }}
                                    </x-button>
                                </div>

                                <!-- Clear filter -->
                                <div class="mt-2">
                                    <a href="{{ route('products.index') }}" class="self-end w-full block px-4 py-2 text-sm font-semibold text-center rounded-md text-gray-600 cursor-pointer hover:text-white leading-5 bg-gray-200 hover:bg-gray-600 focus:outline-none focus:bg-gray-600 transition duration-150 ease-in-out">
                                        Clear filters
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>

</x-guest-layout>
