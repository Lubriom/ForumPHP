<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-white leading-tight">
            {{ __('Hilos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @isset($hilos)
            @foreach ($hilos as $hilo)
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <a href="{{ route('verPost', $hilo->id) }}"
                        class="block transform transition-all duration-300 ease-in-out hover:scale-[1.03]">
                        <div
                            class="bg-gradient-to-r from-white/30 to-white/40 backdrop-blur-lg border border-white/40 rounded-3xl shadow-2xl overflow-hidden">
                            <div class="p-6 border-b border-white/20">
                                <div class="flex justify-between items-center flex-wrap">
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 truncate">
                                        {{ $hilo->titulo }}
                                    </h2>
                                    <p class="text-sm dark:text-gray-100">
                                        {{ $hilo->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <div class="p-6 text-gray-800 dark:text-gray-200 text-lg leading-relaxed">
                                {{ $hilo->mensaje }}
                            </div>

                            <div class="p-6 border-t border-white/20 flex items-center justify-between">
                                <p class="font-semibold text-gray-50">
                                    Hecho por: <span class="text-black">{{ $hilo->user->name }}</span>
                                </p>
                                <p class="font-semibold text-gray-200">
                                    Posts: {{ $hilo->post_total }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <br>
            @endforeach
        @endisset
    </div>
</x-app-layout>
