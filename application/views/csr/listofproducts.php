<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-3">
	  
          <section class="panel">
              <header class="panel-heading">
				New Product
				<span class="tools pull-right">

				</span>
			  </header>
			  <div class="panel-body">
               <div class="adv-table">
				  <table class="table">
					<tr>
					 
					</tr>
				  </table>
			  <center>
				<a href="#requestproduct" data-toggle="modal" role="button" class="btn btn-sm btn-round btn-success"><i class="fa fa-plus-circle"></i> Request Product</a>
				</center>
				</div>
				</div>
          </section>
      </div>
      <div class="col-sm-9">
          <section class="panel">
             
              <header class="panel-heading">
                  CSR Product List
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
                    <th>Item Description</th>
                    <th>Item Stocks</th>
                    <th>Action</th>
                </tr>
				</thead>
				<tbody align="center">
                <?php
                foreach($csrinventory as $item)
                {
                    echo "<tr>";
                      echo "<td>".$item['csr_id']."</td>";
                      echo "<td>".$item['item_name']."</td>";
                      echo "<td>".$item['item_desc']."</td>";
                      if($item['item_stock']!=0){
                      echo "<td>".$item['item_stock']."</td>";
                    } else {
                      echo "<td>Out of Stock</td>";
                    }
                      echo "<td>";
                        echo "<a href='".base_url()."Admin/RequestRestock/".$item['csr_id']."' role='button' class='btn btn-info btn-xs'>Request stock</a>";
                      echo"</td>";
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

    <div class="modal fade modal-dialog-center" id="requestproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">New Product Request Form</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('admin/add_newproduct', $attributes);
                      ?>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Item: </label>
                          <div class="col-lg-9">
                            <input type="text" name="itemreq" class="form-control" placeholder="Item Name">
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
                        <input type="submit" value="Submit" class="btn btn-success">
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

