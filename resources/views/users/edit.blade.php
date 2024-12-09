<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 block w-full">
                        </div>

                        <div class="mt-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 block w-full">
                        </div>

                        <div class="mt-4">
                            <label for="role_id" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role_id" id="role_id" class="mt-1 block w-full">
                                <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>User</option>
                            </select>
                        </div>

                        <div class="mt-6 flex justify-between items-center">
                            <button type="submit" class="ml-4 bg-gray-500 text-white px-4 py-2 rounded">Update</button>
                            <a href="{{ route('admin.dashboard') }}" class="ml-4 bg-gray-500 text-white px-4 py-2 rounded text-end">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
