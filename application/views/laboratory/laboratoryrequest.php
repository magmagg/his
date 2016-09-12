<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-3">
          <section class="panel">
             <header style="font-weight:300" class="panel-heading">
                 Laboratory Request
             <span class="tools pull-right">

             </span>
            </header>
			<div class="panel-body">
               <div class="adv-table">
              <table class="table">
                <tr>
                  
                </tr>
              </table>
			  <center>
				<a href="<?=base_url()?>Admin/MakeLaboratoryRequests" data-toggle="modal" role="button" class="btn btn-sm btn-round btn-success"><i class="fa fa-plus-circle"></i> New Request</a>
				</center>
				</div>
				</div>
          </section>
      </div>
      <div class="col-sm-9">
          <section class="panel">
            
              <header class="panel-heading">
                  Laboratory Requests
			 <span class="tools pull-right">
             </span>
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
                    <th>Status</th>
                    <th>Action</th>
                </tr>
				</thead>
				<tbody>
              <?php
              foreach($laboratoryreq as $labreq){
                echo "<tr>";
                echo"<td>".$labreq['lab_id']."</td>";
                echo"<td>".$labreq['lab_date_req']."</td>";
                echo"<td>".$labreq['lab_patient_checkin']."</td>";
                echo"<td>".$labreq['first_name']." ".$labreq['last_name']."</td>";
                if($labreq['lab_status']==1){
                echo "<td>For Approval</td>";
              } elseif ($labreq['lab_status']==2) {
                echo "<td>Approved</td>";
              } else {
                echo "<td>Cancelled</td>";
              }
                echo "<td>";
                  echo "<a href='".base_url()."Admin/ShowLabReq/".$labreq['lab_id']."' role='button' class='btn btn-info btn-xs'>View</a>";
                echo "</td>";
                echo "</tr>";
              }

              ?>
			  </tbody>
              </table>
			  </div>
			  </div>
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

