@extends('layout.app')

@section('content')

<body class=" h-full">
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <a href="{{route('pages.home')}}">
        <img class="mx-auto h-12 w-auto" src="/seeka_logo.png" alt="seeka">
      </a>
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

      @if ($errors->has('email'))
      <span class="invalid-feedback text-red-700">
        <strong>
          {{ $errors->first('email') }}
        </strong>
      </span>
      @endif

      <form class="space-y-6" action="{{route('auth.authenticate')}}" method="POST">
        @csrf

        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          </div>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-[#4ba198] px-3 py-1.5 text-lg font-semibold leading-6 text-white shadow-sm hover:bg-[#386964] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#386964]">Sign In</button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm text-gray-500">
        Don't have an account?
        <a href="{{route('auth.register')}}" class="font-semibold leading-6 text-[#4ba198] hover:text-[#2a645e]">Sign Up</a>
      </p>
    </div>
  </div>
</body>
@endsection