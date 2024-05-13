@extends('layout.app')

@section('title', 'Seeka | Apply for Opportunity')

@section('content')
@if(Auth::check())

<x-seeker_header></x-seeker_header>

@else

<x-guest_header></x-guest_header>

@endif
<!-- Card Section -->
<div class="max-w-4xl px-4 py-10 mt-20 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Card -->
  <div class="bg-white rounded-xl shadow p-4 sm:p-7">
    @if (Auth::check())
    <form action="{{route('pages.submit_application', $opportunity->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="sm:col-span-12">
          <h2 class="text-2xl font-semibold text-gray-800 text-center py-3">
            Submit your application to <span class="border-b-2 border-black">{{$opportunity->user->name}}</span>
          </h2>
          <h3 class="text-xl font-medium text-gray-800 text-center py-1">
            Applying for <b>{{$opportunity->title}}</b>
          </h3>
        </div>
      <!-- Section -->
      <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">

        <div class="sm:col-span-3">
          <label for="full-name" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
            Full name
          </label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <div class="sm:flex">
            <input required id="full-name" name="full-name" value="{{Auth::user()->name}}" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px rounded-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-customColor focus:ring-customColor disabled:opacity-50 disabled:pointer-events-none">
          </div>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-3">
          <label for="email" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
            Email
          </label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <input required id="email" name="email" value="{{Auth::user()->email}}" type="email" autocomplete="email" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-customColor focus:ring-customColor disabled:opacity-50 disabled:pointer-events-none">
        </div>
        <!-- End Col -->

        <div class="sm:col-span-3">
          <div class="inline-block">
            <label for="phone" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
              Phone
            </label>
          </div>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <input required id="phone" name="phone-number" value="{{Auth::user()->phone_number}}" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-customColor focus:ring-customColor disabled:opacity-50 disabled:pointer-events-none">
        </div>

      </div>
      <!-- End Section -->

      <!-- Section -->
      <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
        <div class="sm:col-span-12">
          <h2 class="text-lg font-semibold text-gray-800">
            Profile
          </h2>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-3">
          <label for="resume-cv" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
            Resume/CV
          </label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <label for="resume" class="sr-only">Choose file</label>
          <input required type="file" name="resume" id="resume" accept=".doc, .docx, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, .pdf" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-customColor focus:ring-customColor disabled:opacity-50 disabled:pointer-events-none file:border-0 file:me-4 file:py-2 file:px-4">
        </div>
        <!-- End Col -->

        <div class="sm:col-span-3">
          <div class="inline-block">
            <label for="bio" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
              Bio (Personal Summary)
            </label>
          </div>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <textarea required id="bio" name="bio" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-customColor focus:ring-customColor disabled:opacity-50 disabled:pointer-events-none" rows="6" placeholder="Add a cover letter or anything else you want to share.">{{old('bio')}}</textarea>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Section -->

      <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-customColor text-white hover:bg-customColorDark disabled:opacity-50 disabled:pointer-events-none">
        Submit application
      </button>
    </form>
    @else
    <form action="{{route('pages.submit_application', $opportunity->id)}}" method="POST">
      @csrf
      <div class="sm:col-span-12">
          <h2 class="text-2xl font-semibold text-gray-800 text-center py-3">
            Submit your application to <span class="border-b-2 border-black">{{$opportunity->user->name}}</span>
          </h2>
          <h3 class="text-xl font-medium text-gray-800 text-center py-1">
            Applying for <b>{{$opportunity->title}}</b>
          </h3>
        </div>
      <!-- Section -->
      <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
        <div class="sm:col-span-3">
          <label for="full-name" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
            Full name
          </label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <div class="sm:flex">
            <input required id="full-name" name="full-name" value="{{old('full-name')}}" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px rounded-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-customColor focus:ring-customColor disabled:opacity-50 disabled:pointer-events-none">
          </div>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-3">
          <label for="email" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
            Email
          </label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <input required id="email" name="email" value="{{old('email')}}" type="email" autocomplete="email" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-customColor focus:ring-customColor disabled:opacity-50 disabled:pointer-events-none">
        </div>
        <!-- End Col -->

        <div class="sm:col-span-3">
          <div class="inline-block">
            <label for="phone" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
              Phone
            </label>
          </div>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <input required id="phone" name="phone-number" value="{{old('phone-number')}}" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-customColor focus:ring-customColor disabled:opacity-50 disabled:pointer-events-none">
        </div>
        <!-- End Col -->
      </div>
      <!-- End Section -->

      <!-- Section -->
      <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
        <div class="sm:col-span-12">
          <h2 class="text-lg font-semibold text-gray-800">
            Profile
          </h2>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-3">
          <label for="resume-cv" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
            Resume/CV
          </label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <label for="resume-cv" class="sr-only">Choose file</label>
          <input required type="file" value="{{old('resume')}}" name="resume" id="resume" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-customColor focus:ring-customColor disabled:opacity-50 disabled:pointer-events-none file:border-0 file:me-4 file:py-2 file:px-4">
        </div>
        <!-- End Col -->

        <div class="sm:col-span-3">
          <div class="inline-block">
            <label for="bio" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
              Bio (Personal Summary)
            </label>
          </div>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <textarea required id="bio" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-customColor focus:ring-customColor disabled:opacity-50 disabled:pointer-events-none" rows="6" placeholder="Add a cover letter or anything else you want to share.">{{old('bio')}}</textarea>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Section -->

      <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-customColor text-white hover:bg-customColorDark disabled:opacity-50 disabled:pointer-events-none">
        Submit application
      </button>
    </form>
    @endif

  </div>
  <!-- End Card -->
</div>
<!-- End Card Section -->
@endsection