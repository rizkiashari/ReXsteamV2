@extends('layout.main')

@section('content')
<div class="pb-28 w-full container mx-auto px-4">
    {{-- Error Message --}}
    @if ($errors->any())
        <div x-data="{ open: true }" :class="{'flex': open, 'hidden': !open}"  role="alert">
        <div class="bg-[#f8d7da] border-[2px] w:-[100px] sm:w-[350px] md:w-[600px] border-[#f5c2c7] text-[#842029] px-10 py-3 rounded absolute top-[7em] left-[50%] translate-x-[-50%]">
            <span class="absolute left-0 top-0 px-4 py-3">
            <svg @click="open = !open" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            <div class="flex flex-col ml-4">
            <strong class="font-bold text-[10px] sm:text-[12px] md:text-[16px] md:w-[400px] w-[300px]">There were {{ count($errors) }} errors with your submission</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                <li class="text-[10px] sm:text-[12px] md:text-[16px]">{{ $error }}</li>
                @endforeach
            </ul> 
            </div> 
        </div>
        </div>
    @endif
    <div class="pt-6">
        <div class="flex gap-3 justify-start items-center mb-3">
            <a href="/" class="flex flex-col items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#111544" class="bi bi-house-door" viewBox="0 0 16 16">
                <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                </svg>
            </a>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#111544" class="mt-[2px] text-[#42423b]" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg>
            <p class="text-[14px] mt-[2px] text-[#111544]">
                {{ $game->category->name }}
            </p>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#111544" class="mt-[2px] text-[#42423b]" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg>
            <p class="text-[14px] mt-[2px] text-[#111544]">
                {{ $game->game_name }}
            </p>
        </div>
    </div>
    <div class="mt-4 w-full">
        <div class="flex w-full flex-col md:flex-row gap-6">
            <video class="md:w-[70%] w-full rounded-[8px]" controls>
                <source src="{{'/videos/trailers/'. $game->trailer }}" type="video/webm">
            </video>
            <div class="md:w-[30%] w-full">
                <img src="/covers/{{ $game->cover }}" class=" object-cover h-[200px] md:h-[280px] w-full md:w-[450px] sm:w-[300px] rounded-[8px]" />
                <h3 class="mt-4 font-OpenSans font-bold text-[16px] md:text-[20px]">{{ $game->game_name }}</h3>
                <p class="text-[14px] my-[4px] text-[#111544]">
                    {{ $game->description }}
                </p>
                <div class="flex gap-2 mb-2 items-center">    
                    <h3 class="font-semibold text-[14px]">Genre:</h3>
                    <p class="text-[14px] text-[#111544]">
                        {{ $game->category->name }}
                    </p>
                </div>
                <div class="flex gap-2 mb-2 items-center">    
                    <h3 class="font-semibold text-[14px]">Release Date:</h3>
                    <p class="text-[14px] text-[#111544]">
                        {{ date_format(date_create($game->release_date), "F d, Y") }}
                    </p>
                </div>
                <div class="flex gap-2 mb-2 items-center">    
                    <h3 class="font-semibold text-[14px]">Developer:</h3>
                    <p class="text-[14px] text-[#111544]">
                        {{ $game->developer }}
                    </p>
                </div>
                <div class="flex gap-2 mb-2 items-center">    
                    <h3 class="font-semibold text-[14px]">Publisher:</h3>
                    <p class="text-[14px] text-[#111544]">
                        {{ $game->publisher }}
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-[#fff] w-full mt-8 py-4 px-3 rounded-md">
            <h3 class="font-semibold">Buy {{ $game->game_name }}</h3>
            <div class="w-full relative top-[-2px] right-2">
                <div class="absolute right-0">
                    <div class="bg-[#4B5563] items-center flex gap-2 px-4 py-2 rounded-md">
                        <p class="text-[10px] sm:text-[12px] md:text-[14px] mr-2 text-[#f1f1f1]">
                            Rp.{{ number_format($game->price,  0, ".", ".") }}
                        </p>
                        <div class="border-l-2  border-[#fff] w-2 h-5"></div>
                        <button class="text-[#f1f1f1] text-[10px] sm:text-[12px] md:text-[14px] flex items-center gap-2 uppercase">
                            <svg xmlns="http://www.w3.org/2000/svg" class="md:w-5 w-4 h-4 md:h-5" fill="#f1f1f1" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            Add to cart
                        </button>
                    </div>
                </div>    
            </div>
        </div>
        <div class="mt-6">
            <h3 class="uppercase font-semibold mb-2 text-[14px] sm:[text-16px] md:text-[18px]">About This Game</h3>
            <div class="border-b-2 mb-2 w-full border-[#111544]"></div>
            <p class="text-[14px] text-[#111544]">
                {{ $game->long_description }}
            </p>
        </div>
    </div>
</div>
@endsection