<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-12">
        <header class="panel-heading" style="background-color: #000;"></header>
        <header class="panel-heading">
            <center><h4>REQUEST RESTOCK <?=$restock->csr_id?><h4></center>
        </header>
        <div class="panel-body">
            <?php
              $attributes = array('class'=>'form-horizontal', 'role'=>'form');
              echo form_open('csr/request_restock/'.$restock->csr_id, $attributes);
            ?>

            <div class="form-group">
                <label  class="col-lg-3 col-sm-3 control-label">Product Name: </label>
                <div class="col-lg-9">
                  <?php echo $restock->item_name; ?>
                  <input type="hidden" class="form-control"  name="productname"  value="<?=$restock->item_name?>">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-lg-3 col-sm-3 control-label">Quantity: </label>
                <div class="col-lg-9">
                    <select class="form-control" name="productquant">
                      <?php
                        for($i = 1; $i<=300; $i++){
                          echo "<option value=".$i.">".$i."</option>";
                        }
                      ?>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <div class="col-lg-12">
                  <center>
                    <input type="submit" value="Request Restock" class="btn btn-info">
                  </center>
                </div>
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
