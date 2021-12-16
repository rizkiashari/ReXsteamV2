@extends('layout.main')

@section('content')
  <div class="px-8 py-8 w-full min-h-[87vh]">
    {{-- Success Message --}}
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
    {{-- Error Session --}}
    @if (session()->has('error'))
      <div x-data="{ open: true }" :class="{'flex': open, 'hidden': !open}"  x-open="open" x-init="setTimeout(() => open = false, 2500)" role="alert">
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
    <div class="bg-[#fff] rounded-[4px] w-[100%] flex flex-col md:flex-row">
      <div class="flex flex-col mt-4 gap-2 md:gap-10 md:flex-row">
        @include('partials.sidenav')
        <div class="border-l-2 border-[#f3f3f3]"></div>
      </div>
      <div class="w-full mt-4 px-5 py-4">
          <form class="w-full" action="/user/profile" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="mb-6 w-full">
            <h3 class="mb-1 md:text[16px] text-[14px] font-semibold">{{ $user->username }} Profile</h3>
            <p class="md:text-[14px] text-[12px] text-[#adadad]">This information will be displayed publicly so be careful what you share.</p>
          </div>
          <div class="flex w-full mb-2 md:flex-row flex-col-reverse gap-8">
            <div class="w-full">
              <div class="flex mb-4 w-full gap-4">
                <div class="w-full">
                  <h3 class="mb-1 text-[12px] font-semibold md:text-[16px]">Username</h3>
                  <p class="w-full px-2 md:px-3 border-[1px] text-[12px] md:text-[16px] rounded-[8px] focus:bg-[#e7e7e7dd] border-[#cecece] py-1 md:py-2">{{  $user->username }}</p>          
                </div>
                <div class="w-[30%]">
                  <h3 class="mb-1 text-[12px] font-semibold md:text-[16px]">Level</h3>
                  @if(Auth::user()->role_id == 1)
                    <p class="w-full px-2 md:px-3 border-[1px] rounded-[8px] text-[12px] md:text-[16px] focus:bg-[#e7e7e7dd] border-[#cecece] py-1 md:py-2">0</p>
                    @else
                    <p class="w-full px-2 md:px-3 border-[1px] rounded-[8px] text-[12px] md:text-[16px] focus:bg-[#e7e7e7dd] border-[#cecece] py-1 md:py-2">{{ Auth::user()->level }}</p>
                  @endif
                </div>
              </div>
              <div class="w-full">
                <h3 class="mb-2 text-[12px] font-semibold md:text-[16px]">Full Name</h3>
                <input type="text" name="fullname" class="w-full px-2 md:px-3 border-[1px] rounded-[8px] text-[12px] md:text-[16px] focus:bg-[#e7e7e7dd] border-[#cecece] py-1 md:py-2" value="{{ $user->fullname }}">
              </div>
            </div>     
            <div class="w-[250px] h-auto">
              <h3 class="mb-2">Photo</h3>
              @if ($user->photo == null)
                <div x-data='imagePreview()' class="inline-block h-[100px] w-[100px] md:h-[150px] md:w-[150px] rounded-full ring-2 ring-white">
                  <template x-if="!imageUrl">
                    <label for="photo" class="cursor-pointer w-full h-full text-[#111827] uppercase ml-[0.5em] font-medium font-Oswald text-[4em] md:text-[6em]" >{{ substr($user->fullname , 0, 1) }}</label>
                  </template>
                  <template x-if="imageUrl">
                    <img :src="imageUrl" class="inline-block h-[100px]  w-[100px] object-cover md:h-[150px] md:w-[150px] rounded-full ring-2 ring-white" />
                  </template>          
                  <input type="file" @change="fileChosen" class="hidden" name="photo" id="photo" />
                </div>
              @else
                <div x-data='imagePreview()'>
                  <label for="photo" class="cursor-pointer">
                    <template x-if="!imageUrl">
                      <img class="inline-block h-[100px] w-[100px] md:h-[150px] md:w-[150px] object-cover rounded-full ring-2 ring-white" src="{{ '/profile/'. $user->photo }}" alt="">
                    </template>
                    <template x-if="imageUrl">
                      <img :src="imageUrl" class="inline-block h-[100px] w-[100px] object-cover md:h-[150px] md:w-[150px] rounded-full ring-2 ring-white" />
                    </template> 
                  </label>
                  <input type="file"  @change="fileChosen" class="hidden" name="photo" id="photo" />                                  
                </div>     
              @endif
            </div>         
          </div>
          <div x-data="{ show: true }">
            <label class="capitalize mb-1 text-[12px] font-semibold md:text-[16px]">Current Password</label>
            <div class="relative">
              <input class="w-full mb-1 px-2 md:px-3 border-[1px] rounded-[8px] text-[12px] md:text-[16px] focus:bg-[#e7e7e7dd] border-[#cecece] py-1 md:py-2" :type="show ? 'password' : 'text'"  name="current_password">
              <div class="cursor-pointer absolute bottom-0 top-[-2px] right-[12px] flex items-center">
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
          <p class="md:text-[14px] text-[10px] mb-4 text-[#adadad]">Fill out this field to check if you are authorized.</p>
          <div x-data="{ show: true }">
            <label class="capitalize mb-1 text-[12px] font-semibold md:text-[16px]">New Password</label>
            <div class="relative">
              <input class="w-full mb-1 px-2 md:px-3 border-[1px] rounded-[8px] text-[12px] md:text-[16px] focus:bg-[#e7e7e7dd] border-[#cecece] py-1 md:py-2" :type="show ? 'password' : 'text'"  name="password">
              <div class="cursor-pointer absolute bottom-0 top-[-2px] right-[12px] flex items-center">
                <svg class="h-4 text-gray-700" fill="none" @click="show = !show"
                  :class="{'hidden': show, 'block':!show }" xmlns="http://www.w3.org/2000/svg"
                  viewbox="0 0 576 512">
                  <path fill="#111827"
                    d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                  </path>
                </svg>
                <svg class="h-4" fill="none" @click="show = !show"
                  :class="{'block': show, 'hidden':!show }" xmlns="http://www.w3.org/2000/svg"
                  viewbox="0 0 640 512">
                  <path fill="#111827"
                    d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                  </path>
                </svg>
              </div>
            </div>
          </div>
          <p class="md:text-[14px] text-[10px] mb-4 text-[#adadad]">Only if you want to change your password.</p>
          <div x-data="{ show: true }">
            <label class="capitalize mb-1 text-[12px] font-semibold md:text-[16px]">Confirm New Password</label>
            <div class="relative">
              <input class="w-full mb-1 px-2 md:px-3 border-[1px] rounded-[8px] text-[12px] md:text-[16px] focus:bg-[#e7e7e7dd] border-[#cecece] py-1 md:py-2" :type="show ? 'password' : 'text'"  name="confirm_password">
              <div class="cursor-pointer absolute bottom-0 top-[-2px] right-[12px] flex items-center">
                <svg class="h-4" fill="none" @click="show = !show"
                  :class="{'hidden': show, 'block':!show }" xmlns="http://www.w3.org/2000/svg"
                  viewbox="0 0 576 512">
                  <path fill="#111827"
                    d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                  </path>
                </svg>
                <svg class="h-4" fill="none" @click="show = !show"
                  :class="{'block': show, 'hidden':!show }" xmlns="http://www.w3.org/2000/svg"
                  viewbox="0 0 640 512">
                  <path fill="#111827"
                    d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                  </path>
                </svg>
              </div>
            </div>
          </div>
          <p class="md:text-[14px] font-semibold text-[10px] mb-10 text-[#adadad]">Only if you want to change your password.</p>
          <div class="flex justify-end">
            <button class="bg-[#111827] mb-6 text-[#fff] text-[12px] md:text-[14px] font-semibold rounded-lg px-4 py-2">Update Profile</button>
          </div>
        </form> 
      </div> 
    </div>
  </div>
@endsection