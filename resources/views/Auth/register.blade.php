<x-layouts.guest>
    <x-slot name="title">Register</x-slot>

    <x-slot name="content">
        <div class="box-content w-[100%] h-[100%] absolute">
            <img src="{{ asset('images/ImControl/bg.jpg') }}" class="w-[100%] h-[100%]" alt="">
        </div>
        <div style="font-family: 'Manrope',serif;">
            <div class="box-content h-[85%] w-[75%] mt-[4%] ml-[20%] absolute z-30">
                <div class="box-content h-[90%] w-[100%] mt-[2%] ml-[3%] absolute">
                    <div class="max-w-md mx-auto overflow-hidden md:max-w-2xl">
                        <div class="md:flex">
                            <form action="" method="POST">
                                @csrf
                                <div class="p-1">
                                    <h2 class=" text-white text-5xl font-bold text-center mb-[4%]">Registrarse</h2>
                                    <div class="text-center">

                                        <!--Name -->
                                        <div class="w-full mb-2">
                                            <div class=" justify-center">
                                                <x-input-label for="name" :value="__('Name')"
                                                    class="text-white mb-2 text-2xl  font-bold" />
                                                <x-text-input id="name"
                                                    class="text-3xl rounded-lg px-8 w-3/4 border py-2 text-gray-700 items-center"
                                                    type="text" name="name" :value="old('name')" required autofocus
                                                    autocomplete="name" />
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>
                                        </div>

                                        <!--Email -->
                                        <div class="w-full mb-2">
                                            <div class="justify-center">
                                                <x-input-label for="email" :value="__('Email')"
                                                    class="text-white mb-2 text-2xl  font-bold" />
                                                <x-text-input id="email"
                                                    class="text-3xl rounded-lg px-8 w-3/4 border py-2 text-gray-700 items-center "
                                                    type="email" name="email" :value="old('email')" required autofocus
                                                    autocomplete="email" />
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                        </div>

                                        <!--Password -->
                                        <div class="w-full mb-2">
                                            <div class="justify-center">
                                                <x-input-label for="password" :value="__('Password')"
                                                    class="text-white mb-2 text-2xl  font-bold" />
                                                <x-text-input id="password"
                                                    class="text-3xl rounded-lg px-8 w-3/4 border py-2 text-gray-700 items-center "
                                                    type="password" name="password" :value="old('password')" required autofocus
                                                    autocomplete="password" />
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                        </div>

                                        <!--Confirm Password -->
                                        <div class="w-full mb-2">
                                            <div class="justify-center">
                                                <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                                                    class="text-white mb-2 text-2xl  font-bold" />
                                                <x-text-input id="password_confirmation"
                                                    class="text-3xl rounded-lg px-8 w-3/4 border py-2 text-gray-700 items-center "
                                                    type="password" name="password_confirmation" required autofocus
                                                    autocomplete="new-password" />
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                            </div>
                                        </div>


                                            <button
                                                class="bg-cyan-600 rounded-lg p-3 text-white text-2xl mt-3 mb-3 hover:bg-sky-900 hover:text-black w-3/4">
                                                Registrarse
                                            </button>
                                            <br><br>
                                            <a class="underline text-sm text-white  hover:text-black  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                                href="{{ route('login') }}">
                                                {{ __('Already registered?') }}
                                            </a>
                                            <br>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts.guest>


{{-- <x-layouts.guest>
    <x-slot name="title">Register</x-slot>

    <x-slot name="content">
        <div
            class="box-content h-[84%] w-[80%] mt-[0.2%] ml-[10%] bg-gradient-to-t from-cyan-700 via-cyan-700 to-black absolute">
            <div class="box-content w-[42%] ml-[67%] absolute">
                <img src="https://im-control.com/main/assets/images/Curves3.png" class="opacity-50" alt="">
            </div>
            <div class="box-content w-[42%] ml-[-11%] absolute">
                <img src="https://im-control.com/main/assets/images/Curves2.png" class="opacity-50" alt="">
            </div>

            <div class="flex flex-col  items-center absolute container mx-auto pt-5">
                <h1 class="text-5xl text-white text-center py-8  px-20 font-bold">Registrarse</h1>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <!--Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block text-xl mt-1 p-3 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!--Email -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block text-xl mt-1 p-3 w-full" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!--Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block text-xl mt-1 mb-3 p-3 w-full" type="password"
                            name="password" :value="old('password')" required autofocus autocomplete="password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!--Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block text-xl mt-1 mb-3 p-3 w-full"
                            type="password" name="password_confirmation" required autofocus
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                        <button type="submit"
                            class="text-center px-3 py-2 bg-cyan-600 border border-transparent rounded-md font-semibold text-white uppercase text-xl mx-4 w-[420px] hover:bg-green-imco hover:text-black hover:transition-all">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </x-slot>

</x-layouts.guest> --}}
