<x-layouts.body.guest2>
    <x-slot name="title">Bienvenidos</x-slot>

    <x-slot name="content">
        <div class="box-content w-[21%] ml-[10%] z-40  absolute">
            <img src="https://im-control.com/demo/images/Semicirculo1.png" alt="" class="w-[78%]">
        </div>
        <div class="box-content w-[100%] h-[100%] absolute">
            <img src="https://im-control.com/index/public/images/ImControl/bg.jpg" class="w-[100%] h-[100%]"
                alt="">
        </div>
        <div style="font-family: 'Manrope',serif;">
            <div class="box-content h-auto w-[45%] mt-[12%] ml-[28%] absolute z-30">
                <p class=" text-white text-5xl text-center mb-6 p-3">Mide el impacto de tus campañas</p>
                <button
                    class="bg-[#152a3a] rounded-full text-white text-5xl p-5 item-center w-[100%] hover:bg-sky-900"><a
                        href="{{ route('login') }}">
                        Comienza ahora
                    </a>
                </button>
            </div>
        </div>
        <div class="box-content h-[17.3%] w-[100%] inset-x-0 bottom-0 h-16 bg-[#152a3a] absolute z-30">
            <table class="w-full">
                <tr>
                    <td class="absolute ml-[20%] mt-[2%] ">
                        <x-contact-us />
                    </td>
                    <td class=" ml-[65%] mt-[2%] absolute">
                        <x-supports.support-guest />
                    </td>
                </tr>
            </table>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-layouts.footer></x-layouts.footer>
    </x-slot>
</x-layouts.body.guest2>
