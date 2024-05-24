<header class="fixed inset-x-0 top-0 z-50 border-bottom bg-slate-50 border-customColorDark">
  <nav class="flex items-center justify-between px-10 py-3 lg:px-10" aria-label="Global">
    <div class="flex lg:flex-1">
      <!-- application logo; goes to the home of the authenticated seeker -->
      <a href="{{route('home.index')}}" class="-m-1.5 p-1.5">
        <span class="sr-only">Seeka</span>
        <img class="h-12 w-auto" src="/seeka_logo.png" alt="seeka logo">
      </a>
    </div>

    <!-- responsiveness button in smaller devices -->
    <div class="flex lg:hidden">
      <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
        <span class="sr-only">Open main menu</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
    </div>

    <!-- navigation links and profile -->
    <div class="hidden gap-6 lg:flex items-center lg:flex-1 lg:justify-end sm:flex">
    <a href="{{route('home.index')}}" title="Home" id="nav-item" class="active:text-customColor flex items-center gap-1 text-decoration-none text-xl font-semibold leading-6 transition ease-in-out text-gray-900 hover:text-customColor">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
          <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
          <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
        </svg>
        Home
      </a>


      <!-- include partial for seeker's profile; has link to sign out and edit profile and so on -->
      @include('partials.profile')
    </div>
  </nav>
</header>