<body class="bg-white">

<x-guest_header></x-guest_header>

@if (session('success'))
<!-- Alert Banner -->
<div id="success-alert" class=" alert alert-success hs-removing:-translate-y-full bg-customColor mt-20" data-auto-dismiss="2000">
  <div class="max-w-[85rem] p-2 sm:px-6 lg:px-8 mx-auto">
    <div class="flex">
      <p class="text-white"> {{ session('success') }} </p>
    </div>
  </div>
</div>
<!-- End Alert Banner -->
@endif

<!-- introductory section into the Seeka web application -->

  <div class="relative isolate px-6 pt-14 lg:px-8">
    <div class="mx-auto max-w-2xl sm:py-48 lg:py-40">
      <div class="text-center">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Welcome to Seeka!</h1>
        <p class="mt-6 text-lg leading-8 text-gray-600">
          At Seeka, we're here to revolutionize how you find your next opportunity.
          Whether you're searching for your dream job, looking to hire top talent as a company,
          exploring internship opportunities, or voluneerism, Seeka has everything you need to succeed.
        </p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
          <a href="{{route('register.index')}}" class="rounded-md bg-customColor px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-customColorDark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 hover:no-underline focus-visible:outline-customColor">Get started</a>
        </div>
      </div>
    </div>
  </div>

  <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-3xl text-center py-2">Start applying as a guest.</h1>
  <div class="grid grid-cols-1 sm:flex-col mx-2 py-2 px-5">
    <x-guest_opp_list :opps="$published_opportunities"></x-guest_opp_list>
  </div>
</body>

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
  });
</script>