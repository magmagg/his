<section id="main-content">
    <section class="wrapper">
      <section class="panel">
          <header class="panel-heading">
              <b>Emergency Room</b>
              <span class="pull-right">
                  <a href="<?php echo base_url();?>nurse/EmergencyRoom"><button type="button" id="loading-btn" class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Refresh</button></a>
              </span>
          </header>
          <table class="table table-hover p-table">
              <thead>
              <tr>
                  <th>Bed #</th>
                  <th>Patient ID</th>
                  <th>Patient Name</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
              </thead>
              <tbody>
                <?php
                  foreach($emergency_room_data as $data){
                    echo "<tr>";
                      echo "<td class='p-name'>".$data['bed_id']."</td>";
                      echo "<td>".$data['patient_id']."</td>";
                    if($data['patient_id'] == ""){
                      echo "<td><span class='label label-success'>EMPTY</span></td>";
                      echo "<td><span class='label label-success'>AVAILABLE</span></td>";
                      echo "<td>";
                        echo "<a href='http://localhost/jnhhis/Admitting/ChoosePatient/".$data['bed_id']."' role='button' class='btn btn-info btn-xs'>ADMIT PATIENT</a>";
                      echo "</td>";
                    }else{
                      echo "<td>".$data['first_name']." ".$data['middle_name']." ".$data['last_name']."</td>";
                      echo "<td><span class='label label-danger'>EMPTY</span></td>";
                      echo "<td>";
                        echo "<a href='http://localhost/jnhhis/Admitting/DischargePatient/".$data['patient_id']."/".$data['bed_id']."' role='button' class='btn btn-default btn-xs'>DISCHARGE</a>'";
                        echo "<a href='http://localhost/jnhhis/Admitting/PatientList/".$data['patient_id']."' role='button' class='btn btn-default btn-xs'>PATIENT INFO</a>'";
                        echo "<a href='#' role='button' class='btn btn-default btn-xs'>GO TO PHARMACY</a>'";
                        echo "<a href='#' role='button' class='btn btn-default btn-xs'>TRANSFER ROOM</a>'";
                      echo "</td>";
                    }
                    echo "</tr>";
                  }
                ?>
              </tbody>
          </table>
      </section>
    </section>
</section>


<section>
<!--footer start-->
<footer class="site-footer">
    <div class="container">
      <div class="text-center">
          2013 &copy; FlatLab by VectorLab.
      </div>
    </div>
</footer>
<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="<?=base_url()?>js/jquery.js"></script>
<script src="<?=base_url()?>js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?=base_url()?>js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?=base_url()?>js/jquery.scrollTo.min.js"></script>
<script src="<?=base_url()?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/jquery.sparkline.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="<?=base_url()?>js/owl.carousel.js" ></script>
<script src="<?=base_url()?>js/jquery.customSelect.min.js" ></script>
<script src="<?=base_url()?>js/respond.min.js" ></script>

<!--right slidebar-->
<script src="<?=base_url()?>js/slidebars.min.js"></script>

<!--common script for all pages-->
<script src="<?=base_url()?>js/common-scripts.js"></script>

<!--script for this page-->
<script src="<?=base_url()?>js/sparkline-chart.js"></script>
<script src="<?=base_url()?>js/easy-pie-chart.js"></script>
<script src="<?=base_url()?>js/count.js"></script>

<!--dynamic table initialization -->
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url()?>js/dynamic_table_init.js"></script>

</body>
</html>
