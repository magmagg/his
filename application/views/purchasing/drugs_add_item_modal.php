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
                  <?php echo form_open('Purchasing/add_drug_inventory'); ?>
                    <h4 style="font-weight:100" class="modal-title">Input Item Details</h4>
                    <hr>
                    <div class="form-group">
                        <label for="Name">Drug code</label>
                        <input type="text" class="form-control" placeholder="Drug code" name="drug_code">
                    </div>

                      <div class="form-group">
                          <label for="Name">Drug Name</label>
                          <input type="text" class="form-control" placeholder="Drug Name" name="drug_name">
                      </div>

                      <div class="form-group">
                          <label for="Name">Generic code</label>
                          <input type="text" class="form-control" placeholder="Generic code" name="generic_code">
                      </div>

                      <div class="form-group">
                          <label for="Name">Generic Name</label>
                          <input type="text" class="form-control" placeholder="Generic Name" name="generic_name">
                      </div>

                      <div class="form-group">
                          <label for="Name">Strength Code</label>
                          <input type="text" class="form-control" placeholder="Strength code" name="strength_code">
                      </div>

                      <div class="form-group">
                          <label for="Name">Strength Description</label>
                          <input type="text" class="form-control" placeholder="Strength Description" name="strength_desc">
                      </div>

                      <div class="form-group">
                          <label for="Name">Form Code</label>
                          <input type="text" class="form-control" placeholder="Form Code" name="form_code">
                      </div>

                      <div class="form-group">
                          <label for="Name">Form Description</label>
                          <input type="text" class="form-control" placeholder="Form Description" name="form_desc">
                      </div>

                      <div class="form-group">
                          <label for="Name">Packaging Code</label>
                          <input type="text" class="form-control" placeholder="Packaging Code" name="packaging_code">
                      </div>

                      <div class="form-group">
                          <label for="Description">Packaging Description</label>
                          <input type="text" class="form-control" placeholder="Packaging Description" name="packaging_desc">
                      </div>

                      <div class="form-group">
                          <label for="Quantity">Brand Code</label>
                          <input type="text" class="form-control" placeholder="Brand Code" name="brand_code">
                      </div>

                      <div class="form-group">
                          <label for="Quantity">Brand Name</label>
                          <input type="text" class="form-control" placeholder="Brand name" name="brand_name">
                      </div>

                      <div class="form-group">
                          <label for="Quantity">Manufacturer Name</label>
                          <input type="text" class="form-control" placeholder="Manufacturer name" name="manufacturer_name">
                      </div>

                      <div class="form-group">
                          <label for="Price">Price</label>
                          <input type="text" class="form-control" placeholder="Price" name="drug_price">
                      </div>

                      <div class="form-group">
                          <label for="Price">Quantity</label>
                          <input type="text" class="form-control" placeholder="Price" name="drug_quantity">
                      </div>

                      <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-send"></i> Submit</button>
                  </form>
                  <br>
                </div>
                <div class="col-lg-5">

                    <h4 style="font-weight:100" class="modal-title">Import CSV</h4>
                    <hr>
                    <?php echo form_open_multipart('Purchasing/add_drug_import');?>
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
