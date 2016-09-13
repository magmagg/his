<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-12">
          <section class="panel">
               <header style="font-weight:300" class="panel-heading">
					Room List
				 <span class="tools pull-right">
				 </span>
			  </header>
			  <div class="panel-body">
              <div class="adv-table">
              <table class="table table-striped" style="text-align: center;" id="dynamic-table">
			    <thead>
                <tr id="tblheader">
                    <th>#</th>
                    <th>Room Type</th>
                    <th>Room Location</th>
                    <th>Action</th>
                </tr>
				</thead>
				<tbody>
                <?php
                  foreach($rooms as $room){
                    echo "<tr>";
                      echo "<td>".$room['room_id']."</td>";
                      echo "<td>".$room['room_name']."</td>";
                      echo "<td>".$room['room_location']."</td>";
                      echo "<td>";
                        echo "<a href='".base_url()."Rooms/ReportBed/".$room['room_id']."' role='button' class='btn btn-warning btn-sm'>Confirm</a>";
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
