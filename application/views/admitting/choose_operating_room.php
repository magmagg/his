<section id="main-content">
    <section class="wrapper">
      <section class="panel">
          <header class="panel-heading">
              <h3 align="center">Choose Room</h3>
          </header>
          <table class="table table-hover p-table">
              <thead>
              <tr>
                  <th>Room ID</th>
                  <th>Location</th>
                  <th>Action</th>
              </tr>
              </thead>
              <tbody>
                <?php
                  foreach($room as $data){
                    echo "<tr>";
                      echo "<td>".$data['room_id']."</td>";
                      echo "<td>".$data['room_location']."</td>";
                      echo "<td><a href='".base_url()."Admitting/OperatingRoom/".$data['room_id']."' role='button' class='btn btn-success btn-xs'>CONFIRM</td>";
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
