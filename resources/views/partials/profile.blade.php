<div class="relative inline-block items text-left">
  <div>
    <button type="button" id="profile_btn" class="inline-flex items-center text-sm font-semibold leading-6 text-gray-900" aria-expanded="false">
      <span class="flex items-center text-xl font-semibold leading-6 text-gray-900 transition ease-in-out hover:text-customColor">
        <div class="flex items-center w-fit">
          <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
          </div>
        </div>
      </span>
    </button>
  </div>


  <div id="profile_menu" class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" tabindex="-1">
    <div class="py-1" role="none">
      <a href="{{route('pages.profile', [$id = Auth::user()->id])}}" class="text-gray-800 hover:text-customColor hover:no-underline flex items-center gap-2 px-4 py-2 text-lg " tabindex="-1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
          <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
        </svg>
        Your Profile
      </a>
      <form method="POST" action="{{route('auth.logout')}}" role="none">
        @csrf

        <button type="submit" name="user_id" value="{{Auth::user()->id}}" class="flex gap-2 items-center text-gray-800 hover:text-customColor hover:no-underline w-full px-4 py-2 text-left text-lg" role="menuitem" tabindex="-1" id="menu-item-3">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm10.72 4.72a.75.75 0 0 1 1.06 0l3 3a.75.75 0 0 1 0 1.06l-3 3a.75.75 0 1 1-1.06-1.06l1.72-1.72H9a.75.75 0 0 1 0-1.5h10.94l-1.72-1.72a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
          </svg>
          Sign out
        </button>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('profile_btn').addEventListener('click', function() {
      var profileMenu = document.getElementById('profile_menu');
      if (profileMenu.classList.contains('hidden')) {
        profileMenu.classList.remove('hidden')
      } else {
        profileMenu.classList.add('hidden');
      }
    });
  </script>