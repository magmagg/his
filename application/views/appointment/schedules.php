<!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <div class="row">
                  <section class="panel">
                          <header class="panel-heading">
                              Schedule
                          </header>
                    </section>  


                    <div class="adv-table">
                          <table class="table table-striped" style="text-align: center;" id="dynamic-table">
                              <thead>
                              <tr>
                                  <th><i class="fa fa-bullhorn"></i> Action</th>
                                  <th class="hidden-phone"><i class="fa fa-question-circle"></i> Name</th>
                                  <th><i class="fa fa-bookmark"></i> Date Registered</th>
                                  <th><i class=" fa fa-edit"></i> Status</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                             
                                  <?php
               
                  foreach($doctors as $doctor){
                     
                ?>
                              <tr>
                                  <td>
                                     <a href="<?= base_url()?>Appointment/viewschedule/<?= $doctor['user_id']?>"><button class="btn btn-primary btn-xs">View</button></a>
                                  </td>
                                  <td><?php echo "Dr"." ".$doctor['first_name']." ".$doctor['middle_name']." ".$doctor['last_name']; ?></td>
                                  <td class="hidden-phone"><?php echo $doctor['employment_date'];?></td>
                                  <td>12120.00$ </td>
                                  <td><span class="label label-info label-mini">Due</span></td>
                               
                              </tr>

                              <?php
                                  }
                              ?>
                             
                              </tbody>
                          </table>

                          </div>


















              </div>
          </section>
        </section>
    