<form action="{{ route('users.update', $user) }}" method="post">
    @csrf
    @method('PATCH')

    <div class='w-full md:w-full'>
        <div class="px-3 mb-6">
            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                for='grid-text-1'>{{ __('permissions.name') }}</label>
            <input name="name" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500
                @error(' name') border-red-500 @enderror' id='grid-text-1' type='text' value="{{ $user->name }}"
                required>

            @error('name')
            <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="px-3 mb-6">
            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                for='grid-text-1'>{{ __('permissions.email') }}</label>
            <input name="email" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500
                @error(' email') border-red-500 @enderror' id='grid-text-1' type='text' value="{{ $user->email }}"
                required>

            @error('email')
            <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="px-3 mb-6">
            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                for='grid-text-1'>{{ __('permissions.roles') }}</label>
            <div class="flex-shrink w-full inline-block relative">

                <select name="role" class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded
                    @error(' role') border-red-500 @enderror">
                    <option>{{ __('permissions.choose_a_role') }}</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}"
                        {{  in_array($role->name, $user->getRoleNames()->toArray()) ? 'selected' : '' }}>
                        {{ $role->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>

            @error('role')
            <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="px-3 mb-6">
            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                for='grid-text-1'>{{ __('permissions.permissions') }}</label>

            <div class="flex flex-wrap">
                @foreach ($permissions as $permission)
                <div class="w-1/2 my-1 flex items-center text-gray-700">
                    <label>
                        <input class="h-4 w-4" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                            {{  in_array($permission->name, $user->getPermissionNames()->toArray()) ? 'checked' : '' }} />
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
            type="submit">{{ __('permissions.submit') }}</button>
    </div>
</form>
