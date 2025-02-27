<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Control') }}
        </h2>
    </x-slot>


    <div class="py-6 justify-center">
        @if (session('status'))
            <div class="max-w-7xl mx-auto rounded-md">
                <div class="bg-blue-500 text-white text-center py-2 rounded-lg mb-4">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto rounded-md">
                <div class="bg-red-500 text-white text-center py-2 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div
            class="max-w-7xl mx-auto p-4 rounded-md bg-slate-900 border border-white/20 shadow-lg">
            <table class="table-auto w-full text-gray-50 dark:bg-slate-500 rounded-lg overflow-hidden shadow-lg">
                <thead>
                    <tr class="dark:bg-gray-800 text-gray-100">
                        <th class="px-6 py-3 text-left font-semibold text-lg">ID</th>
                        <th class="px-6 py-3 text-left font-semibold text-lg">Nombre</th>
                        <th class="px-6 py-3 text-left font-semibold text-lg">Correo</th>
                        <th class="px-6 py-3 text-left font-semibold text-lg">Rol</th>
                        <th class="px-6 py-3 text-left font-semibold text-lg">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr
                            class="bg-slate-700 hover:bg-slate-600 dark:hover:bg-gray-600 rounded-xl transition duration-200 ease-in-out">
                            <td class="px-6 py-4">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                @foreach ($user->roles as $role)
                                    <span class="inline-block text-sm text-gray-300">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 flex gap-2 justify-start items-center">
                                <a href="{{ route('edit.users', $user) }}"
                                    class="px-4 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-700 transition duration-300">
                                    Editar
                                </a>

                                @can('admin.del.user')
                                    <form action="{{ route('admin.del.user', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-800 transition duration-300">
                                            Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pt-2 text-white">
                {{ $users->links('pagination::tailwind') }}
            </div>
        </div>

    </div>
</x-app-layout>
