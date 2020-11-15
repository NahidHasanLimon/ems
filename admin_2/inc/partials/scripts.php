 
<!--  <?php 
      $baseUrl="http://localhost/ems/";
        // $baseUrl="https://7teen.com.bd/ems/";
      // echo $baseUrl;
       ?>
 -->
<!-- Bootstrap core JavaScript-->
  <script src="<?php echo $baseUrl.'admin/vendor/jquery/jquery.min.js';?>"></script>
  <script src="<?php echo $baseUrl.'admin/vendor/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo $baseUrl.'admin/vendor/jquery-easing/jquery.easing.min.js'; ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo $baseUrl.'admin/js/sb-admin-2.min.js'; ?>"></script>
<?php 
if ($pageSlug=="index"|| $pageSlug=="add-employee") {
?>
 <!-- Page level plugins -->
  <script src="<?php echo $baseUrl.'admin/vendor/chart.js/Chart.min.js'; ?>"></script>
    <!-- Page level custom scripts -->
  <script src="<?php echo $baseUrl.'admin/js/demo/chart-area-demo.js'; ?>"></script>
  <script src="<?php echo $baseUrl.'admin/js/demo/chart-pie-demo.js'; ?>"></script>
 
<?php } ?>


<!-- DatePicker -->

<!-- For Date Picker -->
    <script src="http://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<!-- For Date Picker -->

<!-- DataTable -->
 <script src="<?php echo $baseUrl.'admin/vendor/datatables/jquery.dataTables.min.js'; ?>"></script>
 <script src="<?php echo $baseUrl.'admin/vendor/datatables/dataTables.bootstrap4.min.js'; ?>"></script>
 

<!-- DataTable -->
<!-- Timepicke -->
// <!-- <script src="<?php echo $baseUrl.'admin/js/timepicki.js'; ?>"></script> -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<!-- sweet Alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




<!-- bootstrap Print -->
<!-- <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script> -->
 <script src="<?php echo $baseUrl.'admin/js/demo/datatables-demo.js'; ?>"></script>

