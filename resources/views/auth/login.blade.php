{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logoFivecar.png') }}" type="image/x-icon">
    <title>Login - FiveCar</title>
</head>

<div class="h-screen bg-[#121212]">
    @include('navbar')
    
    <div class="flex items-center justify-center pt-32 mb-8">
        <div class="w-[90%] sm:w-[70%] md:w-[50%] lg:w-[35%] px-4 bg-[#181818] rounded-lg">
            {{-- <x-authentication-card> --}}
                {{-- <x-slot name="logo"> --}}
                <div>
                    <a href="{{ route('home') }}" class="flex items-center justify-center space-x-3 rtl:space-x-reverse">
                        <img src="{{ asset('images/logoFivecar.png') }}" class="h-24" alt="FiveCar Logo">
                        {{-- <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">FiveCar</span> --}}
                    </a>
                </div>
                {{-- </x-slot> --}}
    
                <x-validation-errors class="mb-4" />
    
                @session('status')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ $value }}
                    </div>
                @endsession
    
                <form method="POST" action="{{ route('login') }}">
                    @csrf
    
                    <div>
                        <x-label for="email" value="{{ __('Email') }}" class="text-white"/>
                        <x-input id="email" class="block mt-1 w-full bg-[#222] text-white border-none
                            focus:ring-red-500 focus:border-red-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>
    
                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" class="text-white"/>
                        <x-input id="password" class="block mt-1 w-full bg-[#222] text-white border-none
                            focus:ring-red-500 focus:border-red-500" type="password" name="password" required autocomplete="current-password" />
                    </div>
    
                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" 
                            class="text-red-600 rounded-sm focus:ring-red-600 ring-offset-gray-800 focus:ring-2 bg-[#222] border-gray-600"/>
                            <span class="ms-2 text-sm text-white/50">{{ __('Remember me') }}</span>
                        </label>
                    </div>
    
                    <div class="flex items-center justify-end mt-4 gap-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-white/50 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
    
                        <x-button class="text-center text-white bg-gradient-to-b from-red-600 to-red-800 hover:from-red-500 hover:to-red-700 font-medium rounded-lg text-sm py-2.5 px-6">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>
            {{-- </x-authentication-card> --}}
        </div>
    </div>
    
    @include('footer')
</div>