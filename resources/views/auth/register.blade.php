@extends('layout.app')

@section('content')

@if (session('success'))
{{-- Alert Banner --}}
<div id="success-alert" class=" alert alert-success hs-removing:-translate-y-full bg-customColor" data-auto-dismiss="2000">
  <div class="max-w-[85rem] p-2 sm:px-6 lg:px-8 mx-auto">
    <div class="flex">
      <p class="text-white">
        {{ session('success') }}
      </p>
    </div>
  </div>
</div>
{{-- End Alert Banner --}}
@endif

<body class="h-full">
  <div class="flex min-h-full flex-col justify-center px-6 py-3 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-lg">

      <a href="{{route('home.index')}}">
        <img class="mx-auto h-12 w-auto" src="/seeka_logo.png" alt="seeka">
      </a>

      <h2 class="mt-5 text-center text-2xl font-bold leading-5 tracking-tight text-gray-900">Let's get you ready!</h2>
    </div>
    <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-sm">

      @if ($errors->has('error'))
      <div class="alert alert-danger text-center" id="error-alert" role="alert">
        {{ $errors->first('error') }}
      </div>
      @endif
      
      {{-- form start --}}
      <form  class="space-y-3" @submit.prevent="if (document.getElementById('email').value && document.getElementById('password').value && document.getElementById('usertype').value && document.getElementById('name').value && document.getElementById('phone_number').value) {
            isLoading = true; 
            formFilled = true;
            $el.submit(); // this submits the form if all fields are filled
        } else {
            formFilled = false;
            alert('Please fill all required fields');
        }" action="{{ route('auth.register') }}" method="POST">

        @csrf

        @include('partials.usertype') {{-- partials to select usertype --}}
        
        {{-- username field --}}
        <div>
          <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
          <div class="mt-2">
            <input placeholder="Your Name" id="name" name="name" value="{{old('name')}}" maxlength="50" type="text" autocomplete="name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>
        {{-- end of username field --}}

        {{-- email field --}}

        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email Address</label>
          <div class="mt-2">
            <input placeholder="Your Email" id="email" name="email" value="{{old('email')}}" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>
        {{-- end of email field --}}
        @error('email')
          <em class=" text-sm text-danger">{{$message}}</em>
        @enderror

        {{-- password field --}}
        <div>
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          <div class="mt-2">
            <input placeholder="Password" id="password" name="password" value="{{old('password')}}" minlength="8" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>
        {{-- end of password field --}}
        @error('password')
          <em class=" text-sm text-danger">{{$message}}</em>
        @enderror


        {{-- password field --}}
        <div>
          <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
          <div class="mt-2">
            <input placeholder="Confirm Password" id="password_confirmation" value="{{old('password_confirmation')}}" minlength="8" name="password_confirmation" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>
        {{-- end of password field --}}
        @error('confirm_password')
          <em class=" text-sm text-danger">{{$message}}</em>
        @enderror


        
        {{-- phone number field start --}}
        <div>
          <label for="tel" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
          <div class="mt-2">
            <input placeholder="Your Phone Number" id="tel" name="phone_number" value="{{old('phone_number')}}" autocomplete="tel-country-code"  minlength="9" maxlength="20" type="tel" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#386964] sm:text-sm sm:leading-6">
          </div>
        </div>
        {{-- phone number field end --}}
        @error('phone_number')
        <em class=" text-sm text-danger">{{$message}}</em>
        @enderror

        {{-- for opportunity seekers; select category to subsribed to --}}
        <div id="category" class="hidden">
          @include('partials.category')
        </div>
        {{-- end --}}

        {{-- sign up button --}}
        <div x-data="{ isLoading: false }">
          <button x-on:click="if(document.getElementById('email').value && document.getElementById('password').value) {
                isLoading = true; 
              }" :class="{ 'd-none': isLoading }" type="submit" class="flex w-full justify-center rounded-md bg-customColor px-3 py-1.5 text-lg font-semibold leading-6 text-white shadow-sm hover:bg-[#386964] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#386964]">
            Sign Up
          </button>
          <div class="flex items-center justify-center">
            <div x-show="isLoading" class="spinner-border text-customColor text-center" role="status"></div>
          </div>
        </div>
        {{-- end  --}}

      </form>
      {{-- form end --}}

      <p class="mt-5 text-center text-sm text-gray-500">
        Already have an account?
        <a href="{{route('auth.index')}}" class="font-semibold leading-6 text-customColorDark hover:text-customColor">Sign In</a>
      </p>

    </div>
  </div>
</body>
@endsection