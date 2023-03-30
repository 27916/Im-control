<x-layouts.body.app1>
    <x-slot name="title">Mis anuncios</x-slot>

    <x-slot name="content">

        <div class="box-content w-[100%] h-[100%] max-h-full bg-cyan-900 absolute">
            <img src="{{ asset('images/ImControl/bg.jpg') }}" class="w-[100%] h-[100%]" alt="">
        </div>
        <div class="box-content w-[90%] h-[90%] ml-[5%] inset-x-0 bottom-0 absolute z-40">
            <h1 class="mb-1 text-4xl font-bold text-white absolute mt-[1%]">Mis anuncios</h1>
            {{-- TODO: Verificar rutas --}}
            {{-- <form method="POST" action="{{ route('campaigns', ['account_id' => $account_id, 'account_name' => $account_name]) }}">
                @csrf
                <button
                    class="bg-red-600 rounded-lg text-white text-xl hover:bg-red-900 p-1 w-[10%] ml-[90%] absolute mt-[1%]">
                    Campañas
                </button>
            </form> --}}
            {{-- <a href="{{ route('campaigns', ['account_id' => $page['id'], 'account_name' => $page['name']]) }}">
                <button
                    class="bg-red-600 rounded-lg text-white text-xl hover:bg-red-900 p-1 w-[10%] ml-[90%] absolute mt-[1%]">
                    Campañas
                </button>
            </a> --}}

            <div class="mt-[7%]">
                <div class="flex items-center justify-center ">
                    <div class="w-full relative flex items-center justify-center ">
                        <button aria-label="slide backward"
                            class="absolute z-30 left-0 ml-10 focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 cursor-pointer"
                            id="prev">
                            <svg class="text-white" width="30" height="80" viewBox="0 0 8 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                        <div class="w-full h-[full] mx-auto overflow-x-hidden overflow-y-hidden">
                            <div id="slider"
                                class="h-full flex lg:gap-8 md:gap-6 gap-14 items-center justify-start transition ease-out duration-700">

                                @foreach ($adsD as $ad)
                                {{-- {{ dd($ad['creative']['image_url']) }} --}}
                                    <div class="flex flex-shrink-0 relative w-full sm:w-[30%]">
                                        <div
                                            class="w-[80%]  h-[70%] bg-[#152a3a] border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                            <form action="{{ route('ad_info', ['ad_id' => $ad['id']]) }}"
                                                method="POST">
                                                @csrf
                                                <button>
                                                    {{-- {{ dd($ad['creative']['image_url']) }} --}}

                                                    {{-- <img class="rounded-t-lg p-6"
                                                        src="https://im-control.com/index/public/images/facebook.png"
                                                        alt="" /> --}}
                                                        <img class="rounded-t-lg p-6"
                                                            src="{{ $ad['creative']['image_url'] }}"
                                                            alt="" />
                                                </button>
                                            </form>
                                            <div class="p-1 text-center">
                                                <h5 class="mb-1 text-2xl font-bold tracking-tight text-white">Anuncio
                                                </h5>
                                                <p class="mb-2 font-normal text-white">{{ $ad['name'] }}</p>
                                                <form action="{{ route('ad_info', ['ad_id' => $ad['id']]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button
                                                        class="bg-cyan-600 rounded-lg p-3 text-white text-3xl mt-3 mb-3 hover:bg-sky-900 hover:text-black w-[90%]">Ver
                                                        detalles
                                                    </button><br>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <button aria-label="slide forward"
                            class="absolute z-30 right-0 mr-10 focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
                            id="next">
                            <svg class="text-white" width="30" height="80" viewBox="0 0 8 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L7 7L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let defaultTransform = 0;

            function goNext() {
                defaultTransform = defaultTransform - 398;
                var slider = document.getElementById("slider");
                if (Math.abs(defaultTransform) >= slider.scrollWidth / 1.7) defaultTransform = 0;
                slider.style.transform = "translateX(" + defaultTransform + "px)";
            }
            next.addEventListener("click", goNext);

            function goPrev() {
                var slider = document.getElementById("slider");
                if (Math.abs(defaultTransform) === 0) defaultTransform = 0;
                else defaultTransform = defaultTransform + 398;
                slider.style.transform = "translateX(" + defaultTransform + "px)";
            }
            prev.addEventListener("click", goPrev);
        </script>
    </x-slot>

</x-layouts.body.app1>
