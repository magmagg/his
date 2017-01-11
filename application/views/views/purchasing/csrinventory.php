<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-3">
        <section class="panel">
          <div class="panel-body">
            <center>
              <a href="#requestproduct" data-toggle="modal" role="button" class="btn btn-sm btn-round btn-success"><i class="fa fa-plus-circle"></i> Add new product</a>
            </center>
          </div>
        </section>
      </div>

      <div class="col-sm-9">
          <section class="panel">
              <section class="panel">
            <div class="panel-body">
                  <div class="adv-table">
            <center>
            <h1>CSR INVENTORY</h1>
            </center>
            </div>
            </div>
              </section>

			  <div class="panel-body">
               <div class="adv-table">
              <table class="table table-striped" id="dynamic-table">
			    <thead>
                <tr>
                    <th>#</td>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Stocks</th>
                    <th>Action</th>
                </tr>
				</thead>
				<tbody>
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
                      echo "<td><a href='#addstock' data-toggle='modal' data-id='".$item['csr_id']."' data-quantity='".$item['item_stock']."' data-name='".$item['item_name']."' role='button' class='btn btn-sm btn-round btn-success'><i class='fa fa-plus-circle'></i> Add stock</a></td>";

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

    <div class="modal fade modal-dialog-center" id="addstock" tabindex="-1" role="dialog" aria-labelledby="addstock" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">New Product Form</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('Purchasing/update_csr_stock', $attributes);
                      ?>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Item: </label>
                          <div class="col-lg-9">
                            <input type="hidden" name="item_id" id="item_id" class="form-control">
                            <input type="hidden" name="item_stock" id="item_stock" class="form-control">
                            <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Item Name" disabled>
                          </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-lg-3 col-sm-3 control-label">Quantity: </label>
                        <div class="col-lg-9">
                            <select class="form-control" name="item_quant">
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


    <div class="modal fade modal-dialog-center" id="requestproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">New Product Form</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('Purchasing/add_newproduct', $attributes);
                      ?>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Item: </label>
                          <div class="col-lg-9">
                            <input type="text" name="item_name" class="form-control" placeholder="Item Name">
                          </div>
                      </div>

                       <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Description: </label>
                          <div class="col-lg-9">
                            <input type="text" name="item_desc" class="form-control" placeholder="Item Description">
                          </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-lg-3 col-sm-3 control-label">Quantity: </label>
                        <div class="col-lg-9">
                            <select class="form-control" name="item_quant">
                              <?php
                                for($i = 1; $i<=300; $i++){
                                  echo "<option value=".$i.">".$i."</option>";
                                }
                              ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-lg-3 col-sm-3 control-label">Price: </label>
                      <div class="col-lg-9">
                        <input type="text" name="item_price" step="0.01" class="form-control" placeholder="Item Price">
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

<script>
  $('#addstock').on('show.bs.modal', function(e)
  {
    //get data-id attribute of the clicked element
    var id = $(e.relatedTarget).data('id');
    var name = $(e.relatedTarget).data('name');
    var name = $(e.relatedTarget).data('name');
    var quantity = $(e.relatedTarget).data('quantity');

    //populate the textbox
    $(e.currentTarget).find('input[id="item_id"]').val(id);
    $(e.currentTarget).find('input[id="item_name"]').val(name);
    $(e.currentTarget).find('input[id="item_stock"]').val(quantity);
  });
</script>

<!--dynamic table initialization -->
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url()?>js/dynamic_table_init.js"></script>
