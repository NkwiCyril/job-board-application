<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Opportunity</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Golos+Text:wght@400..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Press+Start+2P&display=swap" rel="stylesheet">
</head>

<style>

  * {
    font-family: 'Figtree', sans-serif;
  }

  /* Header */
  header {
    text-align: center;
  }

  header img {
    width: auto;
    height: 7rem;
    /* Adjust height as needed */
  }

  /* Main Content */
  main {
    margin-top: 2rem;
  }

  h2 {
    color: #4a5568;
    /* Text color */
  }

  p {
    margin-top: 0.5rem;
    line-height: 1.5;
  }

  .font-semibold {
    font-weight: 600;
  }

  button {
    padding: 0.5rem 1.5rem;
    margin-top: 1rem;
    font-size: 0.875rem;
    /* 14px */
    font-weight: 500;
    text-transform: capitalize;
    color: #ffffff;
    background-color: #2563eb;
    /* Button background color */
    border: none;
    border-radius: 0.375rem;
    /* 6px */
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  button:hover {
    background-color: #3b82f6;
    /* Hover state button background color */
  }

  button:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.5);
    /* Focus ring color */
  }

  /* Footer */
  footer {
    margin-top: 2rem;
    text-align: center;
  }

  a {
    color: #3b82f6;
    /* Link color */
    text-decoration: none;
  }

  a:hover {
    text-decoration: underline;
  }

  /* Dark Mode Styles */
  .dark {
    background-color: #1a202c;
    /* Dark mode background color */
  }

  .dark h2,
  .dark p,
  .dark a,
  .dark button {
    color: #d1d5db;
    /* Dark mode text color */
  }

  .dark button {
    background-color: #4ba198;
    /* Dark mode button background color */
  }

  .dark button:hover {
    background-color: #2a645e;
    /* Dark mode button hover state background color */
  }

  .dark a:hover {
    text-decoration-color: #d1d5db;
    /* Dark mode link hover state color */
  }

  b {
    text-transform: uppercase;
  }

</style>

<body>
  <section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
    <header>
      <a href="#">
        <img class="w-auto h-7 sm:h-8" src="{{asset('seeka_logo.png')}}" alt="seeka logo">
      </a>
    </header>

    <main class="mt-8">
      <h2 class="text-gray-700 dark:text-gray-200">Hello, {{$mailData['seeker']->name}}</h2>

      <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
        {{$mailData['opportunity']->user->name}} has published a new opportunity on the role <span class="font-semibold ">{{$mailData['opportunity']->title}}</span> under the <b>{{$mailData['opportunity']->category->category_name}}</b> category.
      </p>

      <a href="http://127.0.0.1:8000">
        <button class="px-6 py-2 mt-4 text-sm font-medium tracking-wider text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
          View Opportunity
        </button>
      </a>


      <p class="mt-8 text-gray-600 dark:text-gray-300">
        Thanks, <br>
        Seeka team
      </p>
    </main>


    <footer class="mt-8">
      <p class="text-gray-500 dark:text-gray-400">
        This email was sent from <a href="http://127.0.0.1:8000" class="text-blue-600 hover:underline dark:text-blue-400" target="_blank">Seeka</a>.
      </p>
      <p class="text-gray-500 dark:text-gray-400">
        You are receiving this email because you subscribed for this category of opportunities. 
      </p>

      <p class="mt-3 text-gray-500 dark:text-gray-400">©
        Seeka. All Rights Reserved.
      </p>
    </footer>
  </section>
</body>

</html>