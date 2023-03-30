@props(['img', 'title', 'description', 'to_route'])

<div class="flex flex-shrink-0 relative w-full sm:w-[30%]">
    <div
        class="w-[80%]  h-[70%] bg-[#152a3a] border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ $to_route ?? '#' }}">
            <img class="rounded-t-lg p-6"
                src="{{ $img }}"
                alt="" />
        </a>
        <div class="p-1 text-center">
            <h5 class="mb-1 text-2xl font-bold tracking-tight text-white">{{ $title ?? 'Anuncio' }}</h5>
            <p class="mb-2 font-normal text-white">{{ $description ?? 'Nombre del anuncio' }}</p>
            <a href="{{ $to_route ?? '#' }}">
                <button class="bg-cyan-600 rounded-lg p-3 text-white text-3xl mt-3 mb-3 hover:bg-sky-900 hover:text-black w-[90%]">Ver
                    detalles
                </button><br>
            </a>
        </div>
    </div>
</div>
