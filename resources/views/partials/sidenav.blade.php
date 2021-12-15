<div class="flex flex-col h-full p-3 w-52">
  <div class="space-y-3">
    <div class="flex-1">
      <ul class="space-y-1 text-sm">
        <li class="rounded-sm mb-1">
          <a href="/user/profile" class="flex transition-all items-center p-2 {{ $active == "profile" ? 'border-l-4 border-[#053535]':"" }} space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
            <span>Profile</span>
          </a>
        </li>
        @auth
          @if(Auth::user()->role_id == 2)
            <li class="rounded-sm mb-1">
              <a href="/user/friend" class="flex transition-all items-center p-2 {{ $active == "friend" ? 'border-l-4 border-[#053535]':"" }} space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                </svg>
                <span>Friends</span>
              </a>
            </li>
            <li class="rounded-sm mb-1">
              <a href="/history" class="flex items-center p-2 transition-all {{ $active == "history" ? 'border-l-4 border-[#053535]':"" }} space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                  <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                </svg>
                <span>Transaction History</span>
              </a>
            </li>
          @endif
         
        @endauth
      </ul>
    </div>
  </div>
</div>