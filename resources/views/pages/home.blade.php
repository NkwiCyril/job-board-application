@extends('layout.app')

@section('content')

@if (Auth::check())
  @if (Auth::user()->usertype == 'seeker' && Auth::user()->logged_in == true)
    @section('title', 'Seeka | Job Seeker')
    @include('partials.seeker_page')
    
  @elseif (Auth::user()->usertype == 'company' && Auth::user()->logged_in == true)
    @section('title', 'Seeka | Company')
    @include('partials.company_page')

  @endif
@endif

@if(!Auth::check())
  @section('title', 'Seeka | Guest')
  @include('partials.guest_page')

@endif

@endsection

