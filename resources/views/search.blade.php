@extends('layout.main')

@section('content')
<div class="container mx-auto min-h-[90vh] px-4 sm:px-0 md:px-12 md:pb-20">
    @if (session()->has('success'))
    <div x-data="{ open: true }" :class="{'flex': open, 'hidden': !open}"  x-open="open" x-init="setTimeout(() => open = false, 2500)" role="alert">
        <div class="bg-[#d1e7dd] border-[2px] w:-[100px] sm:w-[350px] md:w-[600px] border-[#badbcc] text-[#0f5132] px-10 py-3 rounded absolute top-[7em] left-[50%] translate-x-[-50%]">
            <span class="absolute left-0 top-0 px-4 py-3">
            <svg @click="open = !open" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            <strong class="font-bold text-[10px] sm:text-[12px] md:text-[16px] md:w-[400px] w-[300px]">{{ session('success') }}</strong>     
        </div>
    </div>
    @endif
    @if (count($games) > 0)
        <p class="font-OpenSans uppercase pt-6 pb-4 text-[18px] md:text-[20px] font-bold">Search Games</p>
        <div class="flex gap-5 py-3 md:flex-row md:justify-start sm:justify-start justify-center flex-wrap">
            @foreach ($games as $game)
            <div class="relative md:w-[22%] w-[200px] h-1/3">
                <a class="hover:backdrop-blur-0" href="/game/{{  $game->slug }}">
                    <div class="before:absolute before:top-0 before:bottom-0 before:right-0 before:left-0 before:bg-[#ffffff69] before:rounded-[16px] ">
                        <img class="rounded-[16px] w-full h-[200px] object-cover" src="{{ 'covers/'. $game->cover }}" alt="cover game" />
                        <div class="absolute bottom-5 left-3 px-3 rounded-[8px] md:max-w-xs py-2 bg-[#ffffff8e]">
                            <h3 class="font-bold mb-1 capitalize text-[14px]">{{ $game->game_name }}</h3>
                            <p class="font-normal capitalize text-[12px]">{{ $game->category->name }}</p>
                        </div>
                    </div>
                </a>
            </div>  
            @endforeach        
        </div>
        {{-- Paginate --}}
      <div class="bg-white px-4 py-3 flex items-center justify-between sm:px-6">
        <div class="flex-1 flex justify-between sm:hidden">
          <a href="{{ $games->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Previous
          </a>
          <a href="{{ $games->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Next
          </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-gray-700">
              Showing
              <span class="font-medium">{{ $games->firstItem() }}</span>
              to
              <span class="font-medium">{{ $games->lastItem() }}</span>
              of
              <span class="font-medium">{{ $games->total() }}</span>
              results
            </p>
          </div>
          <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
              <a href="{{ $games->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">{{ $games->previousPageUrl() }}</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
              </a>
              <a href="{{ $games->currentPage() }}" aria-current="page" class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
               {{ $games->currentPage() }}
              </a>
              
              <a href="{{ $games->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">{{ $games->nextPageUrl() }}</span>
                <!-- Heroicon name: solid/chevron-right -->
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
              </a>
            </nav>
          </div>
        </div>
      </div>      
    @else
        <p class="font-OpenSans uppercase py-6 text-[18px] md:text-[20px] font-semibold">There are no games content can be showed right now.</p>
    @endif
</div>
@endsection