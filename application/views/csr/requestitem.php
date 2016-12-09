<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-12">
          <section class="panel">

              <header class="panel-heading">
                   Patient List
				  <span class="tools pull-right">
				  </span>
              </header>
			  <div class="panel-body">
              <div class="adv-table">

              <table id="dynamic-table" class="table table-striped" style="text-align: center;">
			    <thead>
                <tr id="tblheader">
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
				</thead>
				<tbody align="center">
                <?php
                foreach($patients as $patient){
                  echo "<tr>";
                    echo "<td>".$patient['patient_id']."</td>";
                    echo "<td>".$patient['first_name']." ".$patient['middle_name']." ".$patient['last_name']."</td>";
                    echo "<td><a data-id='".$patient['patient_id']."' role='button' class='btn btn-success btn-xs' onclick='requestitem(this)' >Request Item</td>";
                  echo "</tr>";
                }
                /*foreach($csrinventory as $item)
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
                }*/
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
              <input type="hidden" id="patient_id" name="patient_id">
              <div id="items">
                <div class="form-group">
                  <div class="col-lg-9">
                    <select class="form-control" name="item">
                      <?php
                        foreach($csrinventory as $item){
                          echo "<option value='".$item['csr_id']."' data-foo='".$item['item_stock']."'>".$item['item_name']."</option>";
                        }
                      ?>
                    </select>
                  </div>

                  <div class="col-lg-3">
                    <div id="select_quantity">
                      <select class="form-control" name="quantity">
                        <?php
                           for($i = 20; $i > 0; $i--){
                             echo "<option value='".$i."'>".$i."</option>";
                           }
                         ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <input type="submit" class="btn btn-success" value="REQUEST">
              </div>
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

<script>
  function requestitem(d){
    document.getElementById("patient_id").value = d.getAttribute("data-id");
    $("#requestcsritem").modal();
  }
</script>

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
