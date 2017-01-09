<section id="main-content">
    <section class="wrapper">
      <section class="panel">
          <header class="panel-heading">

          </header>
          <div class="adv-table">
            <table class="table table-striped" style="text-align: center;" id="dynamic-table">
              <thead>
                <tr id="tblheader">
                  <td>Action</td>
                  <td>Name</td>
                  <td>Date Registered</td>
                  
                </tr>
              </thead>
              <tbody>
                <?php
               
                  foreach($doctors as $doctor){
        
  
                    echo "<tr>";
                    echo "<td><a href='".base_url()."Admitting/selectdoctor/".$this->uri->segment(3)."/".$doctor['user_id']."' role='button' class='btn btn-info btn-xs'>Select</a></td>";
                 
                    echo "<td>Dr. ".$doctor['first_name']." ".$doctor['middle_name']." ".$doctor['last_name']."</td>";
                    echo "<td>".$doctor['employment_date']."</td>";
                    
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
