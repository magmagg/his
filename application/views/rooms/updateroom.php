<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-12">
        <header class="panel-heading" style="background-color: #000;"></header>
        <header class="panel-heading">
            <center><h4>UPDATE ROOM <?=$rooms->room_id?><h4></center>
        </header>
        <div class="panel-body">
            <?php
              $attributes = array('class'=>'form-horizontal', 'role'=>'form');
              echo form_open('admin/update_room/'.$rooms->room_id, $attributes);
            ?>

            <div class="form-group">
                <label  class="col-lg-3 col-sm-3 control-label">Room Type: </label>
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
                <label  class="col-lg-3 col-sm-3 control-label">Room Location: </label>
                <div class="col-lg-9">
                  <input type="text" class="form-control"  name="roomloc" placeholder="Room Price" value="<?=$rooms->room_location?>">
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
      </div>
    </div>
  </section>
</section>
