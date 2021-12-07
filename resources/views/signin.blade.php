@extends('layout.main')

@section('content')
<div class="w-[100%] h-[100%] flex">
  <div class="md:w-1/2 w-full h-full px-16 md:px-40 py-20 text-[#f1f1f1] bg-[#111827]">
    <p class="text-[16px] mb-4 font-Oswald md:text-[20px]">Login Page</p>
    <form>
      <div class="mb-4">
        <label class="capitalize text-[14px]">username</label>
        <input class="w-full h-full mt-1 text-[#111827] text-[12px] rounded pl-[12px] py-2" type="text" name="username">
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
      <label class="mt-2 flex items-center my-4">
        <input type="checkbox" class="mr-[5px] h-[12px] w-[12px]"/> 
          <span class="py-2 text-[10px] text-[#f1f1f1]">Remember Me</span>
      </label>
      <button class="w-full bg-[#4F46E5] hover:bg-[#3e37c7] rounded py-2 text-[14px]">Login</button>
      <div class="flex mt-4 justify-end">
        <a href="/register" class="text-[#9590fd] text-[12px]">Don't have an account?</a> 
      </div>
    </form>
  </div>
  <div class="w-1/2 hidden md:block max-h-screen">
    <img src="/img/hero-signin.jpg" class="w-full md:block hidden object-cover h-full" />
  </div>
</div>
@endsection