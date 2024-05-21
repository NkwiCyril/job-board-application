<h3 class="font-semibold text-base text-gray-900 ">Register As</h3>
<ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex white:bg-gray-700 white:border-gray-600 dark:text-white">
  <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
    <div class="flex items-center ps-3">
      <input required id="usertype" type="radio" value="company" name="usertype" class="w-4 h-4 text-customColor bg-gray-100 border-gray-300 focus:ring-customColor dark:focus:ring-customColor white:ring-offset-gray-700 white:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-300 ">
      <label for="usertype" class="w-full py-2 mt-2 ms-2 text-sm font-medium text-gray-900 dark:text-gray-900">Company</label>
    </div>
  </li>
  <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
    <div class="flex items-center ps-3">
      <input required id="usertype" type="radio" value="seeker" name="usertype" class="w-4 h-4 text-customColor bg-gray-100 border-gray-300 focus:ring-customColor dark:focus:ring-customColor white:ring-offset-gray-700 white:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-300 ">
      <label for="usertype" class="w-full py-2 mt-2 ms-2 text-sm font-medium text-gray-900 dark:text-gray-900">Opportunity Seeker</label>
    </div>
  </li>
</ul>

<script>
  document.querySelectorAll('#usertype').forEach((radio) => {
    radio.addEventListener('change', (e) => {
      if (e.target.value === 'company') {
        document.getElementById('category').classList.add('hidden');
        document.getElementById('category').attributes.required = false;
      } else {
        document.getElementById('category').classList.remove('hidden');
        document.getElementById('category').attributes.required = true;
      }
    });
  });
</script>