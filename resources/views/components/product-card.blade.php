<div {{ $attributes->merge(['class' => 'flex flex-col p-3 shadow rounded-lg']) }}>

    <div class="group relative">

        <!-- Product Image -->
        <div class="rounded-lg overflow-hidden group-hover:opacity-70 transition duration-150 ease-in-out">
            <img class="w-full h-full" src="{{ $product->image }}" alt="{{ $product->image }}">
        </div>

        <!-- Product Title -->
        <h3 class="mt-2 font-semibold text-gray-900 tracking-wider">
            <a class="" href="{{ route('product.show', compact('product')) }}">
                <span aria-hidden="true" class="absolute inset-0"></span>
                {{ $product->title }}
            </a>
        </h3>

        <!-- Product Price -->
        <div class="mt-2 flex items-baseline space-x-1.5">
            @if($product->discount)
                <div class="text-sm text-gray-800">${{ $product->discount }}</div>
            @endif

            <div class="{{ ($product->discount ? 'text-xs text-red-600 line-through' : 'text-sm text-gray-800')  }} ">
                ${{ $product->price }}
            </div>
        </div>

        <!-- Product Quantity -->
        <div class="mt-1.5 whitespace-nowrap">
            @if(!$product->quantity)
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-600">
                Out of stock
            </span>
            @elseif($product->quantity < 5)
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-600">
                Only {{ $product->quantity }}
            </span>
            @else
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-600">
                In Stock
            </span>
            @endif
        </div>
    </div>

    <div class="flex-grow flex">
        <!-- Add to Cart -->
        @if($product->quantity)
            <form id="add-to-cart" method="POST" action="{{ route('cart.add', compact('product')) }}">
                @csrf
            </form>
            <span onclick="document.getElementById('add-to-cart').submit()"  class="self-end w-full mt-4 block px-4 py-2 text-sm font-semibold text-center rounded-md text-gray-600 cursor-pointer hover:text-white leading-5 bg-gray-200 hover:bg-gray-600 focus:outline-none focus:bg-gray-600 transition duration-150 ease-in-out">
                    Add to Cart
            </span>
        @else
            <a class="self-end w-full mt-4 block px-4 py-2 opacity-70 text-sm font-semibold text-center rounded-md text-gray-600 cursor-not-allowed leading-5 bg-gray-200">
                Out of stock
            </a>
        @endif
    </div>
</div>
