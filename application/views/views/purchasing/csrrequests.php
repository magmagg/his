<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-3">
        <section class="panel">
  			  <div class="panel-body">
    				<center>
      				<a href="<?=base_url()?>Purchasing/PendingCSR" data-toggle="modal" role="button" class="btn btn-sm btn-round btn-success"><i class="fa fa-eye"></i> Pending Requests</a><br><br>
      				<a href="<?=base_url()?>Purchasing/OPCSR" data-toggle="modal" role="button" class="btn btn-sm btn-round btn-info"><i class="fa fa-eye"></i> On Process Requests</a>
    				</center>
  				</div>
        </section>
      </div>

      <div class="col-sm-9">
        <section class="panel">
          <header class="panel-heading">
            <b>All CSR request</b><span class="tools pull-right"></span>
          </header>
  			  <div class="panel-body">
            <div class="adv-table">
              <table class="table table-striped" id="dynamic-table">
    			      <thead>
                  <tr id="tblheader">
                    <th>Request ID</th>
                    <th>Requested By</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Date Requested</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th style="text-align:center;">Action</th>
                  </tr>
        				</thead>
      				  <tbody>
                  <?php
                    foreach($csrrequests as $item){
                      echo "<tr>";
                      echo "<td>".$item['purchase_id']."</td>";
                      echo "<td>".$item['first_name']." ".$item['middle_name']." ".$item['last_name']."</td>";
                      echo "<td>".$item['item_name']."</td>";
                      echo "<td>".$item['quantity']."</td>";
                      echo "<td>".$item['date_created']."</td>";
                      echo "<td>".$item['pur_name']."</td>";
                      if($item['pur_stat'] == 0){
                        echo "<td><span class='label label-default'>PENDING</span></td>";
                        echo "<td>";
                          echo "<a href='".base_url()."Purchasing/accept_csr/".$item['purchase_id']."' role='button' class='label label-success btn-xs'>Add to Inventory</a> ";
                          echo "<a href='".base_url()."Purchasing/reject_csr/".$item['purchase_id']."' role='button' class='label label-danger btn-xs'>Reject</a> ";
                          echo "<a href='".base_url()."Purchasing/hold_csr/".$item['purchase_id']."' role='button' class='label label-info btn-xs'>On Process</a>";
                        echo "</td>";
                      }else if($item['pur_stat'] == 1){
                        echo "<td><span class='label label-success'>ADDED TO INVENTORY</span></td>";
                        echo "<td></td>";
                      }else if($item['pur_stat'] == 2){
                        echo "<td><span class='label label-danger'>REJECTED</span></td>";
                        echo "<td></td>";
                      }else if($item['pur_stat'] == 3){
                        echo "<td><span class='label label-info'>ON PROCESS</span></td>";
                        echo "<td>";
                          echo "<a href='".base_url()."Purchasing/accept_csr/".$item['purchase_id']."' role='button' class='label label-success btn-xs'>Add to Inventory</a> ";
                        echo "</td>";
                      }
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
