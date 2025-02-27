<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Usuario:') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div
                class="flex w-full p-4 sm:p-8 bg-gradient-to-r from-white/30 to-white/40 backdrop-blur-lg border border-white/20 rounded-2xl overflow-hidden sm:rounded-lg shadow-xl">
                <div class="w-full flex">
                    @isset($user)
                        <form action="{{ route('update.users', $user) }}" method="POST" enctype="multipart/form-data" class="flex flex-col w-full">
                            @csrf
                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Nombre')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Correo Electronico')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Imagen -->
                            <div class="mt-4">
                                <label for="img_perfil" class="form-label">Imagen</label>
                                <x-text-input id="img_perfil" class="block mt-1 w-full" type="file" name="img_perfil"
                                    autocomplete="img_perfil" />
                                <x-input-error :messages="$errors->get('img_perfil')" class="mt-2" />
                            </div>
                            @can('admin.edit.rol')
                                <div class="mt-4">
                                    <x-input-label for="rol" :value="__('Rol')" />
                                    <select name="rol" id="rol" class="block mt-1 w-full">
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol }}" {{ $user->hasRole($rol) ? 'selected' : '' }}>
                                                {{ $rol }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('rol')" class="mt-2" />
                                </div>
                            @endcan
                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Contraseña')" />

                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">
                                    {{ __('Modificar Datos') }}
                                </x-primary-button>
                            </div>
                        </form>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
