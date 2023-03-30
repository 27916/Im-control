<x-layouts.guest>
    <x-slot name="title">Login</x-slot>

    <x-slot name="content" class="">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Manrope">
        <div class="box-content w-[25%] ml-[10%] z-40  absolute">
            <img src="https://im-control.com/LG/images/Imcosem.png" alt="" class="w-[85%]">
        </div>
        <div class="box-content w-[100%] h-[100%] absolute">
            <img src="{{asset('images/ImControl/bg.jpg')}}" class="w-[100%] h-[100%]" alt="">
        </div>
        <div class="max-w-2xl" style="font-family: 'Manrope',serif;">
            <div class="box-content h-[84%] w-[75%] mt-[5%] ml-[10%] bg-cyan-900 absolute">
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

                                <button type="submit"
                                    class="bg-cyan-600 rounded-lg p-3 text-white text-3xl mt-3 mb-3 hover:bg-sky-900 hover:text-black w-3/4">
                                    {{ __('Change Password') }}
                                </button><br>


                            </div>
                        </form>

                        {{-- <form method="POST" class="w-full md:w-full mt-[15%] rounded-lg items-center ">
                            <h2 class=" text-white mb-4 text-5xl  text-center">Recupera tu contraseña</h2>
                            <div class="px-12 pb-10 text-center">
                            <div class="w-full mb-2">
                                    <div class=" justify-center">
                                        <x-input-label for="name" :value="__('Nombre:')" class="text-white mb-4 text-3xl font-bold" />
                                        <x-text-input id="name" class="text-3xl rounded-lg px-8 w-3/4 border py-2 text-gray-700 focus:outline-none" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="w-full mb-2">
                                    <div class="justify-center">
                                        <x-input-label for="correo" :value="__('Correo Electronico:')" class="text-white mb-4 text-3xl  font-bold" />
                                        <x-text-input id="correo" class="text-3xl rounded-lg px-8 w-3/4 border py-2 text-gray-700 items-center " type="email" name="correo" :value="old('correo')" required autofocus autocomplete="correo" />
                                        <x-input-error :messages="$errors->get('correo')" class="mt-2" />
                                    </div>
                                </div>
                                <button class="bg-cyan-600 rounded-lg p-3 text-white text-3xl mt-3 mb-3 hover:bg-sky-900 hover:text-black w-3/4">Recuperar contraseña</button><br>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </div>
            <video class="box-content h-[85%] w-[50%] p-4 ml-[45%] mt-[4%] absolute" autoplay muted>
                <source src="{{ asset('video/WOROLDWIDE.mp4') }}" type="video/mp4">
            </video>
        </div>
    </x-slot>

    </x-layouts.app>
