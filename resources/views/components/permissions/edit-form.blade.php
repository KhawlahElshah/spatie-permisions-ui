@props(['permission'])

<form action="{{ route('permissions.update', $permission) }}" method="post">
    @csrf
    @method('PATCH')

    <div class='w-full md:w-full px-3 mb-6'>
        <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>
            {{ __('spatie-permissions-ui::permissions.permission_name') }}
        </label>
        <input name="name" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500
            @error(' name') border-red-500 @enderror' type='text' value="{{ $permission->name }}" required>

        @error('name')
        <p class="text-red-500 text-xs italic mt-2">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="flex justify-end">
        <button class="appearance-none bg-gray-700 text-white p-2 rounded mr-3"
            type="submit">{{ __('spatie-permissions-ui::permissions.submit') }}</button>
    </div>
</form>
