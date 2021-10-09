<x-guest-layout>

    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>
        </div>
    </header>

    <!-- Page Content -->
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-4 gap-4">
                    <div class="self-start col-span-4 lg:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-2">
                            search and filters later
                        </div>
                    </div>
                    <div class="col-span-4 lg:col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white grid grid-cols-6 gap-6">
                            @foreach($products as $product)
                                <x-product-card class="col-span-6 sm:col-span-3 md:col-span-2" :product="$product"/>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>

</x-guest-layout>
