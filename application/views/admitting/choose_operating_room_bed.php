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
                  foreach($beds as $data){
                    echo "<tr>";
                      echo "<td>".$data['bed_id']."</td>";
                      if($data['bed_patient'] == NULL){
                        echo "<td></td>";
                        echo "<td><span class='label label-success'>AVAILABLE</span></td>";
                        echo "<td><a href='".base_url()."Admitting/ChoosePatientForOperatingRoom/OperatingRoom/".$this->uri->segment(3)."/".$data['bed_id']."' role='button' class='btn btn-success btn-xs'>CONFIRM</a></td>";
                      }else{
                        echo "<td>".$data['first_name']." ".$data['middle_name']." ".$data['last_name']."</td>";
                        echo "<span class='label label-danger>OCCUPIED</span>'";
                        echo "<td></td>";
                      }
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
