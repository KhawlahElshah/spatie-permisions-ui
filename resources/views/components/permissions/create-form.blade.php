<form action="{{ route('permissions.store') }}" method="post">
    @csrf

    <div class='w-full md:w-full px-3 mb-6'>

        <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
            for='grid-text-1'>{{ __('permissions.permission_name') }}</label>

        <input name="name" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500
            @error(' name') border-red-500 @enderror' id='grid-text-1' type='text' required>

        @error('name')
        <p class="text-red-500 text-xs italic mt-2">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="flex justify-end">
        <button class="appearance-none bg-gray-700 text-white p-2 rounded mr-3"
            type="submit">{{ __('permissions.submit') }}</button>
    </div>
</form>
