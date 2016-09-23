<section id="main-content">
  <section class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                  <header style="font-weight:300" class="panel-heading">
      						 Request List
                   <a href="<?=base_url()?>Radiology/PendingRadiologyRequests" class="btn btn-info btn-xs pull-right" role="button">Pending Requests</a>
					 <span class="tools pull-right">
					 </span>
				  </header>
				<div class="panel-body">
				<div class="adv-table">
                <table class="table table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>REQUEST ID</th>
                        <th>NAME</th>
                        <th>ITEM NAME</th>
                        <th>QUANTITY</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach($csr_request as $item){
                          echo "<tr>";
                            echo "<td>".$item['csr_req_id']."</td>";
                            echo "<td>".$item['first_name']." ".$item['middle_name']." ".$item['last_name']." "."</td>";
                            echo "<td>".$item['item_name']."</td>";
                            echo "<td>".$item['item_quant']."</td>";
                            echo "<td>";
                              if($item['csr_status'] == 0){
                                echo "<span class='label label-info'>PENDING</span>";
                              }elseif($item['csr_status'] == 1){
                                echo "<span class='label label-success'>APPROVED</span>";
                              }else if($item['csr_status'] == 2){
                                echo "<span class='label label-danger'>REJECTED</span>";
                              }else if($item['csr_status'] == 3){
                                echo "<span class='label label-warning'>RELEASED</span>";
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
