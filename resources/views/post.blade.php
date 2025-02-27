<x-app-layout>
    <div class="py-12">
        @isset($hilo)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-gradient-to-r from-white/30 to-white/40 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl overflow-hidden">
                    <div class="p-6 border-b border-white/20">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-bold tracking-wide text-gray-900 dark:text-gray-100">
                                {{ $hilo->titulo }}
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ $hilo->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    <div class="p-6 text-lg text-gray-800 dark:text-gray-200 leading-relaxed">
                        {{ $hilo->mensaje }}
                    </div>

                    <div class="p-6 border-t border-white/20 flex items-center justify-between">
                        <p class="font-semibold text-gray-50">
                            Hecho por: <span class="text-black">{{ $hilo->user->name }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <br>
        @endisset
        @isset($posts)
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div
                            class="bg-white/30 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl overflow-hidden">
                            <div class="flex items-center justify-between p-4 border-b border-white/20">
                                <div class="flex items-center space-x-3">
                                    <img class="w-8 h-8 rounded-full object-cover"
                                        src="{{ route('images.get', ['filename' => $post->user->img_perfil]) }}"
                                        alt="Imagen de perfil">
                                    <span
                                        class="text-gray-900 dark:text-gray-100 font-semibold">{{ $post->user->name }}</span>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <p class="text-gray-900 dark:text-gray-100 items-center justify-center">❤️
                                        {{ $post->likes->count() }}</p>
                                    <form action="{{ route('user.like.post', $post) }}" class="items-center justify-center"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="text-red-500 hover:scale-110 transition flex justify-center items-center">
                                            @if ($post->likes()->where('user_id', auth()->id())->exists())
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="red" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path
                                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                                </svg>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="p-6 text-gray-900 dark:text-gray-100 text-lg">
                                {{ $post->mensaje }}
                            </div>

                            <div class="flex items-center justify-between p-4 border-t border-white/20">
                                <p class="text-black text-sm">{{ $post->created_at->diffForHumans() }}</p>
                                @can('admin.del.post')
                                    <form action="{{ route('admin.del.post', $post) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 p-2 rounded-lg hover:bg-red-800 transition flex items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#FFF"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M9 3V2a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h5a1 1 0 1 1 0 2h-1v15a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V5H3a1 1 0 0 1 0-2h5zm2-1v1h2V2h-2zM6 5v15a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H6zm4 3a1 1 0 0 1 1 1v9a1 1 0 1 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v9a1 1 0 1 1-2 0V9a1 1 0 0 1 1-1z" />
                                            </svg>
                                            <span class="text-white text-sm">Eliminar</span>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
            @else
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 rounded">
                    <div
                        class="bg-gradient-to-r from-white/30 to-white/40 backdrop-blur-lg border border-white/20 overflow-hidden rounded-2xl shadow-xl">
                        <div class="p-6">
                            Este hilo no tiene posts aún
                        </div>
                    </div>
                </div>
                <br>
            @endif
        @endisset

        @isset($hilo)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 rounded">
                <div
                    class="bg-gradient-to-r from-white/30 to-white/40 backdrop-blur-lg border border-white/20 overflow-hidden rounded-2xl shadow-xl px-6 pb-6">
                    <form method="POST" action="{{ route('user.create.post', $hilo) }}" class="text-black">
                        @csrf
                        <div class="mt-4">
                            <label for="postmsg">Mensaje</label>
                            <textarea id="postmsg" class="block mt-1 w-full rounded-lg bg-white/70" name="postmsg" value="{{ old('postmsg') }}"></textarea>
                            @error('postmsg')
                                <p class="text-red-600 pt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Crear Post') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        @endisset

    </div>
</x-app-layout>
