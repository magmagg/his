<section id="main-content">
    <section class="wrapper">
                <div class="row">
             <div class="col-lg-12">
                 <section class="panel">
                   <h1 style="color: red;"></h1>
                     <header class="panel-heading">
                        <?php echo $this->uri->segment(3); ?> Vital signs History
                        <a class='btn btn-primary btn-sm pull-right' data-toggle="modal" href="#myModal3">Record Vital Sign</a>
                     </header>
                     <div class="panel-body">
                         <section id="flip-scroll">
                             <table class="table table-bordered table-striped table-condensed cf">
                                 <thead class="cf">
                                 <tr>
                                     <th>ID</th>
                                     <th>Date</th>
                                     <th>Time</th>
                                     <th class="numeric">Heart rate (pulse)</th>
                                     <th class="numeric">Respiratory rate</th>
                                     <th class="numeric">Blood pressure</th>
                                     <th class="numeric">Body temperature (Celsius)</th>
                                     <th>Nurse</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                   <tr>
                                     <?php
                                      foreach($vitalsign_data as $data){
                                        echo "<tr>";
                                          echo "<td>".$data['vital_id']."</td>";
                                          echo "<td>".date('F d, Y', strtotime($data['date_recorded']))."</td>";
                                          echo "<td>".date('H:i:s', strtotime($data['date_recorded']))."</td>";
                                          echo "<td>".$data['heart_rate']."</td>";
                                          echo "<td>".$data['resp_rate']."</td>";
                                          echo "<td>".$data['blood_pres']."</td>";
                                          echo "<td>".$data['body_temp']."</td>";
                                          echo "<td>".$data['first_name']." ".$data['middle_name']." ".$data['last_name']."</td>";
                                        echo "</tr>";
                                      }
                                     ?>
                                   </tr>
                                 </tbody>
                             </table>
                         </section>
                     </div>
                 </section>
             </div>
          </div>
  </section>
</section>
<!--main content end-->

<!-- Modal -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Vital Sign Record</h4>
            </div>
            <div class="modal-body">
            <?php echo form_open('Patient/recordvitalsign/'.$this->uri->segment(3)); ?>
              <div class="form-group">
                <input type="text" name="heartrate" class="form-control"  placeholder="Heart Rate"><br>
                <input type="text" name="respiratoryrate" class="form-control"  placeholder="Respiratory Rate"><br>
                <input type="text" name="bloodpressure" class="form-control"  placeholder="Blood Pressure"><br>
                <input type="text" name="temperature" class="form-control"  placeholder="Body Temperature"><br>
              </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="submit">Submit</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<!-- modal -->

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

<!-- js placed at the end of the document so the pages load faster -->
<script src="<?=base_url()?>js/jquery.js"></script>
<script src="<?=base_url()?>js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?=base_url()?>js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?=base_url()?>js/jquery.scrollTo.min.js"></script>
<script src="<?=base_url()?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/jquery.sparkline.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="<?=base_url()?>js/owl.carousel.js" ></script>
<script src="<?=base_url()?>js/jquery.customSelect.min.js" ></script>
<script src="<?=base_url()?>js/respond.min.js" ></script>

<!--right slidebar-->
<script src="<?=base_url()?>js/slidebars.min.js"></script>

<!--common script for all pages-->
<script src="<?=base_url()?>js/common-scripts.js"></script>

<!--script for this page-->
<script src="<?=base_url()?>js/sparkline-chart.js"></script>
<script src="<?=base_url()?>js/easy-pie-chart.js"></script>
<script src="<?=base_url()?>js/count.js"></script>

<!--dynamic table initialization -->
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url()?>js/dynamic_table_init.js"></script>

</body>
</html>
