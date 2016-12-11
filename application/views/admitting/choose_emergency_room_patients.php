<section id="main-content">
    <section class="wrapper">
      <section class="panel">
          <header class="panel-heading">
              <h3 align="center">Emergency Room Patients</h3>
          </header>
          <table class="table table-hover p-table">
              <thead>
              <tr>
                  <th>Name</th>
                  <th>Date Admitted</th>
                  <th>Location</th>
              </tr>
              </thead>
              <tbody>
                <?php
                  foreach($emergency_room_patients as $data){
                    echo "<tr>";
                      echo "<td>".$data['first_name']." ".$data['middle_name']." ".$data['last_name']."</td>";
                      echo "<td>".date('M d,Y', strtotime($data['admission_date']))."</td>";
                      echo "<td>".$data['room_location']."</td>";
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
