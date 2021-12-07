@extends('layout.main')

@section('content')
<div class="w-[100%] h-[100%] flex">
  <div class="md:w-1/2 w-full max-h-screen px-16 md:px-40 py-16 text-[#f1f1f1] bg-[#111827]">
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
    
    <p class="text-[16px] mb-4 font-Oswald md:text-[20px]">Register Page</p>
    <form action="/register" method="POST">
      @csrf
      <div class="mb-4">
        <label class="capitalize text-[14px]">username</label>
        <input class="w-full h-full mt-1 text-[#111827] text-[12px] rounded pl-[12px] py-2" type="text" name="username" value="{{ old('username') }}" >
      </div>
      <div class="mb-4">
        <label class="capitalize text-[14px]">Full Name</label>
        <input class="w-full h-full mt-1 text-[#111827] text-[12px] rounded pl-[12px] py-2" type="text" name="fullname" value="{{ old('fullname') }}">
      </div>
      <div x-data="{ show: true }">
        <label class="capitalize text-[14px]">Password</label>
        <div class="relative">
          <input class="w-full h-full mt-1 text-[#111827] text-[12px] rounded pl-[12px] py-2" :type="show ? 'password' : 'text'"  name="password">
          <div class="absolute bottom-0 top-[4px] right-[12px] flex items-center">
            <svg class="h-4 text-gray-700" fill="none" @click="show = !show"
              :class="{'hidden': show, 'block':!show }" xmlns="http://www.w3.org/2000/svg"
              viewbox="0 0 576 512">
              <path fill="#111827"
                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
              </path>
            </svg>
            <svg class="h-4 text-gray-700" fill="none" @click="show = !show"
              :class="{'block': show, 'hidden':!show }" xmlns="http://www.w3.org/2000/svg"
              viewbox="0 0 640 512">
              <path fill="#111827"
                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
              </path>
            </svg>
          </div>
        </div>
      </div>
      <div class="my-4">
        <label class="capitalize text-[14px]">Role</label>
        <div class="relative">
          <select name="role_id" class="capitalize appearance-none w-full text-[#111827] text-[12px] py-2 px-[12px] pr-8 rounded">
            @foreach ($roles as $role)
              <option value="{{ $role->id }}">{{ $role->name }}</option>          
            @endforeach
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
          </div>
        </div>
      </div>
      <button class="w-full bg-[#4F46E5] mt-2 hover:bg-[#3e37c7] rounded py-2 text-[14px]">Register</button>
      <div class="flex mt-4 justify-end">
        <a href="/login" class="text-[#9590fd] text-[12px]">Already have an account?</a> 
      </div>
    </form>
  </div>
  <div class="w-1/2 hidden md:block max-h-screen">
    <img src="/img/hero-signin.jpg" class="w-full md:block hidden object-cover h-full" />
  </div>
</div>
@endsection