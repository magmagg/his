<!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <div class="row">


                <section class="panel">
                          <header class="panel-heading">
                              Add to schedule
                          </header>
                          <div class="panel-body">

                          <?php
                            $attributes = array('class' => 'form-horizontal', 'role' => 'form');

                            echo form_open('Appointment/addschedule', $attributes); 
                            echo form_hidden('hiddenId', $this->uri->segment(3));
                          ?>
                             
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Select Day</label>
                                      <div class="col-lg-10">
                                          <select class="form-control" name="seletedDay">
                                             <option value="default">Select </option> 
                                              <option value="Sunday">Sunday</option>
                                              <option value="Monday">Monday</option>
                                              <option value="Tuesday">Tuesday</option>
                                              <option value="Wednesday">Wednesday</option>
                                              <option value="Thursday">Thursday</option>
                                              <option value="Friday">Friday</option>
                                              <option value="Saturday">Saturday</option>
                                          </select>

                                        
                                      </div>
                                  </div>
                                 <div class="form-group">
                                  <label class="control-label col-md-3">Date Range</label>
                                  <div class="col-md-4">
                                      <div class="input-group input-large">
                                          <input type="time" class="form-control dpd1" name="from">
                                          <span class="input-group-addon">To</span>
                                          <input type="time" class="form-control dpd2" name="to">
                                      </div>
                                      <span class="help-block">Select date range</span>
                                  </div>
                              </div>
                                     <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Description</label>
                                      <div class="col-lg-10">
                                          <input type="text" class="form-control" placeholder="Description" name="description" >
                                       
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-danger">Add</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>









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