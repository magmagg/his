<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-12">

          <section class="panel">

              <header class="panel-heading">
                 <a href="<?=base_url()?>Purchasing/CSRRequests" role='button' class='btn btn-primary btn-xs'><i class="fa fa-chevron-left"></i></a> Accepted CSR Requests
              </header>

			  <div class="panel-body">
              <div class="adv-table">
              <table class="table table-striped" id="dynamic-table">
				<thead>
                <tr>
                  <th style="text-align: center;">#</th>
                  <th style="text-align: center;">Requested By</th>
                  <th style="text-align: center;">Item Name</th>
                  <th style="text-align: center;">Quantity</th>
                  <th style="text-align: center;">Request Type</th>
                  <th style="text-align: center;">Date Accepted</th>
                </tr>
				</thead>
				<tbody>
                <?php
                foreach($accepted as $item)
                {
                      echo "<tr>";
                      echo "<td>".$item['purchase_id']."</td>";
                      echo "<td>".$item['first_name']." ".$item['middle_name']." ".$item['last_name']."</td>";
                      echo "<td>".$item['item_name']."</td>";
                      echo "<td>".$item['quantity']."</td>";
                      echo "<td>".$item['pur_name']."</td>";
                      echo "<td>".$item['date_altered_status']."</td>";
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
