@props([
    'title',
    'body',
    'img_path',
    'img_width',
    'img_height',
    'class_card',
    'to_route'
    ])

<div class="w-full transition hover:shadow-xl rounded-xl bg-green-black-imco mt-[10%]">
    <a class="hidden sm:block sm:basis-56  rounded-xl" href="{{ $to_route ?? '#' }}">
        <div class="flex flex-row justify-center items-center">
            <div class="flex-col">
                <img src="{{ asset($img_path) }}" alt="" width={{ $img_width ?? ''  }} height={{ $img_height ?? ''  }}
                class="py-3 px-3 aspect-square h-full w-32 object-cover" >
            </div>
            <div class="flex-col ">
                <div class="border-l border-gray-900/10 p-4 sm:border-l-transparent sm:p-6">
                    <h3 class="text-xl font-bold text-white">{{ $title }}</h3>
                </div>
            </div>
        </div>
    </a>
</div>
