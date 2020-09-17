@props(['roles', 'user'])

<form action="{{ route('users.attach-roles', $user) }}" method="post">
    @csrf
    @method('PATCH')

    <div class="px-3 mb-6">
        <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
            for='grid-text-1'>{{ __('spatie-permissions-ui::permissions.roles') }}</label>

        <div class="flex flex-wrap">
            @foreach ($roles as $role)
            <div class="w-1/2 my-1 flex items-center text-gray-700">
                <label>
                    <input class="h-4 w-4" type="checkbox" name="roles[]" value="{{ $role->id }}"
                        {{  in_array($role->name, $user->getRoleNames()->toArray()) ? 'checked' : '' }} />
                    <span>
                        {{ __($role->name) }}
                    </span>
                </label>

                <ul>
                    @foreach ($role->permissions as $permission)
                    <li>{{ $permission->name }}</li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>

    <div class="flex justify-end">
        <button class="appearance-none bg-gray-700 text-white p-2 rounded mr-3"
            type="submit">{{ __('spatie-permissions-ui::permissions.submit') }}</button>
    </div>
</form>
