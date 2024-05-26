@extends('layout.app')

@section('content')

@if (session('success'))
<!-- Alert Banner -->
<div id="success-alert" class=" alert alert-success hs-removing:-translate-y-full bg-customColor" data-auto-dismiss="2000">
  <div class="max-w-[85rem] p-2 sm:px-6 lg:px-8 mx-auto">
    <div class="flex items-center justify-center">
      <p class="text-white">
        {{ session('success') }}
      </p>
    </div>
  </div>
</div>
<!-- End Alert Banner -->
@endif

<body class=" h-full">
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <a href="{{route('home.index')}}">
        <img class="mx-auto h-12 w-auto" src="/seeka_logo.png" alt="seeka">
      </a>
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

      @if ($errors->has('error'))
      <div class="alert alert-danger text-center" id="error-alert" role="alert">
        {{ $errors->first('error') }}
      </div>
      @endif

      <form class="space-y-3" action="{{route('login.auth')}}" method="POST">
        @csrf

        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>
        @error('email')
        <em class=" text-sm text-danger">{{$message}}</em>
        @enderror
        {{-- password input --}}
        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          </div>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>
        {{-- end of password input --}}
        @error('password')
        <em class=" text-sm text-danger">{{$message}}</em>
        @enderror

        <!-- Checkbox -->
        <div class="flex items-center">
          <div>
            <input id="remember_me" name="remember_me" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-customColor focus:customColor dark:bg-gray-100 dark:border-customColor dark:checked:bg-customColor dark:checked:border-customColor dark:focus:ring-offset-customColor">
          </div>
          <div class="mx-2 flex items-center">
            <label for="remember_me" class="mt-[7px] text-sm font-medium leading-6 text-gray-900">Remember me</label>
          </div>
        </div>
        <!-- End Checkbox -->

        <div x-data="{ isLoading: false }">
          <button x-on:click="if(document.getElementById('email').value && document.getElementById('password').value) {
                isLoading = true; 
              }" :class="{ 'd-none': isLoading }" type="submit" class="flex w-full justify-center rounded-md bg-customColor px-3 py-1.5 text-lg font-semibold leading-6 text-white shadow-sm hover:bg-[#386964] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#386964]">
            Sign In
          </button>
          <div class="flex items-center justify-center">
            <div x-show="isLoading" class="spinner-border text-customColor text-center" role="status"></div>
          </div>
        </div>

      </form>

      <p class="mt-10 text-center text-sm text-gray-500">
        Don't have an account?
        <a href="{{route('register.index')}}" class="font-semibold leading-6 text-customColor hover:text-customColorDark">Sign Up</a>
      </p>
    </div>
  </div>
</body>
@endsection

<script>
  // Auto-dismiss flash messages after a specified duration
  document.addEventListener('DOMContentLoaded', function() {
    const alert = document.getElementById('success-alert');
    if (alert) {
      const duration = parseInt(alert.getAttribute('data-auto-dismiss'));
      setTimeout(function() {
        alert.remove();
      }, duration);
    }

    const error_alert = document.getElementById('error-alert');
    if (error_alert) {
      setTimeout(() => {
        error_alert.remove();
      }, 5000);
    }

  });
</script>