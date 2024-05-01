@extends('layout.app')

@section('content')
<div class="intro prose lg:prose-xl mx-auto mt-10 p-10">
  <h1>Welcome to Seeka</h1>
  <p>At Seeka, we're here to revolutionize how you find your next opportunity.
    Whether you're searching for your dream job, looking to hire top talent as a company,
    exploring internship opportunities, or voluneerism, Seeka has everything you need to succeed.
  </p>
  <p>Start opportunity seeking in Seeka</p>
  <div class="flex gap-5 ">
    <a class="hover:prose-sky" href="{{ route('auth.login') }}">Login</a>
    <a class="hover:prose-sky" href="{{ route('auth.register') }}">Sign Up</a>
  </div>
</div>
@endsection