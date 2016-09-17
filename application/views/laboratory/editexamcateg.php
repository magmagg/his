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
            echo form_open('Laboratory/update_examination_category/'.$examcateg->exam_cat_id, $attributes);
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
  </body>

  <!-- Mirrored from thevectorlab.net/flatlab/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 May 2016 02:05:28 GMT -->
  </html>
