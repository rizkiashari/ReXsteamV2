@extends('layout.main')
{{-- Minus Features Drag n Drop --}}
@section('content')
  <div class="pb-28">
    <div class="px-4 md:px-[11%] py-8">
      {{-- Error Message --}}
      @if ($errors->any())
      <div x-data="{ open: true }" :class="{'flex': open, 'hidden': !open}"  x-open="open" x-init="setTimeout(() => open = false, 2500)" role="alert">
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
      <div class="flex gap-3 items-center mb-3">
        <a href="/" class="flex flex-col items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#7c7b7caa" class="bi bi-house-door" viewBox="0 0 16 16">
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
          </svg>
        </a>
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#7c7b7caa" class="mt-[2px] text-[#42423b]" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
        </svg>
        <p class="text-[12px] mt-[2px] text-[#7c7b7caa]">
          {{ $game->category->name }}
        </p>
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#7c7b7caa" class="mt-[2px] text-[#42423b]" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
        </svg>
        <p class="text-[12px] mt-[2px] text-[#7c7b7caa]">
          {{ $game->game_name }}
        </p>
      </div>
      <h3 class="font-semibold font-OpenSans mb-6 text-[16px] md:text-[24px]">Update Games</h3>
      <form method="POST" action="/game/{{ $game->slug }}/update" enctype="multipart/form-data">
        @csrf
        <div class="mb-4 flex flex-col text-[#111827]">
          <label class="capitalize text-[14px]">Game description</label>
          <textarea name="description" class="w-full h-full mt-1 text-[#111827] text-[12px] rounded px-[16px] py-3" value="{{ $game->description }}">{{ $game->description }}</textarea>
          <p class="text-[12px] text-[#919191] mt-[3px]">Write a single sentence about the game</p>
        </div>
        <div class="mb-4 text-[#111827]">
          <label class="capitalize text-[14px]">Game long description</label>
          <textarea rows="10" class="w-full h-full mt-1 text-[#111827] text-[12px] rounded px-[16px] py-3" type="text" name="long_description" value="{{ $game->long_description }}">{{  $game->long_description }}</textarea>
          <p class="text-[12px] mt-[3px] text-[#919191]">Write a few sentence about the game</p>
        </div>
      <div class="my-4">
        <label class="capitalize text-[14px]">Game Category</label>
        <div class="relative">
          <select name="category_id" class="capitalize appearance-none w-full text-[#111827] font-medium text-[12px] py-2 px-[12px] pr-8 rounded">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ ($category->id == $game->category_id) ? 'selected' : ''}}>{{ $category->name }}</option>          
            @endforeach
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
          </div>
        </div>
      </div>
      <div class="mb-4 text-[#111827]">
        <label class="capitalize text-[14px]">Game price</label>
        <input class="w-full h-full mt-1 text-[#111827] text-[12px] rounded pl-[12px] py-2" type="number" name="price" value="{{ $game->price }}">
      </div>
      <div class="mb-4 text-[#111827]">
        <label class="capitalize text-[14px]">Game Cover</label>
        <label x-data='imagePreview()' class="w-full flex flex-col py-10 items-center bg-white border-dashed border-[#fff] rounded-md tracking-wide uppercase border-2 mt-1 border-blue cursor-pointer ease-linear transition-all duration-150">
          <template x-if="!imageUrl">
            <span class="flex flex-col items-center">
              <img src="/img/icon_cover.png" alt="icon cover" />
              <h2 class="text-center capitalize text-[12px] md:[16px] text-[#6d6d6d]" >Drag and drop your file or click in this area.</h2>
              <p class="text-center capitalize text-[12px] md:[16px] text-[#9b9b9b]">JPG up to 100KB.</p>
            </span>
          </template>
          <template x-if="imageUrl">
            <img :src="imageUrl" alt="icon cover" class="object-cover w-auto h-40" />
          </template>
          <input type="file" accept="image/jpg" @change="fileChosen" name="cover" class="hidden" />
        </label>
      </div>
      <div class="mb-4 text-[#111827]">
        <label class="capitalize text-[14px]">Game Trailer</label>
        <label x-data='videoPreview()' class="w-full flex flex-col py-10 items-center bg-white border-dashed border-[#fff] rounded-md tracking-wide uppercase border-2 mt-1 border-blue cursor-pointer ease-linear transition-all duration-150">
          <template x-if="!videoUrl">
            <span class="flex flex-col items-center" for="trailer">
              <img src="/img/icon_trailer.png"/>
              <h2 class="text-center capitalize text-[12px] md:[16px] text-[#6d6d6d]" >Drag and drop your file or click in this area.</h2>
              <p class="text-center capitalize text-[12px] md:[16px] text-[#9b9b9b]">WEBM up to 100MB.</p>
            </span>
          </template>
          <template x-if="videoUrl">
            {{-- video src --}}
            <video  class="object-cover w-auto h-40" >
              <source :src="videoUrl">
              </video>  
            </template>
            <input type="file" accept="video/webm" @change="fileChosen" id="trailer" name="trailer" class="hidden" />
          </label>
        </div>
        <div class="border-b-2 my-5 border-[#ffff]"></div>
        <div class="flex justify-end mt-2 gap-3 items-center">
          <a href="/manage-game" class="text-[12px] md:text-[14px] px-4 py-2 rounded-md bg-[#fff]">Cancel</a>
          <button class="text-[12px] md:text-[14px] px-6 py-2 rounded-md bg-[#4B5563] text-[#fff]">Save</button>
        </div>
      </form>
    </div>
  </div>
@endsection