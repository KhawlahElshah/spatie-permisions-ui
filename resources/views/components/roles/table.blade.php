@props(['roles'])

<table class="min-w-full leading-normal">
    <thead>
        <tr>
            <th class="">
                #
            </th>
            <th class="">
                {{ __('spatie-permissions-ui::permissions.name') }}
            </th>
            <th class="">
                {{ __('spatie-permissions-ui::permissions.display_name') }}
            </th>
            <th class="">
                {{ __('spatie-permissions-ui::permissions.created_at') }}
            </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($roles as$role)
        <tr>
            <td class="">
                {{ $role->id }}
            </td>
            <td class="">
                {{ $role->name }}
            </td>
            <td class="">
                {{ __($role->name) }}
            </td>
            <td class="">
                {{ $role->created_at->toDateString() }}
            </td>
            <td class="">
                <a href="{{ route('roles.edit',$role) }}">
                    {{ __('spatie-permissions-ui::permissions.edit') }}
                </a>

                <form action="{{ route('roles.destroy',$role) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        onclick="return confirm('{{ __('spatie-permissions-ui::permissions.sure_you_want_to_delete') }}')">
                        {{ __('spatie-permissions-ui::permissions.delete') }}
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="">
                {{ __('spatie-permissions-ui::permissions.no_roles_added') }}
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
