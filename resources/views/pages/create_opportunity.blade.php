@extends('layout.app')

@section('content')

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
      <a href="{{route('pages.create_opportunity')}}" title="Post an opportunity" class=" text-decoration-none text-xl font-semibold leading-6 transition ease-in-out text-[#4ba198] hover:text-[#377b74]">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10">
          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
        </svg>
      </a>
      <a href="{{route('pages.create_opportunity')}}" title="Unpublished" class=" text-decoration-none text-xl font-semibold leading-6 transition ease-in-out text-[#4ba198] hover:text-[#377b74]">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10">
          <path d="M9.97.97a.75.75 0 0 1 1.06 0l3 3a.75.75 0 0 1-1.06 1.06l-1.72-1.72v3.44h-1.5V3.31L8.03 5.03a.75.75 0 0 1-1.06-1.06l3-3ZM9.75 6.75v6a.75.75 0 0 0 1.5 0v-6h3a3 3 0 0 1 3 3v7.5a3 3 0 0 1-3 3h-7.5a3 3 0 0 1-3-3v-7.5a3 3 0 0 1 3-3h3Z" />
          <path d="M7.151 21.75a2.999 2.999 0 0 0 2.599 1.5h7.5a3 3 0 0 0 3-3v-7.5c0-1.11-.603-2.08-1.5-2.599v7.099a4.5 4.5 0 0 1-4.5 4.5H7.151Z" />
        </svg>
      </a>
      @include('partials.profile')
    </div>
  </nav>
</header>

<section class="bg-white">
  <div class="py-8 px-4 mx-auto max-w-3xl lg:py-24 sm:py-24">
    <h2 class="mb-4 text-2xl font-bold text-gray-900">Create a New Opportunity</h2>

    <form action="{{route('pages.create_opportunity')}}" method="POST">
    @csrf

      <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
        <div class="sm:col-span-2">
          <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5dark:placeholder-gray-400 dark: dark:focus:border-primary-500" placeholder="Opportunity Title" required>
        </div>

        <div>
          <div class="form-group items-center">
            <!-- <label for="bio" class="mb-2 text-sm font-medium text-gray-900 ">Opportunity Image</label> -->
            <div class="fileinput fileinput-new" data-provides="fileinput">
              <div class="fileinput-new img-thumbnail" style="width: 150px; height: 150px;">
                <img src="https://via.placeholder.com/150x150" alt="opportunity choosen image">
              </div>
              <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 150px; max-height: 150px;"></div>
              <div class="mt-2">
                <span class="btn btn-outline-secondary btn-file hover:bg-[#4ba198]">
                  <span class="fileinput-new">Select Image</span>
                  <span class="fileinput-exists">Change</span>
                  <input type="file" name="image_url" accept="image/*" required>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div>
          <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
          <select required id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:border-primary-500 block w-full p-2.5 dark: dark:focus:border-primary-500">
            <option selected="">Select category</option>
            <option value="1">Job</option>
            <option value="2">Internship</option>
            <option value="3">Volunteerism</option>
          </select>
        </div>



        <div class="sm:col-span-2">
          <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
          <textarea required id="description" name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300  focus:border-primary-500dark:placeholder-gray-400 dark: dark:focus:border-primary-500" placeholder="Opportunity description here"></textarea>
        </div>
      </div>
      <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 font-medium text-center text-white bg-[#4ba198] border-gray-400 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-[#388179]">
        Create
      </button>
    </form>

  </div>
</section>

@endsection