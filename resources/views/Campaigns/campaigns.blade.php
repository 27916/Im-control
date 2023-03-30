<x-layouts.body.app1>
    <x-slot name="title">Home</x-slot>
    <x-slot name="content">

        <div class="box-content w-[100%] h-[100%] max-h-full bg-[#152a3a] absolute">
            <img src="{{ asset('images/ImControl/bg.jpg') }}" class="w-[100%] h-[100%]" alt="">
        </div>
        <div class="box-content w-[95%] h-[90%] ml-[5%] inset-x-0 bottom-0 absolute z-40">
            <h1 class="mb-1 text-4xl font-bold text-white absolute mt-[1%]">Campañas</h1>
            <h1 class="mb-1 text-xl font-bold text-white absolute mt-[4%]">Cuenta comercial: {{ $account_name }}</h1>
            <div class="mt-[6%]">
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
                        <div class="w-full h-full mx-auto overflow-x-hidden overflow-y-hidden">
                            <div id="slider"
                                class="h-full flex lg:gap-8 md:gap-6 gap-14 items-center justify-start transition ease-out duration-700">

                                @foreach ($campaigns as $campaign)
                                    <x-card-campaign :name="$campaign['name']" :action="route('campaign_info', ['campaign_id' => $campaign['id']])" />
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
ñ
