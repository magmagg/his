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
              echo form_open('admin/request_restock/'.$restock->csr_id, $attributes);
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
