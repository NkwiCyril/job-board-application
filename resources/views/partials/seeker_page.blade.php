<body class="bg-white">
  <!-- seeker header component -->
  <x-seeker_header></x-seeker_header>

  <!-- using a component to display opportunities that have not yet been published to the company  -->
  <div class="grid grid-cols-2 sm:flex-col mt-20 mx-20 p-10">
    <x-opp_list :opps="$published_opportunities" seeker=1 company=0></x-opp_list>
  </div>
  
</body>

