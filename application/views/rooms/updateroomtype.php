<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-12">
        <header class="panel-heading" style="background-color: #000;"></header>
        <header class="panel-heading">
            <center><h4>UPDATE ROOM <?=$roomtype->room_type_id?><h4></center>
        </header>
        <div class="panel-body">
            <?php
              $attributes = array('class'=>'form-horizontal', 'role'=>'form');
              echo form_open('admin/update_roomtype/'.$roomtype->room_type_id, $attributes);
            ?>

            <div class="form-group">
                <label  class="col-lg-3 col-sm-3 control-label">Room Name: </label>
                <div class="col-lg-9">
                  <input type="text" class="form-control"  name="roomname" placeholder="Room Name" value="<?=$roomtype->room_name?>">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-lg-3 col-sm-3 control-label">Room Location: </label>
                <div class="col-lg-9">
                  <input type="text" class="form-control"  name="roomprice" placeholder="Room Price" value="<?=$roomtype->room_price?>">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-lg-3 col-sm-3 control-label">Room Description: </label>
                <div class="col-lg-9">
                  <textarea class="form-control" name="roomdesc" placeholder="Room Description"><?=$roomtype->room_description?></textarea>
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
