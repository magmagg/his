<section id="main-content">
    <section class="wrapper">
      <section class="panel">
          <header class="panel-heading">

          </header>
          <div class="adv-table">
            <table class="table table-striped" style="text-align: center;" id="dynamic-table">
              <thead>
                <tr id="tblheader">
                  <td>Patient ID</td>
                  <td>Name</td>
                  <td>Date Registered</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($patients as $patient){
                    echo "<tr>";
                    echo "<td>".$patient['patient_id']."</td>";
                    echo "<td>".$patient['first_name']." ".$patient['middle_name']." ".$patient['last_name']."</td>";
                    echo "<td>".$patient['date_registered']."</td>";
                    echo "<td><a href='".base_url()."Admitting/admitpatient/".$this->uri->segment(3)."/".$this->uri->segment(4)."/".$patient['patient_id']."' role='button' class='btn btn-success btn-xs'>CONFIRM</a></td>";
                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
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
