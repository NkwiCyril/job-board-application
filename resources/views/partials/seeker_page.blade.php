<body class="bg-white">
  <header class="absolute inset-x-0 top-0 z-50 border-bottom border-customColorDark">
    <nav class="flex items-center justify-between px-10 py-3 lg:px-10" aria-label="Global">
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
      <div class="{{--hidden--}} gap-6 lg:flex items-center lg:flex-1 lg:justify-end sm:flex">
        <a href="{{route('pages.applications')}}" title="My Applications" class=" hover:no-underline text-xl font-semibold leading-6 text-gray-900 transition ease-in-out hover:text-customColor">My Seeks</a>
        <svg class="h-8 w-8 hover:text-customColor cursor-pointer" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
        </svg>
        @include('partials.profile')
      </div>
    </nav>
  </header>
  <div class="intro mx-auto mt-20 p-10">
    @include('partials.opp_section')
  </div>
</body>

<script>

  

</script>