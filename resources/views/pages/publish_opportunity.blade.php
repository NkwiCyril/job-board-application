@extends('layout.app')

@section('title', 'Seeka | Publish Opportunity')
@section('content')

<x-company_header></x-company_header>

<!-- using a component to display opportunities that have not yet been published to the company  -->
<div class="grid grid-cols-2 sm:flex-col mt-20 mx-20 p-10">
  <x-company_opp_list :opps="$published_opportunities" :publish=1 :unpublish=0></x-company_opp_list>
</div>

@endsection
