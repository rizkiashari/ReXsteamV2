@extends('layout.main')

@section('content')
<div class="container min-h-[90vh] px-12 pb-20">
    @if (session()->has('success'))
    <div x-data="{ open: true }" :class="{'flex': open, 'hidden': !open}"  role="alert">
        <div class="bg-[#d1e7dd] border-[2px] w:-[100px] sm:w-[350px] md:w-[600px] border-[#badbcc] text-[#0f5132] px-10 py-3 rounded absolute top-[7em] left-[50%] translate-x-[-50%]">
            <span class="absolute left-0 top-0 px-4 py-3">
            <svg @click="open = !open" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            <strong class="font-bold text-[10px] sm:text-[12px] md:text-[16px] md:w-[400px] w-[300px]">{{ session('success') }}</strong>     
        </div>
    </div>
    @endif
    @if (count($games) > 0)
        <p class="font-OpenSans uppercase py-6 text-[18px] md:text-[20px] font-bold">Top Games</p>
        <div class="flex gap-5 py-5 md:flex-row md:justify-start justify-center flex-wrap">
            @foreach ($games as $game)
            <div class="relative md:w-[22%] w-[200px] h-1/3">
                <a class="hover:backdrop-blur-0" href="/game/{{ $game->slug }}">
                    <div class="before:absolute before:top-0 before:bottom-0 before:right-0 before:left-0 before:bg-[#ffffff69] before:rounded-[16px] ">
                        <img class="rounded-[16px] w-full h-[200px] object-cover" src="{{ 'covers/'. $game->cover }}" />
                        <div class="absolute bottom-5 left-3 px-3 rounded-[8px] md:max-w-xs py-2 bg-[#ffffff8e]">
                            <h3 class="font-bold mb-1 capitalize text-[14px]">{{ $game->game_name }}</h3>
                            <p class="font-normal capitalize text-[12px]">{{ $game->category->name }}</p>
                        </div>
                    </div>
                </a>
            </div>  
            @endforeach        
        </div>      
    @else
        <p class="font-OpenSans uppercase py-6 text-[18px] md:text-[20px] font-bold">Games Not Found</p>
    @endif
</div>
@endsection