@extends('layout.app')

@section('content')

<body class="h-full">
  <div class="flex min-h-full flex-col justify-center px-6 py-5 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">

      <a href="{{route('welcome')}}">
        <img class="mx-auto h-12 w-auto" src="/seeka_logo.png" alt="seeka">
      </a>

      <h2 class="mt-5 text-center text-2xl font-bold leading-5 tracking-tight text-gray-900">Let's get you ready!</h2>
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="#" method="POST">
        <div>
          <label for="usertype" class="block text-sm font-medium leading-6 text-gray-900">Register As</label>
          <select name="usertype" id="usertype" class=" mt-2 block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
            <option value="company" class="py-1">Company</option>
            <option value="seeker" class="py-1">Seeker</option>
          </select>
        </div>
        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email Address</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-[#4ba198] px-3 py-1.5 text-lg font-semibold leading-6 text-white shadow-sm hover:bg-[#386964] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#386964]">Sign Up</button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm text-gray-500">
        Already have an account?
        <a href="{{route('auth.register')}}" class="font-semibold leading-6 text-[#2a645e] hover:text-[#4ba198]">Sign In</a>
      </p>

    </div>
  </div>
</body>
@endsection