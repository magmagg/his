<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-3">
          <section class="panel">
            <div class="panel-body">
            <center style="padding: 20px;" >
              <a class="btn btn-round btn-sm btn-success" data-toggle="modal" href="#addnewoperation"><i class="fa fa-plus-circle"></i> Add New Operation</a>
            </center>
            </div>
          </section>
        </div>
        <div class="col-sm-9">

        <section class="panel">
				<header style="font-weight:300" class="panel-heading">
					 Operations List
				 <span class="tools pull-right">
				 </span>
				</header>

				<div class="panel-body">
				<div class="adv-table">
                <table class="table table-striped" style="text-align: center;" id="dynamic-table">
				<thead>
                  <tr id="tblheader">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
				  </thead>
				  <tbody>
                  <?php
                    foreach($operations as $operation){
                      echo "<tr>";
                        echo "<td>".$operation['operation_id']."</td>";
                        echo "<td>".$operation['operation_name']."</td>";
                        echo "<td>".$operation['price']."</td>";
                        if($operation['status'] == 0){
                          echo "<td>NOT AVAILABLE</td>";
                          echo "
                            <td>
                              <a href='".base_url()."Operations/change_operation_status/1/".$operation['operation_id']."' role='button' class='btn btn-success btn-sm'>CHANGE TO AVAILABLE</a>
                              <a href='#' role='button' class='btn btn-warning btn-sm'>Update</a>
                            </td>";
                        }else{
                          echo "<td>AVAILABLE</td>";
                          echo "<td>
                          <a href='".base_url()."Operations/change_operation_status/0/".$operation['operation_id']."' role='button' class='btn btn-danger btn-sm'>CHANGE TO NOT AVAILABLE</a>
                          <a data-operationid='".$operation['operation_id']."' data-operationname='".$operation['operation_name']."' data-operationprice='".$operation['price']."' onclick='updateoperation(this)' role='button' class='btn btn-warning btn-sm'>Update</a>
                          </td>";
                        }
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


    <div class="modal fade modal-dialog-center" id="addnewoperation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">New Operation</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('operations/insert_operation', $attributes);
                      ?>

                      <div class="form-group">
                         <label  class="col-lg-3 col-sm-3 control-label">Operation Name </label>
                         <div class="col-lg-9" id="name">
                             <input type="text" name="name" class="form-control" placeholder="Operation Name">
                         </div>
                     </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Price: </label>
                          <div class="col-lg-9">
                              <input type="number" step="0.01" name="price" class="form-control" placeholder="Price">
                          </div>
                      </div>

                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <input type="submit" value="Submit" class="btn btn-success">
                    </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="modal fade modal-dialog-center" id="updateoperation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content-wrap">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" align="center">Update Operation</h4>
                  </div>
                  <div class="modal-body">
                    <?php
                      $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                      echo form_open('operations/update_operation', $attributes);
                    ?>

                    <input type="hidden" id="updateid" name="updateid">

                    <div class="form-group">
                       <label  class="col-lg-3 col-sm-3 control-label">Operation Name </label>
                       <div class="col-lg-9" id="name">
                           <input type="text" id="updatename" name="updatename" class="form-control" placeholder="Operation Name">
                           <input type="hidden" id="originalname" name="originalname" class="form-control" placeholder="Operation Name">
                       </div>
                   </div>

                    <div class="form-group">
                        <label  class="col-lg-3 col-sm-3 control-label">Price: </label>
                        <div class="col-lg-9">
                            <input type="number" step="0.01" id="updateprice" name="updateprice" class="form-control" placeholder="Price">
                        </div>
                    </div>

                  <div class="modal-footer">
                      <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                      <input type="submit" value="Submit" class="btn btn-success">
                  </div>
                  <?=form_close()?>
              </div>
          </div>
      </div>
  </div>
</div>



  </section>
</section>

<script>
  function updateoperation(d){
      document.getElementById("originalname").value = d.getAttribute("data-operationname");
      document.getElementById("updateid").value = d.getAttribute("data-operationid");
      document.getElementById("updatename").value = d.getAttribute("data-operationname");
      document.getElementById("updateprice").value = d.getAttribute("data-operationprice");
      $("#updateoperation").modal()
  }
</script>

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
</body>

<!-- Mirrored from thevectorlab.net/flatlab/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 May 2016 02:05:28 GMT -->
</html>
