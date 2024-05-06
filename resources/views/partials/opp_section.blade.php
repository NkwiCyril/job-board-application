<div>
  <div class=" flex justify-between items-center">
    <h2 class="text-gray-900 text-2xl font-bold">Opportunity Listings</h2>
    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-2/5 p-2.5 white:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-900 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search by job title, category or company">
  </div>

  <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">

    @foreach ($opportunities as $opportunity)
    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
      <div class="flex items-end justify-end h-56 w-full bg-cover bg-[url({{$opportunity['image_url']}})]">
        <!-- <button class="p-2 rounded-full bg-[#4ba198] text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
          <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
        </button> -->
      </div>
      <div class="p-3">
        <h3 class="text-gray-700 uppercase">{{$opportunity['title']}}</h3>
        <span class="text-gray-500 mt-2">{{$opportunity['description']}}</span>
        <p>{{$opportunity['image_url']}}</p>
      </div>
    </div>
    @endforeach
</div>