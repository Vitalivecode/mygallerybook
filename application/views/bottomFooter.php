</section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="<?php echo base_url(); ?>assets/lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/jquery.scrollTo.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/lib/jquery.sparkline.js"></script>
  
  <!--common script for all pages-->
  <script src="<?php echo base_url(); ?>assets/lib/common-scripts.js"></script>
  
  <!--Table Related Script-->
  <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/lib/advanced-datatable/js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/lib/advanced-datatable/js/DT_bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>assets/datatables.min.js"></script>
  
  <script type="text/javascript">
  $(document).ready(function (){
      var table = $('#hidden-table-info').DataTable({
          'responsive': true
      });
  });
  </script>

</body>

</html>
