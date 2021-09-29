<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-4">
                <div class="auto-rows-auto col-span-4 lg:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 flex flex-wrap lg:block bg-white lg:space-y-1">
                        <x-responsive-nav-link :class="'rounded mx-1 lg:mx-0'" :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')">
                            {{ __('Products') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :class="'rounded mx-1 lg:mx-0'" :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')">
                            {{ __('Categories') }}
                        </x-responsive-nav-link>
                    </div>
                </div>
                <div class="col-span-4 lg:col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white">
                        {{ $slot ?? "You're logged as admin!" }}
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
