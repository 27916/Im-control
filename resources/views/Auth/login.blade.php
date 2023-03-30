<x-layouts.guest>
    <x-slot name="title">Login</x-slot>

    <x-slot name="content" class="">


        <div class="box-content w-[21%] ml-[10%] z-40  absolute">
            <img src="https://im-control.com/demo/images/Semicirculo1.png" alt="" class="w-[78%]">
        </div>
        <div class="box-content w-[100%] h-[100%] absolute">
            <img src="{{ asset('images/ImControl/bg.jpg') }}" class="w-[100%] h-[100%]" alt="">
        </div>
        <div
            class="box-content  w-[15%]  absolute text-center z-40 bottom-3 right-2 h-12 min-[2560px]:bottom-5 right-0 h-12">
            <a href="{{ route('change_password.index') }}"> <button
                    class="bg-[#152a3a] rounded-full text-white md:text-xs 2xl:text-xl min-[2560px]:text-2xl p-3 item-center  hover:bg-cyan-900 w-full">Cambiar
                    contrase&ntildea</button></a>
        </div>
        <div class="max-w-2xl" style="font-family: 'Manrope',serif;">

            <div class="box-content h-[80%] w-[75%] mt-[4%] ml-[13%] bg-[#152a3a] absolute">
                <div class="box-content h-[84%] w-[80%]  ml-[2%]">
                    <div class="box-content h-[100%] w-[53%]  absolute">

                        <form method="POST" action="{{ route('login') }}"
                            class="w-full md:w-full mt-[15%] rounded-lg items-center ">
                            @csrf
                            <h2 class=" text-white mb-4 text-5xl font-bold text-center">Bienvenido a ImControl</h2>
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <div class="px-12 pb-10 text-center">

                                <!-- Email Address -->
                                <div class="w-full mb-2">
                                    <div class="justify-center">
                                        <x-input-label for="email" :value="__('Email')"
                                            class="text-white mb-4 text-3xl  font-bold" />
                                        <x-text-input id="email"
                                            class="text-3xl rounded-lg px-8 w-3/4 border py-2 text-gray-700 items-center "
                                            type="email" name="email" :value="old('email')" required autofocus
                                            autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="w-full mb-2">
                                    <div class=" justify-center">
                                        <x-input-label for="password" :value="__('Password')"
                                            class="text-white mb-4 text-3xl font-bold" />
                                        <x-text-input id="password"
                                            class="text-3xl rounded-lg px-8 w-3/4 border py-2 text-gray-700 focus:outline-none"
                                            type="password" name="password" required autofocus
                                            autocomplete="password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Remember Me -->
                                <div class="block mt-4">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded hover:text-cyan-500 text-cyan-500 shadow-sm focus:ring-cyan-600 dark:focus:ring-cyan-600 dark:focus:ring-offset-gray-800" name="remember">
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                    </label>
                                </div>

                                <button type="submit"
                                    class="bg-cyan-600 rounded-lg p-3 text-white text-3xl mt-3 mb-3 hover:bg-sky-900 hover:text-black w-3/4">
                                    {{ __('Login') }}
                                </button><br>
                                <a href="{{ route('register') }}"
                                    class="text-2xl mt-3 text-white hover:text-black font-bold">
                                    {{ __('Create Account') }}
                                </a><br><br>
                                {{-- <a href="" class="text-2xl mt-3 text-white hover:text-black font-bold">Recuperar Contraseña</a> --}}
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <video class="box-content h-[80%] w-[52%] p-4 ml-[45%] mt-[3%] absolute" autoplay muted>
                <source src="{{ asset('video/WOROLDWIDE.mp4') }}" type="video/mp4">
            </video>

        </div>


    </x-slot>

    </x-layouts.app>

    {{-- </div>

</div>
</div>

<video class="box-content h-[82%] w-[52%] p-4 ml-[45%] mt-[3%] absolute" autoplay muted>
<source src="{{ asset('video/WOROLDWIDE.mp4') }}" type="video/mp4">
</video>
<div class="box-content h-[7%] w-[15%]  ml-[70%] mt-[45%] absolute text-center">
<a href="{{ route('change_password.index') }}">
<img src="{{ asset('images/ImControl/BotónAzOsc1.png') }}" alt="" class="w-[78%]">
</a>
</div>
</div>


</x-slot>
</x-layouts.guest> --}}
