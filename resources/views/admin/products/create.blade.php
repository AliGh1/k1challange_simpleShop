<x-admin-panel-layout>

    <h4 class="text-lg font-semibold tracking-wide text-gray-500">
        Add Product
    </h4>

    <!-- Product list -->
    <div class="mt-4">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf

            <!-- Product Title -->
            <div>
                <x-label for="title" :value="__('Title')" />
                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"
                         required autofocus />
            </div>

            <!-- Product Description -->
            <div class="mt-4">
                <label for="description" class="block font-medium text-sm text-gray-700">{{ __('Description') }}</label>
                <textarea id="description" name="description" class="block mt-1 w-full rounded-md shadow-sm
                 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
                  focus:ring-opacity-50" required>{{ old('description') }}</textarea>
            </div>

            <!-- Product Thumbnail Image -->
            <div class="mt-4">
                <x-label for="image" >{{ __('Thumbnail Image') }} <span class="ml-1 text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</span></x-label>
                <x-input id="image" class="block w-full px-1 py-1.5 mt-1 rounded-md border-2 border-dashed" type="file" name="image" required/>
            </div>

            <div class="grid grid-cols-6 gap-x-6">
                <!-- Product Price -->
                <div class="mt-4 col-span-6 sm:col-span-3 md:col-span-2">
                    <x-label for="price" :value="__('Price')" />
                    <x-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required/>
                </div>

                <!-- Product Discount -->
                <div class="mt-4 col-span-6 sm:col-span-3 md:col-span-2">
                    <x-label for="discount" :value="__('Discount')" />
                    <x-input id="discount" class="block mt-1 w-full" type="number" name="discount" :value="old('discount')"/>
                </div>

                <!-- Product Quantity -->
                <div class="mt-4 col-span-6 sm:col-span-6 md:col-span-2">
                    <x-label for="quantity" :value="__('Quantity')" />
                    <x-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity')" required/>
                </div>
            </div>

            <!-- Category -->
            <div class="mt-4">
                <label for="categories" class="block font-medium text-sm text-gray-700">{{ __('Categories') }}</label>

                <select id="categories" name="categories[]" class="block mt-1 w-full rounded-md shadow-sm border-gray-300
                 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Add Product') }}
                </x-button>
            </div>
        </form>
    </div>


</x-admin-panel-layout>
