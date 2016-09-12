<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <header class="panel-heading" style="background-color: #000;"></header>
      <header class="panel-heading">
          <center><h4>UPDATE EXAMINATION CATEGORY<h4></center>
      </header>
      <div class="panel-body">
          <?php
            $attributes = array('class'=>'form-horizontal', 'role'=>'form');
            echo form_open('admin/update_examination_category/'.$examcateg->exam_cat_id, $attributes);
          ?>


          <div class="form-group">
              <label  class="col-lg-3 col-sm-3 control-label">Name: </label>
              <div class="col-lg-9">
                <input type="text" class="form-control"  name="catname" placeholder="Category Name" value="<?=$examcateg->exam_cat_name?>">
              </div>
          </div>

          <div class="form-group">
              <label  class="col-lg-3 col-sm-3 control-label">Description: </label>
              <div class="col-lg-9">
                <input type="text" class="form-control"  name="catdesc" placeholder="Category Description" value="<?=$examcateg->exam_cat_desc?>">
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
