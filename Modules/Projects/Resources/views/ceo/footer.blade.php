<footer class="footer">
          
      
  
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <!--<script src="{{ asset('vendors/progressbar.js/progressbar.min.js') }}"></script>-->

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('js/dashboard.js') }}"></script>
  <script src="{{ asset('js/Chart.roundedBarCharts.js') }}"></script>



  <!-- <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script> -->
  
  <script>
    $(document).ready(function() {
      $('#projects_table').DataTable();
    });
    $(document).ready(function() {
      $('#example').DataTable();
    });
</script>
</body>
</html>

</footer>