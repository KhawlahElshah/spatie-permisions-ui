@props(['permissions'])

<form action="{{ route('roles.store') }}" method="post">
    @csrf

    <div class='w-full md:w-full'>
        <div class="px-3 mb-6">
            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                for='grid-text-1'>{{ __('spatie-permissions-ui::permissions.role_name') }}</label>
            <input name="name" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500
        @error(' name') border-red-500 @enderror' id='grid-text-1' type='text' required>

            @error('name')
            <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="px-3 mb-6">
            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                for='grid-text-1'>{{ __('spatie-permissions-ui::permissions.permissions') }}</label>

            <div class="flex flex-wrap">
                @foreach ($permissions as $permission)
                <div class="w-1/2 flex items-center text-gray-700">
                    <label>
                        <input class="h-4 w-4" type="checkbox" name="permissions[]" value="{{ $permission->id }}" />
                        <span>
                            {{ __($permission->name) }}
                        </span>
                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <button class="appearance-none bg-gray-700 text-white p-2 rounded mr-3"
            type="submit">{{ __('spatie-permissions-ui::permissions.submit') }}</button>
    </div>
</form>
