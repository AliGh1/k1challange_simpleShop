<x-admin-panel-layout>
    <div class="flex items-center justify-between">
        <h4 class="text-lg font-semibold tracking-wide text-gray-500">
            Products list
        </h4>
        <x-new-link-button :href="route('admin.products.create')">New Product</x-new-link-button>
    </div>

    <!-- Products list -->
    <div class="shadow-sm mt-4 overflow-auto border-b border-gray-200 rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 ">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Image
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Title
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Price
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Inventory
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($products as $product)
                <tr>
                    <td class="px-4 py-2">
                        <div class="h-14 w-14">
                            <img class="h-14 w-14 rounded" src="{{ $product->image }}" alt="{{ $product->name }}">
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $product->title }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm {{ ($product->discount ? 'text-red-600 line-through' : 'text-gray-900')  }} ">
                            {{ $product->price }}$
                        </div>

                        @if($product->discount)
                            <div class="text-sm text-gray-500">{{ $product->discount }}$</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if(!$product->quantity)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-600">
                              Out of stock
                            </span>
                        @elseif($product->quantity < 5)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-600">
                              Only {{ $product->quantity }}
                            </span>
                        @else
                            <div class="text-sm px-2 text-gray-900">{{ $product->quantity}}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium space-x-1.5">
                        <a href="{{ route('admin.products.gallery.index', $product) }}" class="text-indigo-600 hover:text-indigo-900">Gallery</a>
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-yellow-500 hover:text-yellow-900">Edit</a>
                        <form class="inline" action="{{ route('admin.products.destroy' , $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>


    </div>
    <div class="mt-4">
        {{ $products->render() }}
    </div>


</x-admin-panel-layout>
