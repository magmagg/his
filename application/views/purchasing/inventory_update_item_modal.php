<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Item</h4>
      </div>
      <div class="modal-body">

        <?php echo form_open('Pharmacy/update_item_inventory');?>

                                <input type="hidden" name="itemid">
                                  <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                  </div>
                                 <div class="form-group">
                                  <label for="description">Description</label>
                                  <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                                  </div>

                                  <div>
                                  <label for="name">Quantity</label>
                                  <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required>
                                  </div>
                                 <div class="form-group">
                                  <label for="description">Price</label>
                                  <input type="text" class="form-control" id="price" name="price" placeholder="Price" required>
                                  </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
