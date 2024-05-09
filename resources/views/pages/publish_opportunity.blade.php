@extends('layout.app')

@section('title', 'Seeka | Publish Opportunity')
@section('content')

<x-company_header publish=0 create=1></x-company_header>

<!-- using a component to display opportunities that have not yet been published to the company  -->
<div class="grid grid-cols-2 sm:flex-col mt-20 mx-20 p-10">
  <x-opp_list :opps="$published_opportunities" company=1 seeker=0></x-opp_list>
</div>

@endsection
