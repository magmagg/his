<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <header class="panel-heading" style="background-color: #000;"></header>
      <header class="panel-heading">
          <center><h4>UPDATE LABORATORY SPECIMEN<h4></center>
      </header>
      <div class="panel-body">
          <?php
            $attributes = array('class'=>'form-horizontal', 'role'=>'form');
            echo form_open('admin/update_lab_specimen/'.$spec->specimen_id, $attributes);
          ?>


          <div class="form-group">
              <label  class="col-lg-3 col-sm-3 control-label">Name: </label>
              <div class="col-lg-9">
                <input type="text" class="form-control"  name="specname" placeholder="Specimen Name" value="<?=$spec->specimen_name?>">
              </div>
          </div>

          <div class="form-group">
              <label  class="col-lg-3 col-sm-3 control-label">Description: </label>
              <div class="col-lg-9">
                <input type="text" class="form-control"  name="specdesc" placeholder="Specimen Description" value="<?=$spec->specimen_description?>">
              </div>
          </div>

          <div class="form-group">
              <div class="col-lg-12">
                <center>
                  <input type="submit" value="Save" class="btn btn-info">
                </center>
              </div>
          </div>
          <?=form_close()?>
        </div>
    </div>
    </section>
  </section>
