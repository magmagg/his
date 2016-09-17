<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-12">
        <center><h4><a href='<?=base_url()?>Laboratory/MakeLaboratoryRequests' role='button' class='btn btn-default btn-xs'><</a>MAKE LABORATORY REQUEST</h4></center>
        <header class="panel-heading" align="center">FILL LABORATORY REQUEST FORM</header>
      </div>
      <div class="col-sm-12">
          <section class="panel">
              <header class="panel-heading" style="background-color: #000;"></header>
              <header class="panel-heading">
   <center><h4>PATIENT DETAILS<h4></center>
              </header>
              <table class="table table-striped">
                  <thead>
                  <tr>
                      <td style="text-align: center;"><b>Name:</b> &ensp;<?php echo $patient->first_name." ".$patient->last_name; ?></td>
                  </tr>
                  <tr>
                      <td style="text-align: center;"><b>Address:</b> &ensp;<?php echo $patient->present_address; ?></td>
                  </tr>
                  <tr>
                      <td style="text-align: center;"><b>Number:</b> &ensp;<?php echo $patient->mobile_number." / ".$patient->telephone_number; ?></td>
                  </tr>
                  <tr>
                      <td style="text-align: center;"><b>Date of Birth:</b> &ensp;<?php echo $patient->birthdate; ?></td>
                  </tr>
                  <tr>
                      <td style="text-align: center;"><b>Gender:</b> &ensp;<?php echo $patient->gender ?></td>
                  </tr>
                  </thead>
                  <tbody align="center">

                  </tbody>
              </table>
          </section>
      </div>
      <div class="col-sm-12">
        <header class="panel-heading">
        </header>
        <div class="panel-body">

            <center>
              <?php
                $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                echo form_open('Laboratory/insert_laboratoryrequest/', $attributes);
              ?>
              <header class="panel-heading" align="center">CHOOSE LABORATORY EXAMINATION</header>
            <div class="form-group">
                <div class="col-lg-12">
                  <?php if($labexamtype != NULL){?>
                  <select name="laboratoryexam" size="10" style="height: 100%;">
                    <?php
                      foreach($labexamtype as $etype){
                        echo "<option value='".$etype['lab_exam_type_id']."'>";
                          echo $etype['lab_exam_type_id'].": ".$etype['lab_exam_type_name'];
                        echo "</option>";
                      }
                    ?>
                  </select>
                  <?php
                } else {
                   echo "No Laboratory Examination Type";
                }
                  ?>
                  <div class="form-group">
                    <br>
                      <label  class="col-lg-5 col-sm-3 control-label">Urgency:</label>
                      <div class="col-lg-2">
                          <select class="form-control" name="urgency">
                            <?php
                              foreach($urgencycat as $ucat){
                                echo "<option value='".$ucat['urg_id']."'>";
                                  echo $ucat['urg_name'];
                                echo "</option>";
                              }
                            ?>
                          </select>
                      </div>
                  </div>
                  <div class="form-group">
                    <br>
                      <label  class="col-lg-5 col-sm-3 control-label">Fasting:</label>
                      <div class="col-lg-2">
                          <select class="form-control" name="fasting">
                            <?php
                              foreach($fastingcat as $fcat){
                                echo "<option value='".$fcat['fast_id']."'>";
                                  echo $fcat['fast_name'];
                                echo "</option>";
                              }
                            ?>
                          </select>
                      </div>
                  </div>
                  <div class="form-group">
                    <br>
                      <label  class="col-lg-5 col-sm-3 control-label">Specimen:</label>
                      <div class="col-lg-2">
                            <?php
                              if($specimen != NULL){
                              foreach($specimen as $spec){
                                  echo "<input type='checkbox' name='specimens[]' value='".$spec['specimen_id']."'/>".$spec['specimen_name'];
                                  echo "<br>";
                              }
                            } else {
                              echo "No specimens available";
                            }
                            ?>
                      </div>
                  </div>
                  <div class="form-group">
                    <br>
                      <label  class="col-lg-5 col-sm-3 control-label">Comment/Remark:</label>
                      <div class="col-lg-2">
                  <textarea name="labremark" rows="5" cols="40"></textarea>
                  <input type="hidden" name="patientid" value="<?php echo $patient->patient_id; ?>"/>
                  <input type="hidden" name="patientchckin" value="<?php echo $patient->date_registered; ?>"/>
                      </div>
                  </div>

                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                  <center>
                    <br>
                    <input type="submit" value="Request" class="btn btn-info">
                  </center>
                </div>
            </div>
          <?=form_close()?>
          </center>
          </div>
        </div>
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
