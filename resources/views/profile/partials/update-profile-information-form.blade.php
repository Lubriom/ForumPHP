<section>
    <div>
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="flex flex-col"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="flex flex-row gap-4 mt-0 justify-between">
                <div class="flex-1 space-y-6">
                    <header class="w-full">
                        <h2 class="text-lg font-medium text-black">
                            {{ __('Información del Perfil') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-800 ">
                            {{ __('Actualiza la información de tu perfil.') }}
                        </p>
                    </header>
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                            :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification"
                                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-4 flex-col flex-1">
                    <img src="{{ route('images.get', ['filename' => Auth::user()->img_perfil]) }}" alt="profile photo"
                        class="w-64 h-64 rounded-full object-cover">
                    <x-input-label for="img_perfil" :value="__('Imagen de Perfil')" />
                    <x-text-input id="img_perfil" name="img_perfil" type="file" class="mt-1 block w-full" />
                    <x-input-error class="mt-2" :messages="$errors->get('img_perfil')" />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Guardar') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>
