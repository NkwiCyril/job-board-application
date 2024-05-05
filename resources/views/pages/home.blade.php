@extends('layout.app')

@section('content')

@if (Auth::check())
  @if (Auth::user()->usertype == 'seeker' && Auth::user()->logged_in == true)

    @include('partials.seeker_page')
    
  @elseif (Auth::user()->usertype == 'company' && Auth::user()->logged_in == true)

    @include('partials.company_page')

    @endif

  @else

    @include('partials.guest_page')

@endif
@endsection

