{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
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
    <title>Register - FiveCar</title>
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

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <x-label for="name" value="{{ __('Name') }}" class="text-white"/>
                        <x-input id="name" class="block mt-1 w-full bg-[#222] text-white border-none
                            focus:ring-red-500 focus:border-red-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" class="text-white"/>
                        <x-input id="email" class="block mt-1 w-full bg-[#222] text-white border-none
                            focus:ring-red-500 focus:border-red-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" class="text-white"/>
                        <x-input id="password" class="block mt-1 w-full bg-[#222] text-white border-none
                            focus:ring-red-500 focus:border-red-500" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-white"/>
                        <x-input id="password_confirmation" class="block mt-1 w-full bg-[#222] text-white border-none
                            focus:ring-red-500 focus:border-red-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />

                                    <div class="ms-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <div class="flex items-center justify-end mt-4 gap-4">
                        <a class="underline text-sm text-white/50 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-button class="text-center text-white bg-gradient-to-b from-red-600 to-red-800 hover:from-red-500 hover:to-red-700 font-medium rounded-lg text-sm py-2.5 px-6">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
            {{-- </x-authentication-card> --}}
        </div>
    </div>

    @include('footer')
</div>

