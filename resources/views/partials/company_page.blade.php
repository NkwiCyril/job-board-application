<body class="bg-white">

<x-company_header></x-company_header>

@if (session('success'))
<!-- Alert Banner -->
<div id="success-alert" class=" alert alert-success hs-removing:-translate-y-full bg-customColor mt-20" data-auto-dismiss="4000">
  <div class="max-w-[85rem] p-2 sm:px-6 lg:px-8 mx-auto">
    <div class="flex items-center justify-center">
      <p class="text-white> {{ session('success') }} </p>
    </div>
  </div>
</div>
<!-- End Alert Banner -->
@endif


  <!-- using a component to display opportunities that have not yet been published to the company  -->
  <div class="grid grid-cols-1 sm:flex-col mt-20 mx-20 p-10">
    <x-company_opp_list :opps="$unpublished_opportunities" :publish=0 :unpublish=1></x-company_opp_list>
  </div>

</body>

<script>
  // Auto-dismiss flash messages after a specified duration
  document.addEventListener('DOMContentLoaded', function() {
    const alert = document.getElementById('success-alert');
    if (alert) {
      const duration = parseInt(alert.getAttribute('data-auto-dismiss'));
      
      // Fade in the alert
      alert.style.opacity = '0';
      alert.style.transition = 'opacity 0.3s ease';
      setTimeout(function() {
        alert.style.opacity = '1';
      }, 100);

      // Fade out and remove the alert after the specified duration
      setTimeout(function() {
        alert.style.opacity = '0';
        setTimeout(function() {
          alert.remove();
        }, 300); // Wait for the transition to complete before removing
      }, duration);
    }
  });
</script>
