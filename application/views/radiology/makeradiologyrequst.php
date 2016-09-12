<section id="main-content">
  <section class="wrapper">
    <?php
      $attributes = array('class'=>'form-horizontal', 'role'=>'form');
      echo form_open(base_url().'Radiology/insert_request/');
    ?>
    <div class="row">
      <div class="col-sm-4">
          <section class="panel">
              <header class="panel-heading" style="background-color: #000;"></header>
              <header class="panel-heading" align="center">CHOOSE PATIENT </header>
              <table class="table">
                <center>
                <div class="form-group">
                    <div class="col-lg-12">
                      <select name="patient" size="20" style="height: 100%;">
                        <?php
                          foreach($patients as $patient){
                            echo "<option value='".$patient['patient_id']."'>";
                              echo $patient['patient_id'].": ".$patient['first_name']." ".$patient['middle_name']." ".$patient['last_name'];
                            echo "</option>";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <br>
              </center>
              </table>
          </section>
      </div>
      <div class="col-sm-8">
        <section class="panel">
            <header class="panel-heading" style="background-color: #000;"></header>
            <header class="panel-heading" align="center">SELECT RADIOLOGY EXAM</header>
            <table class="table">
              <center>
              <div class="form-group">
                  <div class="col-lg-12">
                    <div class="form-group">
                        <div class="col-lg-12">
                          <?php
                            foreach($radiology_exams as $radiology_exam){
                              echo "<div class='col-lg-3'>";
                              echo "<label class='checkbox-inline'>";
                                echo "<input type='checkbox' name='exams[]' value='".$radiology_exam['exam_id']."'>".$radiology_exam['exam_name'];
                              echo "</label>";
                              echo "</div>";
                            }
                          ?>
                    </div>
                  </div>
              </div>
              <br>
            </center>
            </table>
        </section>
      </div>
    </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    Request Note (Optional)
                    <span class="tools pull-right">
                      <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                  <div class="form-group">
                    <label class="control-label col-md-3">Note</label>
                    <div class="col-md-9">
                        <textarea class="wysihtml5 form-control" name="note" rows="10"></textarea>
                    </div>
                  </div>
                </div>
            </section>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-12">
          <center><input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info"></center>
        </div>
    </div>
      <?=form_close()?>
  </section>
</section>


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
