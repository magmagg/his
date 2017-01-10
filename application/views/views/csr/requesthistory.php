<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <center><h4><a href="<?=base_url()?>Csr/ListofProducts" role='button' class='btn btn-default btn-xs'><</a> Request History<h4></center>
      <div class="col-sm-12">
          <section class="panel">
              <header class="panel-heading" style="background-color: #000;"></header>
              <header class="panel-heading">
                  <center><h4>Accepted Requests<h4></center>
              </header>
              <table class="table table-hovered" style="text-align: center;">
                <tr id="tblheader">
                    <td>#</td>
                    <td>Requester</td>
                    <td>Item Name</td>
                    <td>Quantity</td>
                    <td>Request Type</td>
                    <td>Date Accepted</td>
                </tr>
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
              </table>
          </section>
      </div>
      <div class="col-sm-12">
          <section class="panel">
              <header class="panel-heading" style="background-color: #000;"></header>
              <header class="panel-heading">
                  <center><h4>Rejected Requests<h4></center>
              </header>
              <table class="table table-hovered" style="text-align: center;">
                <tr id="tblheader">
                    <td>#</td>
                    <td>Requester</td>
                    <td>Item Name</td>
                    <td>Quantity</td>
                    <td>Request Type</td>
                    <td>Date Rejected</td>
                </tr>
                <?php
                  foreach($rejected as $item)
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
              </table>
          </section>
      </div>
      <div class="col-sm-12">
          <section class="panel">
              <header class="panel-heading" style="background-color: #000;"></header>
              <header class="panel-heading">
                  <center><h4>On-Hold Requests<h4></center>
              </header>
              <table class="table table-hovered" style="text-align: center;">
                <tr id="tblheader">
                    <td>#</td>
                    <td>Requester</td>
                    <td>Item Name</td>
                    <td>Quantity</td>
                    <td>Request Type</td>
                    <td>Date On-Hold</td>
                </tr>
                <?php
                  foreach($hold as $item)
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
