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
        <h3 class="mb-4 md:text-[20px] text-[16px] capitalize font-medium">Friends</h3>
        <h3 class="md:text[16px] text-[14px] capitalize font-semibold mb-3">Add Friend</h3>
        <form method="POST" action="/user/friend" enctype="multipart/form-data" >
          @csrf
          <div class="flex gap-3 w-[400px] mb-8">
            <input name="username" type="text" class="px-3 rounded-md py-1 border-[1px] border-[#aeafb1]" />
            <button class="text-[12px] md:text-[14px] px-3 py-2 rounded-md bg-[#4B5563] hover:bg-[#3d4755] text-[#fff]">Add Friend</button>
          </div>
        </form>
        <h3 class="md:text[16px] text-[14px] capitalize font-semibold mb-3">Incoming Friend Requests</h3>
        <div class="flex gap-4 flex-wrap mb-8">
          @if (count($friends) == 0)
            <p class="text-[14px] text-[#b1b1b1]">There is no incoming friend request.</p>
          @else
            @foreach ($friends as $friend)
              @if ($friend->status_user == 'Incoming' && $friend->friend_id == Auth::user()->id)
                <form action="/status/accept" enctype="multipart/form-data" method="POST">
                  <div class="bg-[#fcfcfc] w-[300px] rounded-md shadow-md">
                    <div class="flex justify-between px-4 py-5">
                      <div>
                        <div class="flex gap-8 mb-2 items-center">
                          <h3 class="text-[14px] capitalize">Rizki Ashari</h3>
                          <p class="text-[#28a873] bg-[#45f5ac] text-[8px] rounded-[50px] flex px-1 py-0.5">12</p>
                        </div>
                        <h3 class="capitalize text-[#868585] text-[10px]">Member</h3>
                      </div>
                      <img src="https://media.istockphoto.com/photos/little-gamer-in-headset-near-compute-picture-id1342094843?b=1&k=20&m=1342094843&s=170667a&w=0&h=3uN5LbqY_2sJgcdn89JfoiN98k2p4cXy5k9R_zEplFA=" class="inline-block h-12 w-12 rounded-full object-cover"/>
                    </div>
                    <div class="border-b-[1px] border-[#cfcfcf]"></div>
                    <div class="flex justify-between">
                      <button class="flex gap-2 items-center px-10 py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                          <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                          <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Accept
                      </button>
                      <div class="border-[#cfcfcf] border-l-[1px]"></div>
                      <button class="flex gap-2 items-center px-10 py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M11 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                          <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                        Reject
                      </button>
                    </div>
                  </div>
                </form>
              @endif
              @if ($friend->status_friend == 'Incoming' && $friend->user_id == Auth::user()->id)
                <form action="/status/accept" enctype="multipart/form-data" method="POST">
                  <div class="bg-[#fcfcfc] w-[300px] rounded-md shadow-md">
                    <div class="flex justify-between px-4 py-5">
                      <div>
                        <div class="flex gap-8 mb-2 items-center">
                          <h3 class="text-[14px] capitalize">Rizki Ashari</h3>
                          <p class="text-[#28a873] bg-[#45f5ac] text-[8px] rounded-[50px] flex px-1 py-0.5">12</p>
                        </div>
                        <h3 class="capitalize text-[#868585] text-[10px]">Member</h3>
                      </div>
                      <img src="https://media.istockphoto.com/photos/little-gamer-in-headset-near-compute-picture-id1342094843?b=1&k=20&m=1342094843&s=170667a&w=0&h=3uN5LbqY_2sJgcdn89JfoiN98k2p4cXy5k9R_zEplFA=" class="inline-block h-12 w-12 rounded-full object-cover"/>
                    </div>
                    <div class="border-b-[1px] border-[#cfcfcf]"></div>
                    <div class="flex justify-between">
                      <button class="flex gap-2 items-center px-10 py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                          <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                          <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Accept
                      </button>
                      <div class="border-[#cfcfcf] border-l-[1px]"></div>
                      <button class="flex gap-2 items-center px-10 py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M11 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                          <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                        Reject
                      </button>
                    </div>
                  </div>
                </form>
              @endif
              @if($friend->status_user == 'Incoming' && $friend->user_id == Auth::user()->id)
                <p class="text-[14px] text-[#b1b1b1]">There is no incoming friend request.</p>                
              @endif
              @if($friend->status_friend == 'Incoming' && $friend->friend_id == Auth::user()->id)
                <p class="text-[14px] text-[#b1b1b1]">There is no incoming friend request.</p>                
              @endif
            @endforeach  
          @endif
        </div>
        <h3 class="md:text[16px] text-[14px] capitalize font-semibold mb-3">Pending Friend Requests</h3>
        {{-- {{ dd($friends) }} --}}
        <div class="flex gap-4 flex-wrap mb-8">
          @if (count($friends) == 0)
            <p class="text-[14px] text-[#b1b1b1]">There is no incoming friend request.</p>  
          @else
            @foreach ($friends as $friend)
              @if ($friend->status_user == 'Pending' && $friend->friend_id == Auth::user()->id)
                <form action="/status/accept" enctype="multipart/form-data" method="POST">
                  <div class="bg-[#fcfcfc] w-[300px] rounded-md shadow-md">
                    <div class="flex justify-between px-4 py-5">
                      <div>
                        <div class="flex gap-8 mb-2 items-center">
                          <h3 class="text-[14px] capitalize">Rizki Ashari</h3>
                          <p class="text-[#28a873] bg-[#45f5ac] text-[8px] rounded-[50px] flex px-1 py-0.5">12</p>
                        </div>
                        <h3 class="capitalize text-[#868585] text-[10px]">Member</h3>
                      </div>
                      <img src="https://media.istockphoto.com/photos/little-gamer-in-headset-near-compute-picture-id1342094843?b=1&k=20&m=1342094843&s=170667a&w=0&h=3uN5LbqY_2sJgcdn89JfoiN98k2p4cXy5k9R_zEplFA=" class="inline-block h-12 w-12 rounded-full object-cover"/>
                    </div>
                    <div class="border-b-[1px] border-[#cfcfcf]"></div>
                    <div class="flex items-center">
                      <button class="flex gap-2 items-center px-10 py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M11 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                          <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                        Cancel
                      </button>
                    </div>
                  </div>
                </form>
              @endif
              @if ($friend->status_friend == 'Pending' && $friend->user_id == Auth::user()->id)
                <form action="/status/accept" enctype="multipart/form-data" method="POST">
                  <div class="bg-[#fcfcfc] w-[300px] rounded-md shadow-md">
                    <div class="flex justify-between px-4 py-5">
                      <div>
                        <div class="flex gap-8 mb-2 items-center">
                          <h3 class="text-[14px] capitalize">Rizki Ashari</h3>
                          <p class="text-[#28a873] bg-[#45f5ac] text-[8px] rounded-[50px] flex px-1 py-0.5">12</p>
                        </div>
                        <h3 class="capitalize text-[#868585] text-[10px]">Member</h3>
                      </div>
                      <img src="https://media.istockphoto.com/photos/little-gamer-in-headset-near-compute-picture-id1342094843?b=1&k=20&m=1342094843&s=170667a&w=0&h=3uN5LbqY_2sJgcdn89JfoiN98k2p4cXy5k9R_zEplFA=" class="inline-block h-12 w-12 rounded-full object-cover"/>
                    </div>
                    <div class="border-b-[1px] border-[#cfcfcf]"></div>
                    <div class="flex justify-center item-center">
                      <button class="flex gap-2 items-center px-10 py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M11 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                          <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                        Cancel
                      </button>
                    </div>
                  </div>
                </form>
              @endif
              @if($friend->status_user == 'Pending' && $friend->user_id == Auth::user()->id)
                <p class="text-[14px] text-[#b1b1b1]">There is no incoming friend request.</p>                
              @endif
              @if($friend->status_friend == 'Pending' && $friend->friend_id == Auth::user()->id)
                <p class="text-[14px] text-[#b1b1b1]">There is no incoming friend request.</p>                
              @endif    
            @endforeach
          @endif
            
        </div>
        <h3 class="md:text[16px] text-[14px] capitalize font-semibold mb-3">Your Friend</h3>
        <div class="flex gap-4 flex-wrap mb-8">
          <div class="bg-[#fcfcfc] w-[300px] h-[120px] rounded-md shadow-md">
            <div class="flex justify-between px-4 py-5">
              <div>
                <div class="flex gap-8 mb-2 items-center">
                  <h3 class="text-[14px] capitalize">Rizki Ashari</h3>
                  <p class="text-[#28a873] bg-[#45f5ac] text-[8px] rounded-[50px] flex px-1 py-0.5">12</p>
                </div>
                <h3 class="capitalize text-[#868585] text-[10px]">Member</h3>
              </div>
              <img src="https://media.istockphoto.com/photos/little-gamer-in-headset-near-compute-picture-id1342094843?b=1&k=20&m=1342094843&s=170667a&w=0&h=3uN5LbqY_2sJgcdn89JfoiN98k2p4cXy5k9R_zEplFA=" class="inline-block h-12 w-12 rounded-full object-cover"/>
            </div>
          </div>
        </div>
      </div>    
    </div>
  </div> 
  @endsection
  
  


