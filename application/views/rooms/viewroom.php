<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-3">
        <section class="panel">
            <header class="panel-heading" style="background-color: #000;"></header>
            <table class="table">
              <tr align="center">
                <td><a class="btn btn-info" data-toggle="modal" href="#addnewbeds">+ADD BEDS</a></td>
              </tr>
            </table>
        </section>
      </div>
      <div class="col-sm-9">
        <header class="panel-heading" style="background-color: #000;"></header>
        <header class="panel-heading">
            <center><h4>ROOM <?=$roomid?> DETAILS<h4></center>
        </header>
        <table class="table table-hovered" style="text-align: center;">
          <tr id="tblheader">
            <td>Bed #</td>
            <td>Occupancy Status</td>
            <td>Patient</td>
            <td>Action</td>
          </tr>
          <?php
           foreach($roomdata as $room){
             echo "<tr>";
               echo "<td>BED-".$room['bed_id']."</td>";
               if($room['patient_id']==""){
                   echo "<td>Bed Available</td>";
                   echo "<td>Empty</td>";
                   echo "<td><a href='".base_url()."Admin/remove_bed/".$roomid."/".$room['bed_id']."' role='button' class='btn btn-default btn-xs'>Remove Bed</a></td>";
               }else{
                 echo "<td>OCCUPIED</td>";
                 echo "<td>".$room['first_name']." ".$room['last_name']."</td>";
                 echo "<td><a href='javascript: void(0)' role='button' class='btn btn-default btn-xs' disabled>Remove Bed</a></td>";
               }
             echo "</tr>";
           }
         ?>
        </table>
      </div>
    </div>

    <div class="modal fade modal-dialog-center" id="addnewbeds" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">Add Beds</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('admin/add_bed/'.$roomid, $attributes);
                      ?>
                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Number of Beds: </label>
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
                        <input type="submit" value="Submit" class="btn btn-warning">
                    </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>
    </div>
  </section>
</section>
