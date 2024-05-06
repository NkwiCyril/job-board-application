<div>
  <div class="flex justify-between items-center">
    <div class="flex items-center justify-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
        <path d="M5.625 3.75a2.625 2.625 0 1 0 0 5.25h12.75a2.625 2.625 0 0 0 0-5.25H5.625ZM3.75 11.25a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5H3.75ZM3 15.75a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75ZM3.75 18.75a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5H3.75Z" />
      </svg>
      <h2 class="text-2xl font-bold">Opportunity Listings</h2>
    </div>
    <input type="text" name="search" id="search_field" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-customColor focus:border-primary-600 block w-2/5 p-2.5 white:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-600 dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search by job title, category or company">
  </div>

  <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">

    @foreach ($opportunities as $opportunity)
    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
      <div class="flex items-end justify-end h-56 w-full bg-cover bg-[url({{$opportunity['image_url']}})]">
        <img src="{{$opportunity['image_url']}}" class=" object-cover w-100" alt="opportunity_image">
      </div>
      <div class="p-3">
        <a href="" class=" text-decoration-none no-underline">
          <h3 class="text-gray-700 uppercase hover:text-customColor font-medium">{{$opportunity['title']}}</h3>
        </a>
        <span class="text-gray-500 mt-2 text-sm">{{$opportunity['description']}}</span>
      </div>
    </div>
    @endforeach
  </div>