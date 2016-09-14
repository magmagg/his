<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-12">
          <section class="panel">
               <header style="font-weight:300" class="panel-heading">
					<b>Bed List</b><br><small>Please choose bed</small>
				 <span class="tools pull-right">
				 </span>
			  </header>
			  <div class="panel-body">
              <div class="adv-table">
              <table class="table table-striped" style="text-align: center;" id="dynamic-table">
			    <thead>
                <tr id="tblheader">
                    <th>Location</th>
                    <th>Bed ID</th>
                    <th>Occupancy</th>
                    <th>Maintenance</th>
                    <th>Action</th>
                </tr>
				</thead>
				<tbody>
                <?php
                  foreach($roomdata as $room){
                    echo "<tr>";
                      echo "<td>".$room['room_location']."</td>";
                      echo "<td>".$room['bed_id']."</td>";
                      if($room['bed_patient'] == NULL){
                        echo "<td><span class='label label-success'>AVAILABLE</span></td>";
                        if($room['bed_maintenance'] == 0){
                          echo "<td><span class='label label-success'>AVAILABLE</span></td>";
                          echo "<td>";
                            echo "<a href='".base_url()."Rooms/ForCleaning/".$room['bed_id']."/".$room['room_id']."' role='button' class='btn btn-warning btn-sm'>Cleaning</a> ";
                            echo "<a href='".base_url()."Rooms/ForMaintenance/".$room['bed_id']."/".$room['room_id']."' role='button' class='btn btn-warning btn-sm'>Maintenance</a>";
                          echo "</td>";
                        }else if($room['bed_maintenance'] == 1){
                          echo "<td><span class='label label-info'>FOR CLEANING</span></td>";
                          echo "<td><a href='".base_url()."Rooms/ForMaintenance/".$room['bed_id']."/".$room['room_id']."' role='button' class='btn btn-warning btn-sm'>Maintenance</a></td>";
                        }else{
                          echo "<td><span class='label label-danger'>FOR MAINTENANCE</span></td>";
                          echo "<td></td>";
                        }
                      }else{
                        echo "<td><span class='label label-danger'>OCCUPIED</span></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                      }
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

    <div class="modal fade modal-dialog-center" id="addnewroom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">Add Room</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('admin/insert_room', $attributes);
                      ?>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Room Type </label>
                          <div class="col-lg-9">
                              <select class="form-control" name="roomtype">
                                <?php
                                  foreach($roomtypes as $type){
                                    echo "<option value=".$type['room_type_id'].">".$type['room_name']."</option>";
                                  }
                                ?>
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Room Location </label>
                          <div class="col-lg-9">
                              <input type="text" name="roomloc" class="form-control" placeholder="Room Location">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Number of Beds </label>
                          <div class="col-lg-9">
                              <select class="form-control" name="bednum">
                                <?php
                                  for($i = 1; $i<=25; $i++){
                                    echo "<option value=".$i.">".$i."</option>";
                                  }
                                ?>
                              </select>
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
