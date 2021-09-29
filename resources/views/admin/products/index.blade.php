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
            <tr>
                <td class="px-4 py-2">
                    <div class="h-14 w-14">
                        <img class="h-14 w-14 rounded" src="https://fakeimg.pl/200/" alt="fake img">
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">Iphone 13 Pro Max 512GB Midnight Black</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-red-600 line-through">10,000$</div>
                    <div class="text-sm text-gray-500">8,000$</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-600">
                      Out of stock
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium space-x-1.5">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Gallery</a>
                    <a href="#" class="text-yellow-500 hover:text-yellow-900">Edit</a>
                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                </td>
            </tr>

            <tr>
                <td class="px-4 py-2">
                    <div class="h-14 w-14">
                        <img class="h-14 w-14 rounded" src="https://fakeimg.pl/200/" alt="fake img">
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">PlayStation 5 Console</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm">1,000$</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900 px-2">15</div>
                </td>
                <td class="px-6 py-4 text-left text-sm font-medium space-x-1.5">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Gallery</a>
                    <a href="#" class="text-yellow-500 hover:text-yellow-900">Edit</a>
                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                </td>
            </tr>

            <!-- More people... -->
            </tbody>
        </table>
    </div>


</x-admin-panel-layout>
