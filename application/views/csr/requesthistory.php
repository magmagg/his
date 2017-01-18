<section id="main-content">
  <section class="wrapper">
    <div class="col-sm-12">
          <section class="panel">
              <header class="panel-heading">
                  CSR Product Request History
				  <span class="tools pull-right">
				  </span>
              </header>
			  <div class="panel-body">
              <div class="adv-table">

              <table id="dynamic-table" class="table table-striped" style="text-align: center;">
			    <thead>
                <tr id="tblheader">
                    <th>#</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Date Requested</th>
                    <th>Status</th>
                </tr>
				</thead>
				<tbody align="center">
                <?php
                foreach($requests as $request)
                {
                    echo "<tr>";
                      echo "<td>".$request['purchase_id']."</td>";
                      echo "<td>".$request['item_name']."</td>";
                      echo "<td>".$request['quantity']."</td>";
                      echo "<td>".date('M d, Y', strtotime($request['date_created']))."</td>";
                      echo "<td>";
                      if($request['pur_stat'] == 0){
                        echo "<span class='label label-default'>Pending</span>";
                      }else if($request['pur_stat'] == 1){
                          echo "<span class='label label-success'>Accepted</span>";
                      }else if($request['pur_stat'] == 2){
                          echo "<span class='label label-danger'>Rejected</span>";
                      }else if($request['pur_stat'] == 3){
                          echo "<span class='label label-info'>On Hold</span>";
                      }
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
