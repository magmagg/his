<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-3">
        <section class="panel">
          <div class="panel-body">
          <center style="padding: 20px;" >
            <a class="btn btn-round btn-sm btn-success" data-toggle="modal" href="#addnewexam"><i class="fa fa-plus-circle"></i> ADD NEW EXAM</a>
            <br>
            <br>
            <a class="btn btn-round btn-info btn-sm"  href="<?=base_url()?>Radiology/Maintenance">SHOW ACTIVE EXAM</a>
          </center>
          </div>
        </section>
      </div>

      <div class="col-sm-9">
        <section class="panel">
          <header style="font-weight:300" class="panel-heading">
             Radiology Exam List
          <span class="tools pull-right">
          </span>
          </header>

        <div class="panel-body">
          <div class="adv-table">
            <table class="table table-striped" style="text-align: center;" id="dynamic-table">
              <thead>
                <tr id="tblheader">
                  <td>ID</td>
                  <td>Name</td>
                  <td>Description</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($radiology_exams as $radiology_exam){
                    echo "<tr>";
                      echo "<td>".$radiology_exam['exam_id']."</td>";
                      echo "<td>".$radiology_exam['exam_name']."</td>";
                      echo "<td>".$radiology_exam['exam_description']."</td>";
                      echo "<td>";
                        echo "<a href='".base_url()."Radiology/ActivateExam/".$radiology_exam['exam_id']."' role='button' class='btn btn-success btn-sm'>Activate</a>";
                      echo "</td>";
                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        </section>
      </div>
    </div>
  </section>
</section>

    <div class="modal fade modal-dialog-center" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">Add Radiology Exam</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('radiology/insert_radiology_exam', $attributes);
                      ?>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Exam Name: </label>
                          <div class="col-lg-9">
                              <input type="text" name="name" class="form-control" placeholder="Exam Name">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Exam Description: </label>
                          <div class="col-lg-9">
                              <input type="text" name="description" class="form-control" placeholder="Exam Description">
                          </div>
                      </div>

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <input type="submit" value="Submit" class="btn btn-warning">
                    </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>
    </div>


<!--footer start-->
<footer class="site-footer">
    <div class="container">
      <div class="text-center">
          2013 &copy; FlatLab by VectorLab.
      </div>
    </div>
</footer>
<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="<?=base_url()?>js/jquery.js"></script>
<script src="<?=base_url()?>js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?=base_url()?>js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?=base_url()?>js/jquery.scrollTo.min.js"></script>
<script src="<?=base_url()?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/jquery.sparkline.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="<?=base_url()?>js/owl.carousel.js" ></script>
<script src="<?=base_url()?>js/jquery.customSelect.min.js" ></script>
<script src="<?=base_url()?>js/respond.min.js" ></script>

<!--right slidebar-->
<script src="<?=base_url()?>js/slidebars.min.js"></script>

<!--common script for all pages-->
<script src="<?=base_url()?>js/common-scripts.js"></script>

<!--script for this page-->
<script src="<?=base_url()?>js/sparkline-chart.js"></script>
<script src="<?=base_url()?>js/easy-pie-chart.js"></script>
<script src="<?=base_url()?>js/count.js"></script>
