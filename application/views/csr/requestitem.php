<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-3">
          <section class="panel">
			     <div class="panel-body">
            <div class="adv-table">
      			  <center>
      				      <a href="#requestcsritem" data-toggle="modal" role="button" class="btn btn-sm btn-round btn-success"><i class="fa fa-plus-circle"></i> Request CSR Item</a>
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

    <div class="modal fade modal-dialog-center" id="requestcsritem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content-wrap">
          <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" align="center">Request Form</h4>
            </div>

            <div class="modal-body">
              <?php
                $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                echo form_open('Csr/insert_csr_item_request', $attributes);
              ?>
              <div id="items">
                <div class="form-group">
                  <?php
                    foreach($csrinventory as $item):
                  ?>
                  <div class="col-lg-9">
                    <select class="form-control" name="item">
                      <?php
                        if($item['item_stock'] != 0){
                          echo "<option value='".$item['csr_id']."'>".$item['item_name']."</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <select class="form-control" name="quantity">
                    <?php
                      for($i=1;$i<=$item['item_stock'];$i++){
                        echo "<option value='".$i."'>".$i."</option>";
                      }
                    ?>
                    </select>
                  </div>
                  <?php
                    endforeach;
                  ?>
                </div>
                <input type="submit" class="btn btn-success" value="REQUEST">
                <?=form_close()?>
              </div>
            </div>
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
