@props(['permissions', 'user'])

<form action="{{ route('users.attach-permissions', $user) }}" method="post">
    @csrf
    @method('PATCH')

    <div class="px-3 mb-6">
        <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
            for='grid-text-1'>{{ __('spatie-permissions-ui::permissions.permissions') }}</label>

        <div class="flex flex-wrap">
            @foreach ($permissions as $permission)
            <div class="w-1/2 my-1 flex items-center text-gray-700">
                <label>
                    <input class="h-4 w-4" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                        {{  in_array($permission->name, $user->getAllPermissions()->pluck('name')->toArray()) ? 'checked' : '' }} />
                    <span>
                        {{ __($permission->name) }}
                    </span>
                </label>
            </div>
            @endforeach
        </div>
    </div>

    <div class="flex justify-end">
        <button class="appearance-none bg-gray-700 text-white p-2 rounded mr-3"
            type="submit">{{ __('spatie-permissions-ui::permissions.submit') }}</button>
    </div>
</form>
