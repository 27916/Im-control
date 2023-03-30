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
