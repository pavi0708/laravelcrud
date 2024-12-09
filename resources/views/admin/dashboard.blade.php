<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('admin.Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <!-- Add User Button -->
                        <a href="{{ route('users.create') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-blue-700">
                            Add User
                        </a>
                    </div>

                    <table class="table-auto w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Role</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td class="border px-4 py-2">{{ $user->name }}</td>
                                <td class="border px-4 py-2">{{ $user->email }}</td>
                                <td class="border px-4 py-2">
                                    {{ $user->role_id == 1 ? 'Admin' : 'User' }}
                                </td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500">Edit</a> |
                                    <!-- Delete Button -->
                                    <a href="javascript:void(0)" onclick="confirmDeletion({{ $user->id }})" class="text-red-500">Delete</a>

                                    <!-- Hidden Delete Form -->
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="border px-4 py-2 text-center">No Users Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
