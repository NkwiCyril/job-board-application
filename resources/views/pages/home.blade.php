@extends('layout.app')

@section('content')

@if (auth()->check())
  @if (auth()->user()->usertype == 'seeker' && auth()->user()->logged_in == true)
    @section('title', 'Seeka | Job Seeker')
    @include('partials.seeker_page')
    
  @elseif (auth()->user()->usertype == 'company' && auth()->user()->logged_in == true)
    @section('title', 'Seeka | Company')
    @include('partials.company_page')

  @endif
@endif

@if(!auth()->check())
  @section('title', 'Seeka | Guest')
  @include('partials.guest_page')

@endif

@endsection

