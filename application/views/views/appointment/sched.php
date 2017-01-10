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
                   
               <div class="col-md-2 column sortable">   
                 <div class="panel panel-primary">
                          <div class="panel-heading">Sunday</div>
                          <div class="panel-body">
                              <table class="table table-advance table-hover">
                              <thead>
                              <tr>
                                  <th>Time</th>
                                  <th>Description</th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                               foreach($sunday_datas as $sunday_data){
                              ?>
                              <tr>
                                  <td><?= $sunday_data['startTime']."-".$sunday_data['endTime']?></td>
                                  <td><?= $sunday_data['description']?></td>
                                  
                              </tr>

                              <?php
                               }
                              ?>
                              
                            
                              </tbody>
                          </table>
                          </div>
                 </div>
                      <!-- END Portlet PORTLET-->
                  
               </div>

                <div class="col-md-2 column sortable">   
                 <div class="panel panel-primary">
                          <div class="panel-heading">Monday</div>
                          <div class="panel-body">
                               <table class="table table-advance table-hover">
                              <thead>
                              <tr>
                                  <th>Time</th>
                                  <th>Description</th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <?php
                               foreach($monday_datas as $monday_data){
                              ?>
                              <tr>
                                  <td><?= $monday_data['startTime']."-".$monday_data['endTime']?></td>
                                  <td><?= $monday_data['description']?></td>
                                  
                              </tr>

                              <?php
                               }
                              ?>
                                  
                              </tr>
                             
                            
                              </tbody>
                          </table>
                          </div>
                 </div>
                      <!-- END Portlet PORTLET-->
                  
               </div>


                <div class="col-md-2 column sortable">   
                 <div class="panel panel-primary">
                          <div class="panel-heading">Tuesday</div>
                          <div class="panel-body">
                               <table class="table table-advance table-hover">
                              <thead>
                              <tr>
                                  <th>Time</th>
                                  <th>Description</th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                     <?php
                               foreach($tuesday_datas as $tuesday_data){
                              ?>
                              <tr>
                                  <td><?= $tuesday_data['startTime']."-".$tuesday_data['endTime']?></td>
                                  <td><?= $tuesday_data['description']?></td>
                                  
                              </tr>

                              <?php
                               }
                              ?>
                                  
                              </tr>
                           
                              </tbody>
                          </table>
                          </div>
                 </div>
                      <!-- END Portlet PORTLET-->
                  
               </div>


                <div class="col-md-2 column sortable">   
                 <div class="panel panel-primary">
                          <div class="panel-heading">Wednesday</div>
                          <div class="panel-body">
                              <table class="table table-advance table-hover">
                              <thead>
                              <tr>
                                  <th>Time</th>
                                  <th>Description</th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                      <?php
                               foreach($wednesday_datas as $wednesday_data){
                              ?>
                              <tr>
                                  <td><?= $wednesday_data['startTime']."-".$wednesday_data['endTime']?></td>
                                  <td><?= $wednesday_data['description']?></td>
                                  
                              </tr>

                              <?php
                               }
                              ?>
                                  
                              </tr>
                           
                            
                              </tbody>
                          </table>
                          </div>
                 </div>
                      <!-- END Portlet PORTLET-->
                  
               </div>

                    <div class="col-md-2 column sortable">   
                 <div class="panel panel-primary">
                          <div class="panel-heading">Thurday</div>
                          <div class="panel-body">
                              <table class="table table-advance table-hover">
                              <thead>
                              <tr>
                                  <th>Time</th>
                                  <th>Description</th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                      <?php
                               foreach($thursday_datas as $thursday_data){
                              ?>
                              <tr>
                                  <td><?= $thursday_data['startTime']."-".$thursday_data['endTime']?></td>
                                  <td><?= $thursday_data['description']?></td>
                                  
                              </tr>

                              <?php
                               }
                              ?>
                                  
                              </tr>
                           
                            
                              </tbody>
                          </table>
                          </div>
                 </div>
                      <!-- END Portlet PORTLET-->
                  
               </div>

                    <div class="col-md-2 column sortable">   
                 <div class="panel panel-primary">
                          <div class="panel-heading">Friday</div>
                          <div class="panel-body">
                               <table class="table table-advance table-hover">
                              <thead>
                              <tr>
                                  <th>Time</th>
                                  <th>Description</th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                 
                                     <?php
                               foreach($friday_datas as $friday_data){
                              ?>
                              <tr>
                                  <td><?= $friday_data['startTime']."-".$friday_data['endTime']?></td>
                                  <td><?= $friday_data['description']?></td>
                                  
                              </tr>

                              <?php
                               }
                              ?>
                                  
                              </tr>
                         
                            
                              </tbody>
                          </table>
                          </div>
                 </div>
                      <!-- END Portlet PORTLET-->
                  
               </div>

                    <div class="col-md-2 column sortable">   
                 <div class="panel panel-primary">
                          <div class="panel-heading">Saturday</div>
                          <div class="panel-body">
                               <table class="table table-advance table-hover">
                              <thead>
                              <tr>
                                  <th>Time</th>
                                  <th>Description</th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                      <?php
                               foreach($saturday_datas as $saturday_data){
                              ?>
                              <tr>
                              
                                  <td><?= $saturday_data['startTime']."-".$saturday_data['endTime']?></td>
                                  <td><?= $saturday_data['description']?></td>
                                  
                              </tr>

                              <?php
                               }
                              ?>
                                  
                              </tr>
                            
                            
                              </tbody>
                          </table>
                          </div>
                 </div>
                      <!-- END Portlet PORTLET-->
                  
               </div>















              </div>

              <!-- page end-->
          </section>
      </section>
      <!--main content end-->