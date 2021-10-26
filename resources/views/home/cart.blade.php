<x-guest-layout>

    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Shopping cart') }}
            </h2>
        </div>
    </header>

    <!-- Page Content -->
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-4 lg:col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white">

                            <div class="flex items-center justify-between">
                                <h4 class="text-lg font-semibold tracking-wide text-gray-700">
                                    Cart list
                                </h4>
                                <a class="block px-4 py-2 text-sm rounded-md text-indigo-600 hover:text-white leading-5 border-2 border-indigo-600 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600 transition duration-150 ease-in-out" href="{{ route('products.index')}}">Continue Shopping<span> &rarr;</span></a>
                            </div>

                            <!-- carts list -->
                            <div class="shadow-sm mt-4 overflow-auto border-b border-gray-200 rounded-lg">
                                <table class="table-auto min-w-full divide-y divide-gray-200 ">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Price
                                        </th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Subtotal
                                        </th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach(Cart::all() as $cart)
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-14 w-14">
                                                        <img class="w-full h-full object-center object-cover lg:w-full lg:h-full rounded" src="{{ $cart['product']->image }}" alt="{{ $cart['product']->name }}">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm text-gray-900 leading-relaxed">
                                                            {{ $cart['product']->title }}2
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    ${{ $cart['product']->price }}
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                @if(!$cart['product']->quantity)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-600">
                                                        Out of stock
                                                    </span>
                                                @else
                                                    <select onchange="changeQuantity(event, '{{ $cart['id'] }}')" class="text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                        @foreach(range(1 , $cart['product']->quantity) as $item)
                                                            <option value="{{ $item }}" {{  $cart['quantity'] == $item ? 'selected' : '' }}>{{ $item }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap ">
                                                <div class="flex items-baseline justify-center space-x-1.5">
                                                    <div class=" {{ ($cart['product']->discount ? 'text-xs text-red-600 line-through' : 'text-sm text-gray-900')  }} ">
                                                        ${{ $cart['product']->price * $cart['quantity'] }}
                                                    </div>

                                                    @if($cart['product']->discount)
                                                        <div class="ml-2 text-sm text-gray-900">${{ $cart['product']->discount * $cart['quantity'] }}</div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <form id="cart-delete-{{ $cart['id'] }}" method="POST" action="{{ route('cart.destroy', $cart['id']) }}">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <span class="pr-2 text-red-500 cursor-pointer text-lg" onclick="document.getElementById('cart-delete-{{ $cart['id'] }}').submit()">
                                                        &times;
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="self-start col-span-4 lg:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4">
                            @php
                                $noDiscountPrice = Cart::all()->sum(function($cart) {
                                        return $cart['product']->price * $cart['quantity'];
                                        });

                                $discountedPrice = Cart::all()->sum(function($cart) {
                                            $discounted = $cart['product']->discount ?? $cart['product']->price;
                                            return  $discounted * $cart['quantity'];
                                        })
                            @endphp
                            <h4 class="font-semibold text-lg text-gray-800 leading-tight">Order Summery</h4>
                            <div class="mt-4 bg-gray-100 px-4 py-2 rounded-lg">
                                <div class="py-2 flex justify-between border-b">
                                    <span class="text-gray-500">Total:</span>
                                    <span class="text-gray-800">${{ $noDiscountPrice }}</span>
                                </div>

                                <div class="py-2 flex justify-between border-b">
                                    <span class="text-gray-500" >Discount:</span>
                                    <span class="text-gray-800">
                                        %{{ $noDiscountPrice ? round(100 * ($noDiscountPrice - $discountedPrice) / $noDiscountPrice,2) : 0 }}
                                    </span>
                                </div>

                                <div class="py-2 flex justify-between border-b">
                                    <span class="text-green-500">You Save:</span>
                                    <span class="text-green-500">${{ $noDiscountPrice - $discountedPrice }}</span>
                                </div>
                                <div class="py-2 font-semibold text-gray-800 flex justify-between">
                                    <span>Order Total:</span>
                                    <span>${{ $discountedPrice }}</span>
                                </div>
                            </div>
                            <x-new-link-button :href="'#'" class="mt-4 text-center font-semibold">Checkout</x-new-link-button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <script>
        function changeQuantity(event, id) {
            axios.patch('/cart/quantity/update', {
                id : id ,
                quantity : event.target.value,
            }, {
                headers : {
                    'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type' : 'application/json'
                }
            }).then(() => location.reload())
            .catch(function (error) {
               console.log(error);
            });
        }

    </script>

</x-guest-layout>
