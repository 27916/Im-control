<x-layouts.body.app1>
    <x-slot name="title">Home</x-slot>

    <x-slot name="content">

        <div class="box-content w-[100%] h-[100%] max-h-full bg-cyan-900 absolute">
            <img src="{{ asset('images/ImControl/bg.jpg') }}" class="w-[100%] h-[100%]" alt="">
        </div>
        <div class="box-content w-[90%] h-[90%] ml-[5%] inset-x-0 bottom-0 absolute z-40">
            <h1 class="mb-1 text-4xl font-bold text-white absolute mt-[1%]">Panel de anuncios</h1>
            <h1 class="mb-1 text-xl font-bold text-white absolute mt-[4%]">Campaña:Nombre de la campaña</h1>
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
                                <?php for ($i = 0; $i < 12; $i++) { ?>
                                <div class="flex flex-shrink-0 relative w-full sm:w-[30%]">
                                    <div
                                        class="w-[80%]  h-[70%] bg-[#152a3a] border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <a href="{{ route('ad_info') }}">
                                            <img class="rounded-t-lg p-6"
                                                src="https://www.cinconoticias.com/wp-content/uploads/Anuncios_Mas_Famosos_Nesscafe.jpg"
                                                alt="" />
                                        </a>
                                        <div class="p-1 text-center">
                                            <h5 class="mb-1 text-2xl font-bold tracking-tight text-white">Anuncio</h5>
                                            <p class="mb-2 font-normal text-white">Nombre del anuncio</p>
                                            <a href="{{ route('ad_info') }}"><button
                                                    class="bg-cyan-600 rounded-lg p-3 text-white text-3xl mt-3 mb-3 hover:bg-sky-900 hover:text-black w-[90%]">Ver
                                                    detalles</button><br></a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
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
