<x-admin-panel-layout>
    <div class="flex items-center justify-between">
        <h4 class="text-lg font-semibold tracking-wide text-gray-500">
            {{ $product->title }} Gallery
        </h4>

        @if(count($galleries) < 5)
            <x-new-link-button :href="route('admin.products.gallery.create', $product)">New Image</x-new-link-button>
        @endif

    </div>

    <!-- Images list -->
    <div class="shadow-sm mt-4 overflow-auto border-b border-gray-200 rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 ">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Image
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Alt
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($galleries as $gallery)
                <tr>
                    <td class="px-4 py-2">
                        <div class="h-32">
                            <img class="h-32 rounded" src="{{ $gallery->image }}" alt="{{ $gallery->alt }}">
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $gallery->alt }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium space-x-1.5">
                        <a href="{{ $gallery->image }}" class="text-indigo-600 hover:text-indigo-900">Show</a>
                        <a href="{{ route('admin.products.gallery.edit', [$product, $gallery]) }}" class="text-yellow-500 hover:text-yellow-900">Edit</a>
                        <form class="inline" action="{{ route('admin.products.gallery.destroy', [$product, $gallery]) }}" method="POST">
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


</x-admin-panel-layout>
