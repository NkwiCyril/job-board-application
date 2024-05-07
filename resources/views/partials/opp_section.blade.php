<div>
  <div class="flex-1 justify-between items-center">
    <div class="flex items-center justify-center gap-2">
      <input autocomplete type="text" name="search" id="search_field" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-customColor focus:border-customColor block w-2/5 p-2.5 white:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-600 dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search by job title, category or company">
      <select name="filter" id="filter" class="text-gray-900 text-sm rounded-lg focus:ring-customColor p-2.5 focus:border-customColor">
        <option value="">Filter</option>
        <option value="1">Jobs</option>
        <option value="2">Internships</option>
        <option value="3">Volunteerism</option>
      </select>
    </div>
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
        <div class=" flex-col justify-end">
          <p class="text-gray-500 mt-2 text-sm">
            @php
              $desc = $opportunity['description'];
              if (($desc) > 50) {
                $desc = substr($desc, 0, 50). '...';
              }
            @endphp
            {{$desc}}
          </p>
          @if ($opportunity['category_id'] === 1)
          <span class="inline-flex items-center rounded-md bg-green-50 mt-2 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Job</span>
          @elseif ($opportunity['category_id'] === 2)
          <span class="inline-flex items-center rounded-md bg-blue-50 mt-2 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Internship</span>
          @elseif ($opportunity['category_id'] === 3)
          <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 mt-2  py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Volunteerism</span>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>