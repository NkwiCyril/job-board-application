<body class="bg-white">
  <x-company_header></x-company_header>



  <!-- using a component to display opportunities that have not yet been published to the company  -->
  <div class="grid grid-cols-2 sm:flex-col mt-20 mx-20 p-10">
    <x-company_opp_list :opps="$unpublished_opportunities" :publish=0 :unpublish=1></x-company_opp_list>
  </div>

</body>


