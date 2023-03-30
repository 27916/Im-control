<div class="box-content w-[100%] h-[10%] bg-[#152a3a] absolute z-40">
    <nav>
        <ul>
            <div class="box-content float-left w-[15%] p-2 absolute">
                <img src="{{ asset('images/ImControl/ImControl Logo.png') }}" class="w-[100%]" alt="">
            </div>
            <div class="box-content ml-[20%] w-[4%] p-2 absolute">
                <img src="{{ asset('images/ImControl/Mesatrabajo.png') }}" alt="">
            </div>

            <li class="float-right p-2 w-[12%] mt-[1%] mr-[7%]">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-cyan-600 rounded-lg text-white text-xl hover:bg-sky-900 hover:text-black p-1 w-[100%]">
                        Cerrar sesión
                    </button>
                </form>
            </li>
            <li class="float-right p-2 w-[10%] mt-[1%]">
                <a href="{{ route('dashboard') }}">
                    <button
                        class="bg-cyan-600 rounded-lg text-white text-xl hover:bg-sky-900 hover:text-black p-1 w-[100%]">
                        Inicio
                    </button>
                </a>
            </li>
            <div class="box-content w-[3.5%]   inset-y-0 right-0 w-16 p-2 absolute">
                <img src="https://im-control.com/main/public/images/Logo_de_Facebook.png" class="float-right"
                    alt="">
            </div>
        </ul>
    </nav>
</div>

{{-- <div class="">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center bg-gray-900">
        <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
            stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full"
            viewBox="0 0 24 24">
            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
        </svg>
        <span class="ml-3 text-xl text-white">IMCO</span>
        </a>
        <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
            <button class="text-sm bold text-white bg-green-imco border-0 py-2 px-8 focus:outline-none hover:bg-cyan-700 rounded"> <a href="/"                              >Home</a>                </button>
            <button class="text-sm bold text-white bg-green-imco border-0 py-2 px-8 focus:outline-none hover:bg-cyan-700 rounded"> <a href="{{ route('login') }}"           >login</a>               </button>
            <button class="text-sm bold text-white bg-green-imco border-0 py-2 px-8 focus:outline-none hover:bg-cyan-700 rounded"> <a href="{{ route('register') }}"        >register</a>            </button>
            <button class="text-sm bold text-white bg-green-imco border-0 py-2 px-8 focus:outline-none hover:bg-cyan-700 rounded"> <a href="{{ route('social_networks') }}" >social-networks</a>     </button>
            <button class="text-sm bold text-white bg-green-imco border-0 py-2 px-8 focus:outline-none hover:bg-cyan-700 rounded"> <a href="{{ route('pages') }}"        >fanpages</a>            </button>
            {{-- <button class="text-sm bold text-white bg-green-imco border-0 py-2 px-8 focus:outline-none hover:bg-cyan-700 rounded"> <a href="{{ route('campaigns') }}"       >campaigns</a>           </button>
            <button class="text-sm bold text-white bg-green-imco border-0 py-2 px-8 focus:outline-none hover:bg-cyan-700 rounded"> <a href="{{ route('campaign_info') }}"   >campaign_info</a>       </button>
            <button class="text-sm bold text-white bg-green-imco border-0 py-2 px-8 focus:outline-none hover:bg-cyan-700 rounded"> <a href="{{ route('ads') }}"             >ads</a>                 </button>
            <button class="text-sm bold text-white bg-green-imco border-0 py-2 px-8 focus:outline-none hover:bg-cyan-700 rounded"> <a href="{{ route('ad_info') }}"         >ad_info</a>             </button>
        </nav>
        <slot name="button"></slot>
    </div>

</div> --}}
