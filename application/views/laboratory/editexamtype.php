<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <header class="panel-heading" style="background-color: #000;"></header>
      <header class="panel-heading">
          <center><h4>UPDATE EXAMINATION TYPE<h4></center>
      </header>
      <div class="panel-body">
          <?php
            $attributes = array('class'=>'form-horizontal', 'role'=>'form');
            echo form_open('admin/update_exam_type/'.$examtype->lab_exam_type_id, $attributes);
          ?>


          <div class="form-group">
              <label  class="col-lg-3 col-sm-3 control-label">Name: </label>
              <div class="col-lg-9">
                <input type="text" class="form-control"  name="typename" placeholder="Exam Type Name" value="<?=$examtype->lab_exam_type_name?>">
              </div>
          </div>

          <div class="form-group">
              <label  class="col-lg-3 col-sm-3 control-label">Category: </label>
              <div class="col-lg-9">
                <select class="form-control" name="typecateg">
                  <?php
                  foreach($examcateg as $categ){
                  echo "<option value=".$categ['exam_cat_id'].">".$categ['exam_cat_name']."</option>";
                  }
                  ?>
                </select>
              </div>
          </div>

          <div class="form-group">
              <label  class="col-lg-3 col-sm-3 control-label">Description: </label>
              <div class="col-lg-9">
                <input type="text" class="form-control"  name="typedesc" placeholder="Exam Type Description" value="<?=$examtype->lab_exam_type_description?>">
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
