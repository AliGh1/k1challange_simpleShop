<x-admin-panel-layout>

    <h4 class="text-lg font-semibold tracking-wide text-gray-500">
        Add Image
    </h4>

    <div class="mt-4">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('admin.products.gallery.store', $product) }}" enctype="multipart/form-data">
        @csrf

            <!-- Image -->
            <div>
                <x-label for="image" >{{ __('Image') }} <span class="ml-1 text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</span></x-label>
                <x-input id="image" class="block w-full px-1 py-1.5 mt-1 rounded-md border-2 border-dashed" type="file" name="image" required/>
            </div>

            <!-- Alt -->
            <div class="mt-4">
                <x-label for="alt" :value="__('Alt')" />
                <x-input id="alt" class="block mt-1 w-full" type="text" name="alt" :value="old('alt')" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Add Image') }}
                </x-button>
            </div>
        </form>
    </div>


</x-admin-panel-layout>
