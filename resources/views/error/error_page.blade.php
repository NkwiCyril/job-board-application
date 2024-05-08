@extends('layout.app')

@section('content')

<body class="h-full">
  <main class="prose lg:prose-xl grid min-h-full place-items-center mx-auto bg-white px-6 py-24 sm:py-32 lg:px-8">
    <div class="text-center">
      <p class="text-base font-semibold text-customColorDark">404</p>
      <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Page not found</h1>
      <p class="mt-6 text-base leading-7 text-gray-600">Sorry, we couldn’t find the page you’re looking for.</p>
      <div class="mt-10 flex items-center justify-center gap-x-6">
        <a href="{{ back()->getTargetUrl() }}" class=" text-decoration-none text-slate-50 no-underline  rounded-md bg-customColor hover:bg-customColorDark hover:text-white px-4 py-3 text-base font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">Go back home</a>
      </div>
    </div>
  </main>
</body>

@endsection