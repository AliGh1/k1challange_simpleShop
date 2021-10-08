<x-admin-panel-layout>

    <h4 class="text-lg font-semibold tracking-wide text-gray-500">
        Edit Image
    </h4>

    <div class="mt-4">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('admin.products.gallery.update', [$product, $gallery]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Image -->
            <div class="mt-4">
                <x-label for="image" >{{ __('Image') }} <span class="ml-1 text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</span></x-label>

                <div class="mt-2" x-data="{ status : 'inactive' }">
                    <x-button @click.prevent="status = 'active'" >Change Image</x-button>
                    <x-button @click.prevent="status = 'inactive'" >Cancel</x-button>

                    <template x-if="status === 'inactive'">
                        <x-input id="image" class="block mt-1 w-full text-gray-400 mt-2" type="text" name="image" :value="$gallery->image" readonly/>
                    </template>

                    <template x-if="status === 'active'">
                        <x-input id="image" class="block w-full px-1 py-1.5 mt-2 rounded-md border-2 border-dashed" type="file" name="image" />
                    </template>
                </div>

            <!-- Alt -->
            <div class="mt-4">
                <x-label for="alt" :value="__('Alt')" />
                <x-input id="alt" class="block mt-1 w-full" type="text" name="alt" :value="old('alt', $gallery->alt)" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Edit Image') }}
                </x-button>
            </div>
        </form>
    </div>


</x-admin-panel-layout>
