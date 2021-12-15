@extends('layout.main')

@section('content')
  <div class="px-8 py-8 w-full min-h-[87vh]">
    {{-- Success Message --}}
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
    {{-- Error Session --}}
    @if (session()->has('error'))
      <div x-data="{ open: true }" :class="{'flex': open, 'hidden': !open}"  role="alert">
        <div class="bg-[#f8d7da] border-[2px] w:-[100px] sm:w-[350px] md:w-[600px] border-[#f5c2c7] text-[#842029] px-10 py-3 rounded absolute top-[7em] left-[50%] translate-x-[-50%]">
          <span class="absolute left-0 top-0 px-4 py-3">
            <svg @click="open = !open" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
          </span>
          <div class="flex flex-col ml-4">
            <strong class="font-bold text-[10px] sm:text-[12px] md:text-[16px] md:w-[400px] w-[300px]">{{ session('error') }}</strong>
          </div> 
        </div>
      </div> 
    @endif
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
    <div class="bg-[#fff] rounded-[4px] w-[100%] flex flex-col md:flex-row">
      <div class="flex flex-col mt-4 gap-2 md:gap-10 md:flex-row">
        @include('partials.sidenav')
        <div class="border-l-2 border-[#f3f3f3]"></div>
      </div>
      
    </div>
  </div> 
@endsection