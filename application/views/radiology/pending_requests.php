<section id="main-content">
  <section class="wrapper">
    <div class="row">
        <div class="col-sm-3">
            <section class="panel">

      				<header style="font-weight:300" class="panel-heading">
      					 New Patient

      				</header>
      				<div class="panel-body">
      				<div class="adv-table">
                <table class="table">
                    <tr>
                    </tr>
                    <tr>
                      <td>Total Radiology Requests: </td>
                      <td><?=$total_radiology_request?></td>
                    </tr>
                    <tr>
                      <td>Pending Radiology Requests: </td>
                      <td><?=$total_pending_request?></td>
                    </tr>
                </table>
				</div>
				</div>
            </section>
        </div>
        <div class="col-sm-9">
            <section class="panel">
                  <header style="font-weight:300" class="panel-heading">
						 Patient List
					 <span class="tools pull-right">
					 </span>
				  </header>
				<div class="panel-body">
				<div class="adv-table">
                <table class="table table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>REQUEST ID</th>
                        <th>PATIENT NAME</th>
                        <th>DATE REQUESTED</th>
                        <th>REQUESTOR'S NAME</th>
                        <th>NOTE</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach($radiology_requests as $radiology_request){
                          echo "<tr>";
                            echo "<td>".$radiology_request['request_id']."</td>";
                            echo "<td>".$radiology_request['P_first_name']." ".$radiology_request['P_middle_name']." ".$radiology_request['P_last_name']."</td>";
                            echo "<td>".$radiology_request['request_date']."</td>";
                            echo "<td>".$radiology_request['first_name']." ".$radiology_request['middle_name']." ".$radiology_request['last_name']."</td>";
                            echo "<td>".$radiology_request['req_notes']."</td>";
                            echo "<td>";
                              echo "<a href='".base_url()."Radiology/approve_request/".$radiology_request['trans_id']."' role='button' class='btn btn-info btn-xs'>APPROVE</a>";
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
