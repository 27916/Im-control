<x-layouts.body.app2>
    <x-slot name="title">Redes Sociales</x-slot>

    <x-slot name="content">
        <div class="box-xontent w-[70%] h-[50%] absolute mt-[3%] ml-[15%] z-40">
            <div class="flex flex-col space-y-4">
                <x-card-social
                    title="Facebook"
                    img_path="images\sn\Logo_de_Facebook.png"
                    to_route="{{ route('pages') }}"
                />

                {{-- <x-card-social
                    title="Instagram"
                    img_path="images\sn\2048px-Instagram_icon.png"
                    to_route="#"
                /> --}}

                {{-- <x-card-social
                    title="Twitter"
                    img_path="images\sn\twit.png"
                    to_route="#"
                /> --}}

            </div>
        </div>
    </x-slot>

</x-layouts.body.app2>
