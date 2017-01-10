<div class="modal fade" id="input_pf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Input Professional Fee
            </div>
            <div class="modal-body">
              <?php
                $attributes = array('class'=>'form-horizontal', 'role'=>'form', 'id'=>'inputted_pf_form');
                echo form_open('', $attributes);
              ?>
              <div class="form-group">
                  <label  class="col-lg-3 col-sm-3 control-label">Amount: </label>
                  <div class="col-lg-9">
                      <input type="text" id="inputted_pf" name="inputted_pf" class="form-control">
                  </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a style="margin-top: -5px;" class="btn btn-success btn-ok" onclick="submit_by_id()">Confirm</a>
            </div>
            <?=form_close()?>
        </div>
    </div>
</div>
