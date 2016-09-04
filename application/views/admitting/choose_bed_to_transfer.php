<section id="main-content">
    <section class="wrapper">
      <section class="panel">
          <header class="panel-heading">
              <b>Transfer Bed</b>
              <span class="pull-right">
                  <a href="<?php echo base_url();?>Admitting/ChooseBed"><button type="button" id="loading-btn" class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Refresh</button></a>
              </span>
          </header>
          <table class="table table-hover p-table">
              <thead>
              <tr>
                <td>Bed #</td>
                <td>Patient ID</td>
                <td>Patient Checked-In</td>
                <td>Status</td>
                <td>Action</td>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($beds as $bed){
                  echo "<tr>";
                    echo "<td>".$bed['bed_id']."</td>";
                    echo "<td>".$bed['patient_id']."</td>";
                      echo "<td>EMPTY</td>";
                      echo "<td>AVAILABLE</td>";
                      echo "<td>";
                        echo "<a href='".base_url()."Admitting/TransferPatient/".$patientid."/".$bed['bed_id']."/".$roomid."' role='button' class='btn btn-info btn-xs'>TRANSFER</a>'";
                      echo "</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
          </table>
      </section>
    </section>
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
