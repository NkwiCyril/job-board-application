<body class="bg-white">
  <x-company_header></x-company_header>

  @if (session('success'))
  <div id="success-alert" class="alert alert-success" data-auto-dismiss="3000">
    <h1 class="text-gray-900 text-center">{{ session('success') }}</h1>
  </div>
  @endif


  <!-- using a component to display opportunities that have not yet been published to the company  -->
  <div class="grid grid-cols-2 sm:flex-col mt-20 mx-20 p-10">
    <x-company_opp_list :opps="$unpublished_opportunities" :publish=0 :unpublish=1></x-company_opp_list>
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