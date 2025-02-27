<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crea un nuevo hilo') }}
        </h2>
    </x-slot>
    <form method="POST" action="{{ route('user.create.hilo') }}" class="text-black">
        @csrf

        <!-- Name -->
        <div>
            <label for="hiloname">Nombre del Hilo</label>
            <input id="hiloname" class="block mt-1 w-full rounded-lg bg-white/70" type="text" name="hiloname"
                value="{{ old('hiloname') }}" />
            @error('hiloname')
                <p class="text-red-600 pt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="hilomsg">Contenido del Hilo</label>
            <textarea id="hilomsg" class="block mt-1 w-full rounded-lg bg-white/70" name="hilomsg" value="{{ old('hilomsg') }}"></textarea>
            @error('hilomsg')
                <p class="text-red-600 pt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="ms-4">
                {{ __('Crear Hilo') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
