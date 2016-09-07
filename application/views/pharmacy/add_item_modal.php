<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="addModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add Item</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-lg-7">
                  <?php echo form_open('Pharmacy/add_item_inventory'); ?>
                    <h4 style="font-weight:100" class="modal-title">Input Item Details</h4>
                    <hr>
                      <div class="form-group">
                          <label for="Name">Name</label>
                          <input type="text" class="form-control" placeholder="Name" name="name">
                      </div>
                      <div class="form-group">
                          <label for="Description">Description</label>
                          <input type="text" class="form-control" placeholder="Description" name="description">
                      </div>
                      <div class="form-group">
                          <label for="Quantity">Quantity</label>
                          <input type="text" class="form-control" placeholder="Quantity" name="quantity">
                      </div>
                      <div class="form-group">
                          <label for="Price">Price</label>
                          <input type="text" class="form-control" placeholder="Price" name="price">
                      </div>
                      <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-send"></i> Submit</button>
                  </form>
                  <br>
                </div>
                <div class="col-lg-5">

                    <h4 style="font-weight:100" class="modal-title">Import CSV</h4>
                    <hr>
                    <?php echo form_open_multipart('Admin/add_item_inventory_import');?>
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" name="userfile" onchange="ValidateSingleInput(this);">
                    </div>
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-send"></i> Submit</button>
                </form>
              </div>
              </div>
            </div>
        </div>
    </div>
</div>
