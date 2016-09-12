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
			  <a href="#" data-toggle="modal" role="button" class="btn btn-sm btn-round btn-success"><i class="fa fa-eye"></i> Accepted Requests</a><br><br>
			  <a href="#" data-toggle="modal" role="button" class="btn btn-sm btn-round btn-danger"><i class="fa fa-eye"></i> Rejected Requests</a>
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
                <tr>
                  <td>1</td>
                  <td>Sharon Cuneta</td>
                  <td>Cotton</td>
                  <td>6</td>
                  <td>For Approval</td>
                  <td>View Request/Accept/Reject/Hold</td>
                </tr>
				</tbody>
                <?php
                foreach($nursetocsr as $request)
                {
                  echo "<tr>";
                    echo "<td>".$request['csr_req_id']."</td>";
                    echo "<td>".$request['nurse_id']."</td>";
                    echo "<td>".$request['csr_item_id']."</td>";
                    echo "<td>".$request['item_quant']."</td>";
                    if($request['csr_status']==0){
                    echo "<td>For Approval</td>";
                  } elseif($request['csr_status']==2){
                    echo "<td>On Hold</td>";
                  }
                    echo "<td>";
                      echo " <a href='".base_url()."Admin/csr_accept_request/".$item['csr_id']."' role='button' class='btn btn-default btn-xs'>Accept Request</a>";
                      echo " <a href='".base_url()."Admin/csr_reject_request/".$item['csr_id']."' role='button' class='btn btn-default btn-xs'>Reject Request</a>";
                      echo " <a href='".base_url()."Admin/csr_hold_request/".$item['csr_id']."' role='button' class='btn btn-default btn-xs'>Hold Request</a>";
                    echo "</td>";
                  echo "</tr>";
                }
                ?>
              </table>
			  </div>
				</div>
          </section>
      </div>
    </div>

    <div class="modal fade modal-dialog-center" id="requestproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">Request a Product</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('admin/insert_room', $attributes);
                      ?>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Item: </label>
                          <div class="col-lg-9">
                              <select class="form-control" name="itemreq">
                                <option value="1">Cotton</option>
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Quantity: </label>
                          <div class="col-lg-9">
                              <select class="form-control" name="itemquant">
                                <?php
                                  for($i = 1; $i<=300; $i++){
                                    echo "<option value=".$i.">".$i."</option>";
                                  }
                                ?>
                              </select>
                          </div>
                      </div>

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <input type="submit" value="Submit" class="btn btn-warning">
                    </div>
                    <?=form_close()?>
                </div>
            </div>
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

