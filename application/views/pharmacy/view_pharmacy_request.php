<section id="main-content">
  <section class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                  <header style="font-weight:300" class="panel-heading">
      						 Request List
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
                        <th>MEDICINE</th>
                        <th>QUANTITY</th>
                        <th>PATIENT</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach($pharmacy_request as $item){
                          echo "<tr>";
                            echo "<td>".$item['phar_aud_id']."</td>";
                            echo "<td>".$item['first_name']." ".$item['middle_name']." ".$item['last_name']." "."</td>";
                            echo "<td>".$item['item_name']."</td>";
                            echo "<td>".$item['quant_requested']."</td>";
                            echo "<td>".$item['P_first_name']." ".$item['P_middle_name']." ".$item['P_last_name']." "."</td>";
                            echo "<td>";
                              if($item['phar_stat'] == 0){
                                echo "<span class='label label-info'>PENDING</span>";
                              }elseif($item['phar_stat'] == 1){
                                echo "<span class='label label-success'>APPROVED</span>";
                              }else if($item['phar_stat'] == 2){
                                echo "<span class='label label-danger'>REJECTED</span>";
                              }else if($item['phar_stat'] == 3){
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
