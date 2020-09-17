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
        @forelse (Spatie\Permission\Models\Permission::all() as $permission)
        <tr>
            <td class="">
                {{ $permission->id }}
            </td>
            <td class="">
                {{ $permission->name }}
            </td>
            <td class="">
                {{ trans($permission->name) }}
            </td>
            <td class="">
                {{ $permission->created_at->toDateString() }}
            </td>
            <td class="">
                <a href="{{ route('permissions.edit', $permission) }}">
                    {{ __('spatie-permissions-ui::permissions.edit') }}
                </a>

                <form action="{{ route('permissions.destroy', $permission) }}" method="post">
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
                {{ __('spatie-permissions-ui::permissions.no_permissions_added') }}
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
