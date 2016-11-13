  <!--sidebar end-->
  <!--main content start-->
  <section id="main-content">
      <section class="wrapper">

        <?php
              $this->load->view('includes/changePasswordModal');
        ?>
        <center><h1>DOCTOR</h1></center>

          <!--state overview start-->
          <div class="row state-overview">
              <div class="col-lg-3 col-sm-6">
                  <section class="panel">
                      <div class="symbol terques">
                          <i class="fa fa-users"></i>
                      </div>
                      <div class="value">
                          <h1 class="count">
                              0
                          </h1>
                          <p>No. Department Nurses</p>
                      </div>
                  </section>
              </div>
              <div class="col-lg-3 col-sm-6">
                  <section class="panel">
                      <div class="symbol red">
                          <i class="fa fa-medkit"></i>
                      </div>
                      <div class="value">
                          <h1 class=" count2">
                              0
                          </h1>
                          <p>Medicine Request</p>
                      </div>
                  </section>
              </div>
              <div class="col-lg-3 col-sm-6">
                  <section class="panel">
                      <div class="symbol yellow">
                          <i class="fa fa-wheelchair"></i>
                      </div>
                      <div class="value">
                          <h1 class=" count3">
                              0
                          </h1>
                          <p>No. Patient under department</p>
                      </div>
                  </section>
              </div>
              <div class="col-lg-3 col-sm-6">
                  <section class="panel">
                      <div class="symbol blue">
                          <i class="fa  fa-stethoscope"></i>
                      </div>
                      <div class="value">
                          <h1 class=" count4">
                              0
                          </h1>
                          <p>Pending CSR Request</p>
                      </div>
                  </section>
              </div>
          </div>
          <!--state overview end-->


          <div class="row">
              <div class="col-lg-4">
                  <!--user info table start-->
                  <section class="panel">
                    <div class="panel-body">
                      <div class="form">
                        <?php
                            echo form_open('dashboard/updateProfessionalFee');
                        ?>
                        <div class="form-group ">
                            <label for="firstname" class="control-label col-lg-">Default Professional fee  (current: P<?php echo $defaultProfessionalFee; ?>)</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="firstname" name="dfprofessionalfee" type="text" placeholder="Update professional fee" />
                                </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                               <button class="btn btn-danger" type="submit">Update</button>

                             </div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </section>
                  <!--user info table end-->
              </div>
              <div class="col-lg-8">
                  <!--work progress start-->
                  <section class="panel">
                      <div class="panel-body progress-panel">
                          <div class="task-progress">
                              <h1>Work Progress</h1>
                              <p>Anjelina Joli</p>
                          </div>
                          <div class="task-option">
                              <select class="styled">
                                  <option>Anjelina Joli</option>
                                  <option>Tom Crouse</option>
                                  <option>Jhon Due</option>
                              </select>
                          </div>
                      </div>
                      <table class="table table-hover personal-task">
                          <tbody>
                          <tr>
                              <td>1</td>
                              <td>
                                  Target Sell
                              </td>
                              <td>
                                  <span class="badge bg-important">75%</span>
                              </td>
                              <td>
                                <div id="work-progress1"></div>
                              </td>
                          </tr>
                          <tr>
                              <td>2</td>
                              <td>
                                  Product Delivery
                              </td>
                              <td>
                                  <span class="badge bg-success">43%</span>
                              </td>
                              <td>
                                  <div id="work-progress2"></div>
                              </td>
                          </tr>
                          <tr>
                              <td>3</td>
                              <td>
                                  Payment Collection
                              </td>
                              <td>
                                  <span class="badge bg-info">67%</span>
                              </td>
                              <td>
                                  <div id="work-progress3"></div>
                              </td>
                          </tr>
                          <tr>
                              <td>4</td>
                              <td>
                                  Work Progress
                              </td>
                              <td>
                                  <span class="badge bg-warning">30%</span>
                              </td>
                              <td>
                                  <div id="work-progress4"></div>
                              </td>
                          </tr>
                          <tr>
                              <td>5</td>
                              <td>
                                  Delivery Pending
                              </td>
                              <td>
                                  <span class="badge bg-primary">15%</span>
                              </td>
                              <td>
                                  <div id="work-progress5"></div>
                              </td>
                          </tr>
                          </tbody>
                      </table>
                  </section>
                  <!--work progress end-->
              </div>
          </div>


      </section>
  </section>
  <!--main content end-->
