<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-12">
          <section class="panel">
             
              <header class="panel-heading">
                  <a href="<?=base_url()?>Admin/AppofReq" role='button' class='btn btn-primary btn-xs'><i class="fa fa-chevron-left"></i></a> Rejeceted laboratory Requests
              </header>
			  <div class="panel-body">
                <div class="adv-table">

              <table class="table table-striped" id="dynamic-table">
			  <thead>
                <tr id="tblheader">
                    <th>Request #</th>
                    <th>Date Added</th>
                    <th>Check-In #</th>
                    <th>Patient</th>
                    <th>Action</th>
                </tr>
				</thead>
				<tbody>
                <?php
                foreach($rejectedreq as $req)
                {
                  echo "<tr>";
                  echo "<td>".$req['lab_id']."</td>";
                  echo "<td>".$req['lab_date_req']."</td>";
                  echo "<td>".$req['lab_patient_checkin']."</td>";
                  echo "<td>".$req['first_name']." ".$req['middle_name']." ".$req['last_name']."</td>";
                  echo "<td>";
                    echo "<a href='".base_url()."Admin/ShowLabReq/".$req['lab_id']."' role='button' class='btn btn-info btn-xs'>View</a>";
                  echo"</td>";
                  echo "</tr>";
                }

                ?>
				</tbody>
              </table>
          </section>
      </div>
    </div>
  </section>
</section>

<!-- js placed at the end of the document so the pages load faster -->

<script src="<?=base_url()?>js/jquery.js"></script>
<script src="<?=base_url()?>js/bootstrap.min.js"></script>

<script class="include" type="text/javascript" src="<?=base_url()?>js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?=base_url()?>js/jquery.scrollTo.min.js"></script>
<script src="<?=base_url()?>js/jquery.nicescroll.js" type="text/javascript"></script>

<!--right slidebar-->
<script src="<?=base_url()?>js/slidebars.min.js"></script>
<!--common script for all pages-->
<script src="<?=base_url()?>js/common-scripts.js"></script>


<!--dynamic table initialization -->
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url()?>js/dynamic_table_init.js"></script>
