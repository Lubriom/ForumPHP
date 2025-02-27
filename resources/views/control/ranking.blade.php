<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ranking de usuarios con más me gusta.') }}
        </h2>
    </x-slot>

    <div class="py-12 text-gray-50 dark:text-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-white/30 to-white/40 backdrop-blur-lg border border-white/20 rounded-2xl overflow-hidden sm:rounded-lg shadow-xl p-4"> 
                <ol class="space-y-4">
                    @isset($top) 
                        @foreach ($top as $index => $user)
                            <li class="p-4 bg-white dark:bg-gray-700 rounded-lg shadow hover:bg-gray-50 dark:hover:bg-gray-600">
                                <p class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                    <span class="text-blue-500">{{ $index + 1 }}.</span> {{ $user->name }} - 
                                    <span class="text-yellow-500">{{ $user->total_likes }} me gusta</span>
                                </p>
                            </li>
                        @endforeach
                    @endisset
                </ol> 
            </div> 
        </div>
    </div> 
</x-app-layout>
