<section id="main-content">
    <section class="wrapper">
      <section class="panel">
          <header class="panel-heading">
              <span class="pull-right">
              </span>
          </header>
          <table class="table table-hover p-table">
              <thead>
              <tr>
                  <th>Bed ID</th>
                  <th>Patient</th>                  
                  <th>Status</th>
                  <th>Action</th>
              </tr>
              </thead>
              <tbody>
                <?php
                    foreach($direct_room_beds as $room){
                        echo "<tr>";
                            echo "<td>".$room['bed_id']."</td>";
                            if($room['bed_patient'] != NULL){
                                echo "<td>";
                                    echo $room['first_name']." ".$room['middle_name']." ".$room['first_name'];
                                echo "</td>";
                                echo "<td><span class='label label-danger'>OCCUPIED</span></td>";
                            }else{
                                echo "<td></td>";
                                echo "<td><span class='label label-success'>AVAILABLE</span></td>";
                            }
                            echo "<td><a href='".base_url()."Admitting/transfer_patient/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4)."/".$room['bed_id']."' role='button' class='btn btn-success btn-xs'>CONFIRM</td>";
                        echo "</tr>";
                    }
                ?>
              </tbody>
          </table>
      </section>
    </section>
</section>


<section>
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