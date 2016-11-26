
<!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <aside class="col-lg-3">
                      <h4 class="drg-event-title"> Draggable Events</h4>
                      <div>
                        <?php echo form_open('Appointment/addAppointment'); ?>


                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title">
                                </div>
                        </div>
                        <div class="form-group">
                             <label class="col-sm-6 control-label">Select date</label>
                             <div class="col-sm-10">
                               <input size="16" type="text" readonly class="form_datetime form-control" name="adate">
                             </div>
                         </div>

                         <div class="form-group">
                                <label class="control-label col-md-3">Date Range</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large">
                                      <input size="16" type="text" readonly class="form_datetime form-control" name="from">
                                        <!-- <input type="text" class="form-control dpd1" name="from"> -->
                                        <span class="input-group-addon">To</span>
                                        <input size="16" type="text" readonly class="form_datetime form-control" name="end">
                                    </div>
                                    <span class="help-block">Select date range</span>
                                </div>
                            </div>

                         <div class="form-group">
                              <label class="col-sm-6 control-label">Description</label>
                              <div class="col-sm-10">
                                  <textarea type="text" class="form-control" name="adescription"></textarea>
                              </div>
                          </div>
                            <br>

                          <div class="form-group">
                              <div class="col-sm-10">
                                 <button class="btn btn-danger" type="submit">Add appointment</button>

                               </div>
                          </div>

                        </form>
                      </div>
                  </aside>
                  <aside class="col-lg-9" id="calendarmargin">
                      <section class="panel">
                          <div class="panel-body">
                              <div id="calendar" class="has-toolbar"></div>
                          </div>
                      </section>
                  </aside>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
