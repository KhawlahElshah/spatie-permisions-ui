<table class="min-w-full leading-normal">
    <thead>
        <tr>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                #
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                {{ trans('spatie-permissions-ui::permissions.name') }}
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                {{ trans('spatie-permissions-ui::permissions.display_name') }}
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                {{ trans('spatie-permissions-ui::permissions.created_at') }}
            </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse (Spatie\Permission\Models\Permission::all() as $permission)
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-900">
                {{ $permission->id }}
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-900">
                {{ $permission->name }}
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-900">
                {{ trans($permission->name) }}
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-900">
                {{ $permission->created_at->toDateString() }}
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-900">
                <a href="{{ route('permissions.edit', $permission) }}" class="underline">
                    {{ trans('spatie-permissions-ui::permissions.edit') }}
                </a>

                <form action="{{ route('permissions.destroy', $permission) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        onclick="return confirm('{{ trans('spatie-permissions-ui::permissions.sure_you_want_to_delete') }}')"
                        class="underline text-red-500">
                        {{ trans('spatie-permissions-ui::permissions.delete') }}
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="bg-white text-gray-600 p-5 text-sm text-center">
                {{ trans('spatie-permissions-ui::permissions.no_permissions_added') }}
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
