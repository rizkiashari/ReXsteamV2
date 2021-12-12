<div class="w-full text-gray-700 bg-[#111827] dark-mode:text-gray-200 dark-mode:bg-gray-800">
  <div x-data="{ open: false }" class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
    <div class="p-4 flex flex-row items-center justify-between">
      <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 15H20C20.55 15 21 14.55 21 14C21 13.45 20.55 13 20 13H4C3.45 13 3 13.45 3 14C3 14.55 3.45 15 4 15ZM4 19H20C20.55 19 21 18.55 21 18C21 17.45 20.55 17 20 17H4C3.45 17 3 17.45 3 18C3 18.55 3.45 19 4 19ZM4 11H20C20.55 11 21 10.55 21 10C21 9.45 20.55 9 20 9H4C3.45 9 3 9.45 3 10C3 10.55 3.45 11 4 11ZM3 6C3 6.55 3.45 7 4 7H20C20.55 7 21 6.55 21 6C21 5.45 20.55 5 20 5H4C3.45 5 3 5.45 3 6Z" fill="#f1f1f1"/>
          </svg>          
      </button>
      <a href="/" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        <img src="/logo.png" class="w-28"/>
      </a>
      <a class="pl-6 pr-4 py-2 mt-2 text-sm font-semibold hover:text-[#afafaf] text-navbarText bg-white rounded-lg dark-mode:bg-white dark-mode:hover:bg-white dark-mode:focus:bg-white dark-mode:focus:text-white md:block hidden dark-mode:hover:text-navbarText dark-mode:text-navbarText md:mt-0 focus:text-navbarText focus:bg-white focus:outline-none focus:shadow-outline {{ $active == "home" ? 'text-[#c44d3e]':"" }} " href="/">Home</a>
      @auth   
        @if (Auth::user()->role_id == 1)
        <a class="px-1 py-2 mt-2 text-sm font-semibold text-navbarText bg-white rounded-lg dark-mode:bg-white dark-mode:hover:bg-white dark-mode:focus:bg-white dark-mode:focus:text-white md:block hidden dark-mode:hover:text-navbarText dark-mode:text-navbarText md:mt-0 focus:text-navbarText hover:text-[#afafaf] focus:bg-white focus:outline-none focus:shadow-outline {{ $active == "manageGame" ? 'text-[#c44d3e]':"" }}" href="/manage-game">Manage Game</a>
        @endif
      @endauth
      
    </div>
    <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
      <div class="pl-4 relative md:block hidden">
        <div class="flex">
          <form action="/search" method="GET">
            @csrf
            <button class="absolute top-0 bottom-0 left-[1.8em] border-0 rounded-l-md ">
                <svg class="w-5 h-5 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">
                    <path
                        d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" fill="#f1f1f1">
                    </path>
                </svg>
            </button>
            <input type="text" name="search_game" class="pl-[3em] text-[14px] py-2 w-[15em] text-[#fff] rounded-md bg-[#374151]" placeholder="Search...">
          </form>
        </div>
      </div>
      <a class="px-4 py-2 mt-2 text-sm font-semibold text-navbarText bg-white rounded-lg dark-mode:bg-white dark-mode:hover:bg-white dark-mode:focus:bg-white dark-mode:focus:text-white block md:hidden dark-mode:hover:text-navbarText dark-mode:text-navbarText md:mt-0 hover:text-[#afafaf] focus:text-navbarText hover:bg-white focus:bg-white focus:outline-none focus:shadow-outline {{ $active == "home" ? 'text-[#c44d3e]':"" }}" href="/">
        Home
      </a>
      @auth
        @if (Auth::user()->role_id == 1)
        <a class="px-4 py-2 mt-2 text-sm font-semibold text-navbarText bg-white rounded-lg dark-mode:bg-white dark-mode:hover:bg-white dark-mode:focus:bg-white dark-mode:focus:text-white block md:hidden dark-mode:hover:text-navbarText dark-mode:text-navbarText md:mt-0 hover:text-[#afafaf] focus:text-navbarText hover:bg-white focus:bg-white focus:outline-none focus:shadow-outline">Manage Game</a>
        @endif
        @if (Auth::user()->role_id == 2)     
        <a href="/shopping-cart" class="px-4 py-2 mt-2 text-sm font-semibold text-navbarText bg-white rounded-lg dark-mode:bg-white dark-mode:hover:bg-white dark-mode:focus:bg-white dark-mode:focus:text-white md:mx-3 dark-mode:hover:text-navbarText dark-mode:text-navbarText md:mt-0 hover:text-[#afafaf]  focus:text-navbarText hover:bg-white focus:bg-white focus:outline-none focus:shadow-outline">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>
        </a>
        @endif

        <div x-data="{ dropdown: false }">
          <button @click="dropdown = !dropdown">
            @if (Auth::user()->role_id == 1)
              @if (Auth::user()->photo == null)
                <div class="inline-block h-10 w-10 md:ml-4 ml-4 md:my-0 my-4 rounded-full ring-2 ring-white">
                  <p class="text-[#fff] uppercase mt-1 font-medium font-Oswald text-[20px]" >{{ substr(Auth::user()->fullname , 0, 1) }}</p>              
                </div>
              @else
                <img class="inline-block h-10 w-10 md:ml-4 ml-4 md:my-0 my-4 rounded-full ring-2 ring-white" src="{{ asset('profile/'.Auth::user()->photo) }}" alt="profile user">              
              @endif
            @else
              @if (Auth::user()->photo == null)
                <div class="inline-block h-10 w-10 md:ml-0 ml-4 md:my-0 my-4 rounded-full ring-2 ring-white">
                  <p class="text-[#fff] mt-1 uppercase font-medium font-Oswald text-[20px]" >{{ substr(Auth::user()->fullname , 0, 1) }}</p>              
                </div>
              @else
                <img class="inline-block h-10 w-10 md:ml-4 ml-4 md:my-0 my-4 rounded-full ring-2 ring-white" src="{{ asset('profile/'.Auth::user()->photo) }}" alt="profile user">                
              @endif                           
            @endif
          </button>
        
          <div x-show="dropdown" class="absolute z-[99] right-[10em] mt-2 py-2 w-56 bg-[#f1f1f1] rounded-md shadow-xl">
            <a href="/user/profile" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
              Profile
            </a>
            @if (Auth::user()->role_id == 2)
            <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
              Friends
            </a>
            <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
              Transaction History
            </a>
            @endif
            <form method="POST" action="/logout">
              @csrf
              <button class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                Sign Out
              </button>
            </form>
          </div>
        </div>
          @else
          <a class="px-4 py-2 mt-2 text-sm font-semibold text-navbarText bg-white rounded-lg dark-mode:bg-white dark-mode:hover:bg-white dark-mode:focus:bg-white dark-mode:focus:text-white md:mx-3 dark-mode:hover:text-navbarText dark-mode:text-navbarText md:mt-0 hover:text-[#afafaf]  focus:text-navbarText hover:bg-white focus:bg-white focus:outline-none focus:shadow-outline {{ $active == "login" ? 'text-[#c44d3e]':"" }} " href="/login">
            Login
          </a>
          <a class="px-3 py-2 mt-2 text-sm md:w-[6em] w-20 border-2 border-[#374151] font-semibold text-navbarText bg-white rounded-lg dark-mode:bg-white dark-mode:hover:bg-white dark-mode:focus:bg-white ml-4 md:ml-0 dark-mode:focus:text-white dark-mode:hover:text-navbarText dark-mode:text-navbarText md:mt-0 hover:text-[#afafaf]  focus:text-navbarText hover:bg-white focus:bg-white focus:outline-none focus:shadow-outline {{ $active == "register" ? 'text-[#c44d3e]' : "" }}" href="/register">
            Register
          </a>
      @endauth  
      <div class="pl-4 relative block md:hidden mt-2">
        <div class="flex">
          <form action="/search" method="GET">
            @csrf
            <button class="absolute top-0 bottom-0 left-[1.8em] border-0 rounded-l-md ">
              <svg class="w-5 h-5 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" fill="#f1f1f1"></path>
              </svg>
            </button>
            <input type="text" name="search_game" class="text-[14px] pl-[3em] py-2 w-[15em] text-[#fff] rounded-md bg-[#374151]" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>
  </div>
</div>