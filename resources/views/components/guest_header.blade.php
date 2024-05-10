<header class="fixed inset-x-0 top-0 z-50 border-bottom bg-slate-50 border-customColorDark">
    <nav class="flex items-center justify-between px-6 py-3 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="{{route('pages.home')}}" class="-m-1.5 p-1.5 flex items-center gap-2 hover:text-decoration-none hover:no-underline text-customColor">
          <img class="h-12 w-auto" src="/seeka_logo.png" alt="seeka logo">
          <span class="font-bold text-4xl">Seeka</span>
        </a>
      </div>
      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Open main menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <div class="hidden gap-5 lg:flex lg:flex-1 lg:justify-end items-center">
        <a href="{{route('auth.login')}}" class=" text-xl font-semibold leading-6 text-gray-900 transition ease-in-out hover:text-customColor hover:no-underline">Login</a>
        <a href="{{route('auth.register')}}" class=" border border-black rounded-md p-1 text-xl font-semibold leading-6 text-gray-900 transition ease-in-out hover:bg-customColor hover:text-white hover:no-underline">Sign Up</a>
      </div>
    </nav>
  </header>