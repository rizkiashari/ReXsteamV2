@extends('layout.main')

@section('content')
    <div class="px-8 py-8 w-full min-h-[85vh]">
      <div class="bg-[#fff] rounded-[4px] w-[100%] flex flex-col md:flex-row">
        <div class="flex flex-col mt-4 gap-2 md:gap-10 md:flex-row">
          @include('partials.sidenav')
          <div class="border-l-2 border-[#f3f3f3]"></div>
        </div>
        <div class="w-full mt-4 px-5 py-4">
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
                  <p class="w-full px-2 md:px-3 border-[1px] rounded-[8px] text-[12px] md:text-[16px] focus:bg-[#e7e7e7dd] border-[#cecece] py-1 md:py-2">0</p>
                </div>
              </div>
              <div class="w-full">
                <h3 class="mb-2 text-[12px] font-semibold md:text-[16px]">Full Name</h3>
                <input type="text" name="fullname" class="w-full px-2 md:px-3 border-[1px] rounded-[8px] text-[12px] md:text-[16px] focus:bg-[#e7e7e7dd] border-[#cecece] py-1 md:py-2" value="{{ $user->fullname }}">
              </div>
            </div>     
            <div class="w-[250px] h-auto">
              <h3 class="mb-2">Photo</h3>
              <img class="inline-block h-[100px] w-[100px] md:h-[150px] md:w-[150px] rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
            </div>         
          </div>
          <h3 class="mb-1 text-[12px] font-semibold md:text-[16px]">Current Password</h3>
          <input type="password" class="w-full mb-1 px-2 md:px-3 border-[1px] rounded-[8px] text-[12px] md:text-[16px] focus:bg-[#e7e7e7dd] border-[#cecece] py-1 md:py-2" name="current_password">
          <p class="md:text-[14px] text-[10px] mb-4 text-[#adadad]">Fill out this field to check if you are authorized.</p>
          <h3 class="mb-1 text-[12px] font-semibold md:text-[16px]">New Password</h3>
          <input type="password" class="w-full mb-1 px-2 md:px-3 border-[1px] rounded-[8px] text-[12px] md:text-[16px] focus:bg-[#e7e7e7dd] border-[#cecece] py-1 md:py-2" name="new_password">
          <p class="md:text-[14px] text-[10px] mb-4 text-[#adadad]">Only if you want to change your password.</p>
          <h3 class="mb-1 text-[12px] font-semibold md:text-[16px]">Confirm New Password</h3>
          <input type="password" class="w-full mb-1 px-2 md:px-3 border-[1px] rounded-[8px] text-[12px] md:text-[16px] focus:bg-[#e7e7e7dd] border-[#cecece] py-1 md:py-2" name="confirm_password">
          <p class="md:text-[14px] font-semibold text-[10px] mb-10 text-[#adadad]">Only if you want to change your password.</p>
          <div class="flex justify-end">
            <button class="bg-[#111827] mb-6 text-[#fff] text-[12px] md:text-[14px] font-semibold rounded-lg px-4 py-2">Update Profile</button>
          </div>
      </div>
    </div>
@endsection