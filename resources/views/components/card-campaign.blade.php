@props(['name', ])
<div class="flex flex-shrink-0 relative w-full sm:w-[30%]">
    <div
        class="w-[80%]  h-[70%] bg-[#152a3a] border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <form {{ $attributes->merge(['method'=> 'POST']) }} >
            @csrf
            <button type="submit">

                <img class="rounded-t-lg p-6" src="{{ asset('images/facebook.png') }}" alt="" />
            </button>
        </form>
        <div class="p-1 text-center">
            <h5 class="mb-1 text-2xl font-bold tracking-tight text-white">Campaña</h5>
            <p class="mb-2 font-normal text-white">{{ $name ?? 'Nombre de la campaña' }}</p>
            <form {{ $attributes->merge(['method'=> 'POST']) }} >
                @csrf
                <button type="submit"
                    class="bg-cyan-600 rounded-lg p-3 text-white text-3xl mt-3 mb-3 hover:bg-sky-900 hover:text-black w-[90%]">
                    Ver detalles
                </button><br>
            </form>
        </div>
    </div>
</div>
