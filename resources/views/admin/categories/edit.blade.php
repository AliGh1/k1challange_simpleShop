<x-admin-panel-layout>

    <h4 class="text-lg font-semibold tracking-wide text-gray-500">
        Edit Category
    </h4>

    <div class="mt-4">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method("PATCH")

            <!-- Category name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $category->name)" required autofocus />
            </div>

            <!-- Category parent -->
            <div class="mt-4">
                <x-label for="parent" :value="__('Parent')" />

                <select id="parent" name="parent_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="0"></option>
                    @foreach(\App\Models\Category::all() as $cate)
                        <option value="{{ $cate->id }}" {{ $cate->id === $category->parent_id ? 'selected' : '' }}>{{ $cate->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Edit Category') }}
                </x-button>
            </div>
        </form>
    </div>


</x-admin-panel-layout>
