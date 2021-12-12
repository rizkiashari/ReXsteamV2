@extends('layout.main')

@section('content')
  <div class="pb-28">
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
    <div class="px-4 md:px-[11%] py-8"> 
      <h3 class="font-OpenSans font-semibold text-[16px] capitalize mb-3 md:text-[24px]">Manage Game</h3>
      <form action="/manage-game" method="GET" >
        {{-- By Name --}}
        @csrf
        <p class="capitalize text-[12px] md:text-[16px] mb-2 font-medium ">Filter by Games Name</p>
        <div class="mb-4 w-[250px] relative">
          <div class="absolute top-0 left-4 mt-3 mr-3">
            <svg class="focus:fill-[#fff] text-[#dddddd] w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path class="focus:fill-[#fff] text-[#dddddd]" d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
            </svg>
          </div>
          <input type="text" name="search" value="{{ request('search') }}" class="w-[250px] pl-12 pr-6 py-2 outline-[#010101] focus:text-[#2b1818] bg-[#ffff] rounded-lg shadow-md focus:outline-none placeholder-[#151d1d] focus:bg-[#f2f6ff]" placeholder="Search Games Name">
        </div>
        {{-- Filter Category --}}
        <p class="capitalize text-[12px] md:text-[16px] mb-2 font-medium ">Filter by Games Category</p>
        <div class="flex justify-start flex-wrap w-auto md:w-[550px] flex-row mb-2">
          @foreach ($categories as $category)
            <?php
              $checked = [];
              if(isset($_GET['category'])){
                $checked = $_GET['category'];
              }
            ?>

            <div class="flex items-center justify-start w-[120px] ml-2">
              <input type="checkbox" name="category[]" value="{{ $category->id }}" id="{{ $category->id }}" class="mr-2" @if(in_array($category->id, $checked)) checked @endif />
              <label for="{{ $category->id }}" class="capitalize text-[12px] md:text-[16px] font-medium">{{ $category->name }}</label>
            </div>
          @endforeach
        </div>
        {{-- Button Search --}}
        <button class="bg-[#010101] text-[#fff] text-center py-2 px-4 rounded-lg shadow-md hover:bg-[#2b1818] hover:text-[#fff]">
          Search
        </button>
      </form>
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
      {{-- Content --}}
      <div class="flex gap-5 py-5 md:flex-row md:justify-start justify-center flex-wrap">
        {{-- {{ dd($games) }} --}}
        @if (count($games) > 0 )
            @foreach ($games as $game)
            <div class="relative hover:mb-[100px] hover:transition md:w-[23%] custom w-[200px]">
              <?php
                $str = substr($game->game_name, 0, 13);
                if(strlen($game->game_name) > 13){
                  $str .= '...';
                }         
              ?>
              <div class="cursor-pointer relative md:w-full w-[200px] h-auto">
                  <a class="hover:backdrop-blur-0" >
                      <div class="before:absolute before:top-0 before:bottom-0 before:right-0 before:left-0 before:bg-[#ffffff69] before:rounded-[16px] ">
                          <img class="rounded-[16px] w-full h-[200px] object-cover" src="{{ 'covers/'. $game->cover }}" />
                          <div class="absolute bottom-5 left-3 px-3 rounded-[8px] md:max-w-xs py-2 bg-[#ffffff8e]">
                              <h3 class="font-bold mb- capitalize text-[14px]">{{ $str }}</h3>
                              <p class="font-normal capitalize text-[12px]">{{ $game->category->name }}</p>
                          </div>
                      </div>
                  </a>                     
              </div>  
              {{-- Update Game --}} 
              <div class="tombol"> 
                <div class="absolute bottom-[-3.5em] w-full my-2 rounded-xl py-2 px-3 bg-[#ffffff67]">
                  <a href="/game/{{ $game->slug }}/update" class="flex items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                      <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg>
                    <p>Update</p>
                  </a>
                </div>
                {{-- Delete --}}
                <div x-data="{ show: false }" class="absolute bottom-[-8.3em] mb-10 w-full my-2 rounded-xl py-2 px-3 bg-[#ffffff67]">
                  <a @click="show = true" class="flex cursor-pointer items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                    <p>Delete</p>                   
                  </a>
                  <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-[#000000] bg-opacity-25" x-show="show">
                      <!-- Modal inner -->
                      <div class="w-[250px] md:w-[500px] h-[230px] md:h-[220px] px-6 py-4 mx-auto text-left bg-[#fff] rounded shadow-lg" @click.away="show = false" x-transition:enter="motion-safe:ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                        <div class="flex">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#a70202" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                          </svg>
                          <h5 class="ml-3 text-black max-w-none">Delete Games</h5>
                        </div>
                        <!-- content -->
                        <p class="text-[#666666] mt-3 px-4 md:px-8 text-[12px] md:text-[16px]">Are you sure you want to delete this game {{ $game->game_name }}? All of your data will be permanently removed from our servers forever. This action cannot be undone</p>
                          <div class="flex justify-end mb-4 items-end mt-4 gap-3">
                            <button type="button" class="text-[#111111] border-[1px] border-[#424040] px-4 py-2 rounded-[8px] text-[12px] md:text-[16px] text-center" @click="show = false">Cancel</button>
                            <form action="/game/{{ $game->slug }}/delete" method="POST" enctype="multipart/form-data">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="bg-[#f44336] text-[12px] md:text-[16px] text-[#fff] px-4 py-2 rounded-[8px] text-center">Delete</button>
                            </form>
                          </div>                       
                      </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            
        @else
            <p class="text-[16px] font-medium">There are no games content can be showed right now</p>
        @endif
        
      </div> 
    </div>
  </div>
@endsection