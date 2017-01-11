<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-3">
          <section class="panel">
             <header style="font-weight:300" class="panel-heading">
                 New Exam Type
             <span class="tools pull-right">

             </span>
            </header>
			<div class="panel-body">
            <div class="adv-table">

              <table class="table">
                <tr>

                </tr>
              </table>
			  <center>
				<a href="#addnewetpye" data-toggle="modal" role="button" class="btn btn-sm btn-round btn-success"><i class="fa fa-plus-circle"></i> Add Exam Type</a>
				</center>
				</div>
				</div>
          </section>
      </div>
      <div class="col-sm-9">
          <section class="panel">

              <header class="panel-heading">
                  Laboratory Examination Type
              </header>
			  <div class="panel-body">
              <div class="adv-table">

              <table class="table table-striped" id="dynamic-table">
			    <thead>
                <tr id="tblheader">
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
				</thead>
				<tbody>
                <?php
                  foreach($examtype as $etype){
                    echo "<tr>";
                      echo "<td>".$etype['lab_exam_type_id']."</td>";
                      echo "<td>".$etype['lab_exam_type_name']."</td>";
                      echo "<td>".$etype['exam_cat_name'];
                      echo "<td>".$etype['lab_exam_type_description']."</td>";
                      echo "<td>".$etype['lab_exam_type_price']."</td>";
                      echo "<td>";
                        echo "<a data-id='".$etype['lab_exam_type_id']."' data-name='".$etype['lab_exam_type_name']."' data-category='".$etype['exam_cat_id']."'
                        data-description='".$etype['lab_exam_type_description']."' data-price='".$etype['lab_exam_type_price']."' role='button'
                        onclick='updateexamtype(this)' class='btn btn-warning btn-xs'>Update</a>";
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

    <div class="modal fade modal-dialog-center" id="addnewetpye" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">Add Exam Type</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('Laboratory/insert_examtype', $attributes);
                      ?>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Name: </label>
                          <div class="col-lg-9">
                                <input type="text" name="typename" class="form-control" placeholder="Name">
                          </div>
                      </div>
                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Category: </label>
                          <div class="col-lg-9">
                            <?php
                              if($examcateg != NULL){
                            ?>
                            <select class="form-control" name="examcateg">
                              <?php
                              foreach($examcateg as $categ){
                              echo "<option value=".$categ['exam_cat_id'].">".$categ['exam_cat_name']."</option>";
                              }
                              ?>
                            </select>
                            <?php
                          } else {
                            echo "No Examination Category";
                          }
                            ?>
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Description: </label>
                          <div class="col-lg-9">
                              <input type="text" name="typedesc" class="form-control" placeholder="Description">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Price: </label>
                          <div class="col-lg-9">
                              <input type="number" step="0.01" name="price" class="form-control" placeholder="Price">
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

    <div class="modal fade modal-dialog-center" id="updateexamtype" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">Update Exam Type</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('Laboratory/update_exam_type', $attributes);
                      ?>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Name: </label>
                          <div class="col-lg-9">
                                <input type="hidden" id="id" name="id" class="form-control" placeholder="Name">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                                <input type="hidden" id="originalname" name="originalname" class="form-control" placeholder="Name">
                          </div>
                      </div>
                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Category: </label>
                          <div class="col-lg-9">
                            <?php
                              if($examcateg != NULL){
                            ?>
                            <select id="examcateg" class="form-control" name="examcateg">
                            <?php
                              foreach($examcateg as $categ){
                              echo "<option value=".$categ['exam_cat_id'].">".$categ['exam_cat_name']."</option>";
                              }
                            ?>
                            </select>
                            <?php
                              } else {
                                echo "No Examination Category";
                              }
                            ?>
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Description: </label>
                          <div class="col-lg-9">
                              <input type="text" id="description" name="description" class="form-control" placeholder="Description">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Price: </label>
                          <div class="col-lg-9">
                              <input type="number" step="0.01" id="price" name="price" class="form-control" placeholder="Price">
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
  function updateexamtype(d){
    document.getElementById("id").value = d.getAttribute("data-id");
    document.getElementById("originalname").value = d.getAttribute("data-name");
    document.getElementById("name").value = d.getAttribute("data-name");
    $("#examcateg").val(d.getAttribute("data-category")).change();
    document.getElementById("description").value = d.getAttribute("data-description");
    document.getElementById("price").value = d.getAttribute("data-price");
    $("#updateexamtype").modal();
  }
</script>
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
