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
            <a class="btn btn-round btn-sm btn-warning" role="button" href="<?=base_url()?>Radiology/InactiveExams">SHOW INACTIVE EXAM</a>
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
                  <td>Price</td>
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
                      echo "<td>".$radiology_exam['exam_price']."</td>";
                      echo "<td>";
                        echo "<a data-id='".$radiology_exam['exam_id']."' data-name='".$radiology_exam['exam_name']."' data-description='".$radiology_exam['exam_description']."' data-price='".$radiology_exam['exam_price']."' role='button' onclick='updateexam(this)' class='btn btn-warning btn-sm'>Edit</a> ";
                        echo "<a href='".base_url()."Radiology/DeactivateExam/".$radiology_exam['exam_id']."' role='button' class='btn btn-danger btn-sm'>Deactivate</a>";
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



    <div class="modal fade modal-dialog-center" id="addnewexam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Exam Price: </label>
                          <div class="col-lg-9">
                              <input type="number" step="0.01" name="price" class="form-control" placeholder="Exam Price">
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

    <div class="modal fade modal-dialog-center" id="updateexam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">Update Radiology Exam</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('radiology/update_radiology_exam', $attributes);
                      ?>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Exam Name: </label>
                          <div class="col-lg-9">
                              <input type="hidden" id="id" name="id" class="form-control" >
                              <input type="text" id="name" name="name" class="form-control" >
                              <input type="hidden" id="originalname" name="originalname" class="form-control" >
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Exam Description: </label>
                          <div class="col-lg-9">
                              <input type="text" id="description" name="description" class="form-control">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Exam Price: </label>
                          <div class="col-lg-9">
                              <input type="number" step="0.01" id="price" name="price" class="form-control">
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
  </section>
</section>

<script>
  function updateexam(d){
    document.getElementById("id").value = d.getAttribute("data-id");
    document.getElementById("name").value = d.getAttribute("data-name");
    document.getElementById("originalname").value = d.getAttribute("data-name");
    document.getElementById("description").value = d.getAttribute("data-description");
    document.getElementById("price").value = d.getAttribute("data-price");
    $("#updateexam").modal();
  }
</script>

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
