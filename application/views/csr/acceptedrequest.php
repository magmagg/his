<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-3">
          <section class="panel">

            <div class="panel-body">
            <div class="adv-table">
                <table class="table">
                  <tr>

                  </tr>
              </table>
        <center>
        <a href="<?=base_url()?>CSR/PendingRequests" data-toggle="modal" role="button" class="btn btn-sm btn-round btn-info"><i class="fa fa-eye"></i> Pending Requests</a><br><br>
        <a href="<?=base_url()?>CSR/RejectedRequests" data-toggle="modal" role="button" class="btn btn-sm btn-round btn-danger"><i class="fa fa-eye"></i> Rejected Requests</a>
        </center>
        </div>
        </div>
     </section>
      </div>
      <div class="col-sm-9">
          <section class="panel">

              <header class="panel-heading">
               Pending Requests
              </header>
        <div class="panel-body">
                <div class="adv-table">
              <table class="table table-striped" id="dynamic-table">
        <thead>
                <tr id="tblheader">
                    <th>#</th>
                    <th>Requested By</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
        </thead>
        <tbody>
          <?php
            foreach($accepted_requests as $request)
            {
              echo "<tr>";
                echo "<td>".$request['csr_req_id']."</td>";
                echo "<td>".$request['first_name']." ".$request['middle_name']." ".$request['last_name']."</td>";
                echo "<td>".$request['item_name']."</td>";
                echo "<td>".$request['item_quant']."</td>";
                echo "<td><span class='label label-success'>APPROVED FOR RELEASING</span></td>";
                echo "<td><a href='".base_url()."Csr/release_csr_item/".$request['csr_req_id']."' role='button' class='btn btn-info btn-xs'>RELEASED</a></td>";
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
