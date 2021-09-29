<x-admin-panel-layout>
    <div class="flex items-center justify-between">
        <h4 class="text-lg font-semibold tracking-wide text-gray-500">
            Categories list
        </h4>
        <x-new-link-button :href="route('admin.categories.create')">New Category</x-new-link-button>
    </div>

    <!-- Categories list -->
    <div class="shadow-sm mt-4 overflow-auto border-b border-gray-200 rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 ">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Parent
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <tr>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">Laptop</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">Digital</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium space-x-1.5">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Show</a>
                    <a href="#" class="text-yellow-500 hover:text-yellow-900">Edit</a>
                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                </td>
            </tr>

            </tbody>
        </table>
    </div>


</x-admin-panel-layout>

