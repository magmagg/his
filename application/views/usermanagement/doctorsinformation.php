<section id="main-content">
  <section class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">

				<header style="font-weight:300" class="panel-heading">
					 Doctors List
				 <span class="tools pull-right">
				 </span>
				</header>

				<div class="panel-body">
				<div class="adv-table">
                <table class="table table-striped" style="text-align: center;" id="dynamic-table">
				<thead>
                  <tr id="tblheader">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Contact No.</th>
                      <th>Schedule</th>
                      <th>Action</th>
                  </tr>
				  </thead>
				  <tbody>
                  <?php
                    foreach($doctors_information as $user){
                      echo "<tr>";
                        echo "<td>".$user['user_id']."</td>";
                        echo "<td>";
                          if($user['gender'] == 'M'){
                            echo "Mr. ";
                          }else{
                            echo "Ms. ";
                          }
                          echo $user['first_name']." ".$user['middle_name']." ".$user['last_name'];
                        echo "</td>";
                        echo "<td>".$user['contact_number']."</td>";
                        echo "<td>".date('H:i', strtotime($user['start_time']))."-".date('H:i', strtotime($user['end_time']))."</td>";
                        echo "<td>";
                          echo "<div class='btn-group' role='group' aria-label='...'>";
                            echo "<a href='#updateschedule' data-toggle='modal'
                                     data-userid='". $user['user_id'] ."'
                                     data-firstname='". $user['first_name'] ."'
                                     data-lastname='". $user['last_name'] ."'
                                     data-username='". $user['username'] ."'
                                     data-middlename='". $user['middle_name'] ."'
                                     data-starttime='". $user['start_time'] ."'
                                     data-endtime='". $user['end_time'] ."'
                                    role='button' class='btn btn-warning btn-sm'>Update Schedule</a>";
                          echo "</div>";
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

    <div class="modal fade modal-dialog-center" id="updateschedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">Update Schedule</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('UserManagement/update_doctor_schedule', $attributes, $attributes);
                      ?>

                      <input type="hidden" name="userid" id="userid">


                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Name: </label>
                          <div class="col-lg-9">
                              <input type="text" id="name" name="name" class="form-control" disabled>
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Start Time: </label>
                          <div class="col-lg-9">
                              <input type="time" id="updatestarttime" name="updatestarttime" class="form-control">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Start Time: </label>
                          <div class="col-lg-9">
                              <input type="time" id="updateendtime" name="updateendtime" class="form-control">
                          </div>
                      </div>



                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <input type="submit" value="Submit" class="btn btn-success">
                    </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>
    </div>

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

<script>
  $('#updateschedule').on('show.bs.modal', function(e)
  {
    //get data-id attribute of the clicked element
    var userid = $(e.relatedTarget).data('userid');
    var name = $(e.relatedTarget).data('firstname')+" "+$(e.relatedTarget).data('middlename')+" "+$(e.relatedTarget).data('lastname');
    var start_time = $(e.relatedTarget).data('starttime');
    var end_time = $(e.relatedTarget).data('endtime');

    //populate the textbox
    $(e.currentTarget).find('input[id="userid"]').val(userid);
    $(e.currentTarget).find('input[id="name"]').val(name);
    $(e.currentTarget).find('input[id="updatestarttime"]').val(start_time);
    $(e.currentTarget).find('input[id="updateendtime"]').val(end_time);
  });
</script>
