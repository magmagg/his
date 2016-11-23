<section id="main-content">
    <section class="wrapper">
      <div class="col-sm-12">
        <section class="panel">
          <header style="font-weight:300" class="panel-heading">
             Radiology Exam List
          <span class="tools pull-right">
          </span>
          </header>

        <div class="panel-body">
          <div class="adv-table">
            <table class="table table-striped" style="text-align: center;" id="dynamic-table">
              <thead>
                <tr id="tblheader">
                  <td>ID</td>
                  <td>Name</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($patients as $patient){
                    echo "<tr>";
                      echo "<td>".$patient['patient_id']."</td>";
                      echo "<td>".$patient['first_name']." ".$patient['last_name']." ".$patient['middle_name']."</td>";
                      echo "<td><a href='".base_url()."Billing/PatientBilling/".$patient['patient_id']."' role='button' class='btn btn-success btn-xs'>View</a>'</td>";
                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        </section>
      </div>
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
