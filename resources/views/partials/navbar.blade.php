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
      <a class="px-8 py-2 mt-2 text-sm font-semibold text-navbarText bg-white rounded-lg dark-mode:bg-white dark-mode:hover:bg-white dark-mode:focus:bg-white dark-mode:focus:text-white md:block hidden dark-mode:hover:text-navbarText dark-mode:text-navbarText md:mt-0 focus:text-navbarText hover:text-[#e9e9e9] focus:bg-white focus:outline-none focus:shadow-outline" href="/">Home</a>
      
    </div>
    <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
      <div class="pl-4 relative md:block hidden">
        <div class="flex">
            <button class="absolute top-0 bottom-0 left-[1.8em] justify-center border-0 rounded-l-md ">
                <svg class="w-5 h-5 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">
                    <path
                        d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" fill="#f1f1f1">
                    </path>
                </svg>
            </button>
            <input type="text" class="pl-[3em] text-[14px] py-2 w-[15em] text-[#fff] rounded-md bg-[#374151]" placeholder="Search...">
        </div>
      </div>
      <a class="px-4 py-2 mt-2 text-sm font-semibold text-navbarText bg-white rounded-lg dark-mode:bg-white dark-mode:hover:bg-white dark-mode:focus:bg-white dark-mode:focus:text-white block md:hidden dark-mode:hover:text-navbarText dark-mode:text-navbarText md:mt-0 hover:text-navbarText focus:text-navbarText hover:bg-white focus:bg-white focus:outline-none focus:shadow-outline" href="/">Home</a>     
      <a class="px-4 py-2 mt-2 text-sm font-semibold text-navbarText bg-white rounded-lg dark-mode:bg-white dark-mode:hover:bg-white dark-mode:focus:bg-white dark-mode:focus:text-white md:mx-3 dark-mode:hover:text-navbarText dark-mode:text-navbarText md:mt-0 hover:text-navbarText focus:text-navbarText hover:bg-white focus:bg-white focus:outline-none focus:shadow-outline {{ $active == 'login' ? 'border-[#0fffff]' : "" }} " href="/login">Login</a>
      <a class="px-3 py-2 mt-2 text-sm md:w-[6em] w-20 border-2 border-[#374151] font-semibold text-navbarText bg-white rounded-lg dark-mode:bg-white dark-mode:hover:bg-white dark-mode:focus:bg-white ml-4 md:ml-0 dark-mode:focus:text-white dark-mode:hover:text-navbarText dark-mode:text-navbarText md:mt-0 hover:text-navbarText focus:text-navbarText hover:bg-white focus:bg-white focus:outline-none focus:shadow-outline" href="/register">Register</a>
      <div class="pl-4 relative block md:hidden mt-2">
        <div class="flex">
            <button class="absolute top-0 bottom-0 left-[1.8em]  justify-center border-0 rounded-l-md ">
                <svg class="w-5 h-5 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">
                    <path
                        d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" fill="#f1f1f1">
                    </path>
                </svg>
            </button>
            <input type="text" class="text-[14px] pl-[3em] py-2 w-[15em] text-[#fff] rounded-md bg-[#374151]" placeholder="Search...">
        </div>
      </div>
    </nav>
  </div>
</div>