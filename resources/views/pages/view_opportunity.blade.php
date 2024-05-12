@extends('layout.app')

@section('content')

@if(Auth::check())

<x-seeker_header></x-seeker_header>

@else

<x-guest_header></x-guest_header>

@endif

<!-- Blog Article -->
<div class="max-w-3xl px-4  lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
  <div class="max-w-2xl py-20">
    <!-- Avatar Media -->
    <div class="flex justify-between items-center mb-6">
      <div class="flex w-full sm:items-center gap-x-5 sm:gap-x-3">
        <div class="flex-shrink-0">
          <img class="size-12 rounded-full" src="{{$opportunity->image_url}}" alt="Image Description">
        </div>

        <div class="grow">
          <div class="flex justify-between items-center gap-x-2">
            <div>
              <!-- Tooltip -->
              <div class="hs-tooltip [--trigger:hover] [--placement:bottom] inline-block">
                <div class="hs-tooltip-toggle sm:mb-1 block text-start cursor-pointer">
                  <span class="font-semibold text-gray-800 dark:text-gray-900">
                    {{$opportunity->title}}
                  </span>

                  <!-- Dropdown Card -->
                  <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 max-w-xs cursor-default bg-gray-900 divide-y divide-gray-700 shadow-lg rounded-xl dark:bg-neutral-950 dark:divide-neutral-700" role="tooltip">
                    <!-- Body -->
                    <div class="p-4 sm:p-5">
                      <div class="mb-2 flex w-full sm:items-center gap-x-5 sm:gap-x-3">
                        <div class="flex-shrink-0">
                          <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1669837401587-f9a4cfe3126e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Image Description">
                        </div>

                        <div class="grow">
                          <p class="text-lg font-semibold text-gray-200 dark:text-gray-900">
                            Leyla Ludic
                          </p>
                        </div>
                      </div>
                      <p class="text-sm text-gray-400 dark:text-neutral-400">
                        Leyla is a Customer Success Specialist at Preline and spends her time speaking to in-house recruiters all over the world.
                      </p>
                    </div>
                    <!-- End Body -->
                  </div>
                  <!-- End Dropdown Card -->
                </div>
              </div>
              <!-- End Tooltip -->

              <ul class="text-xs text-gray-500 dark:text-neutral-500">
                <li class="text-sm inline-block relative pe-6 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-2 before:-translate-y-1/2 before:size-1 before:bg-gray-300 before:rounded-full dark:text-neutral-500 dark:before:bg-neutral-600">
                  Published {{$published_at}}
                </li>
                <li class="text-sm inline-block relative pe-6 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-2 before:-translate-y-1/2 before:size-1 before:bg-gray-300 before:rounded-full dark:text-neutral-500 dark:before:bg-neutral-600">
                  {{$opportunity->user->name}}
                </li>
              </ul>
            </div>

            <!-- Button Group -->
            <div>
              <a href="{{route('pages.application', $opportunity->id)}}">
                <button type="button" class="py-1.5 px-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-customColor bg-customColor text-gray-100 shadow-sm hover:bg-customColor disabled:opacity-50 disabled:pointer-events-none ">
                  Apply
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                  </svg>
                </button>
              </a>
            </div>
            <!-- End Button Group -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Avatar Media -->

    <!-- Content -->
    <div class="space-y-5 md:space-y-8">
      <div class="space-y-3">
        <h2 class="text-2xl font-bold md:text-3xl dark:text-gray-900">{{$opportunity->title}}</h2>

        <p class="text-lg text-gray-800 dark:text-gray-900">
          {{$opportunity->description}}
        </p>

      </div>

    </div>
    <!-- End Content -->
  </div>
</div>
<!-- End Blog Article -->

@endsection