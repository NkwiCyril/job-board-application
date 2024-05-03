@extends('layout.app')

@section('content')

<body class="h-full">
  <div class="flex min-h-full flex-col justify-center px-6 py-3 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-lg">

      <a href="{{route('pages.home')}}">
        <img class="mx-auto h-12 w-auto" src="/seeka_logo.png" alt="seeka">
      </a>

      <h2 class="mt-5 text-center text-2xl font-bold leading-5 tracking-tight text-gray-900">Let's get you ready!</h2>
    </div>
    <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-3" action="{{route('auth.register')}}" method="POST">
        @csrf
        @include('partials.usertype')
        <div>
          <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
          <div class="mt-2">
            <input placeholder="Your Name" id="name" name="name" type="text" autocomplete="name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>
        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email Address</label>
          <div class="mt-2">
            <input placeholder="Your Email" id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          <div class="mt-2">
            <input placeholder="Password" id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>

        <div>
          <label for="tel" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
          <div class="mt-2">
            <input placeholder="Your Phone Number" id="tel" name="phone_number" autocomplete="tel-country-code" type="tel" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>
        <div id="category" class="hidden">
          @include('partials.category')
        </div>
        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-[#4ba198] px-3 py-1.5 text-lg font-semibold leading-6 text-white shadow-sm hover:bg-[#386964] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#386964]">Sign Up</button>
        </div>
      </form>

      <p class="mt-5 text-center text-sm text-gray-500">
        Already have an account?
        <a href="{{route('auth.login')}}" class="font-semibold leading-6 text-[#2a645e] hover:text-[#4ba198]">Sign In</a>
      </p>

    </div>
  </div>
</body>
@endsection