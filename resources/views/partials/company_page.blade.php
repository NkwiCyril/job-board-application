<body class="bg-white">
<header class="absolute inset-x-0 top-0 z-50">
  <nav class="flex items-center justify-between px-6 py-3 lg:px-8" aria-label="Global">
    <div class="flex lg:flex-1">
      <a href="{{route('pages.home')}}" class="-m-1.5 p-1.5">
        <span class="sr-only">Seeka</span>
        <img class="h-12 w-auto" src="/seeka_logo.png" alt="seeka logo">
      </a>
    </div>
    <!-- <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Open main menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div> -->
    <div class="{{--hidden--}} items-center justify-center gap-5 lg:flex lg:flex-1 lg:justify-end sm:flex">
      <a href="{{route('pages.create_opportunity')}}" title="Post an opportunity" class="text-decoration-none flex items-center gap-1 text-xl font-semibold leading-6 transition ease-in-out text-customColor hover:text-customColorDark">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
        </svg>
        Create
      </a>
      <a href="" title="Unpublished" class=" flex items-center gap-1 text-decoration-none text-xl font-semibold leading-6 transition ease-in-out text-customColor hover:text-customColorDark">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
          <path d="M9.97.97a.75.75 0 0 1 1.06 0l3 3a.75.75 0 0 1-1.06 1.06l-1.72-1.72v3.44h-1.5V3.31L8.03 5.03a.75.75 0 0 1-1.06-1.06l3-3ZM9.75 6.75v6a.75.75 0 0 0 1.5 0v-6h3a3 3 0 0 1 3 3v7.5a3 3 0 0 1-3 3h-7.5a3 3 0 0 1-3-3v-7.5a3 3 0 0 1 3-3h3Z" />
          <path d="M7.151 21.75a2.999 2.999 0 0 0 2.599 1.5h7.5a3 3 0 0 0 3-3v-7.5c0-1.11-.603-2.08-1.5-2.599v7.099a4.5 4.5 0 0 1-4.5 4.5H7.151Z" />
        </svg>
        Publish
      </a>
      @include('partials.profile')
    </div>
  </nav>
</header>
  <div class="intro text-center prose lg:prose-xl mx-auto mt-20 p-10">
    <h1>all opps will display here for to view {{Auth::user()->name}}</h1>
  </div>
</body>