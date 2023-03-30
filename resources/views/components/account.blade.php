@props(['name', 'img'])

{{-- <form method="POST">
    @csrf
</form> --}}
<a {{ $attributes }}>
    <div class="flex flex-shrink-0 relative w-full mt-[7%] md:mt-[7%] min-[2560px]:mt-[10%] absolute z-40">
        <div class="items-center justify-center">
            <img class="rounded-full " width="700px" src="{{ $img }}" alt="">
            <p class="text-center text-xl font-bold text-white">{{ $name }}</p>
        </div>
    </div>
</a>
