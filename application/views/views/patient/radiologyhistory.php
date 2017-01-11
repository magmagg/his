<section id="main-content">
    <section class="wrapper">
                <div class="row">
             <div class="col-lg-12">
                 <section class="panel">
                     <header class="panel-heading">
                        <center><?php echo $this->uri->segment(3);?> Radiology History</center>
                     </header>
                     <div class="panel-body">
                         <section id="flip-scroll">
                             <table class="table table-bordered table-striped table-condensed cf">
                                 <thead class="cf">
                                 <tr>
                                   <th>ID</th>
                                   <th>Date of Request</th>
                                   <th>Radiology Exam</th>
                                   <th>Request Note</th>
                                   <th>Status</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                  <?php
                                    foreach($radiology_data as $data){
                                      echo "<tr>";
                                        echo "<td>".$data['request_id']."</td>";
                                        echo "<td>".$data['request_date']."</td>";
                                        echo "<td>".$data['exam_name']."</td>";
                                        echo "<td>".$data['req_notes']."</td>";
                                        echo "<td>";
                                        if($data['request_status'] == 0){
                                            echo "<span class='label label-info'>PENDING</span>";
                                        }elseif($data['request_status'] == 1){
                                            echo "<span class='label label-success'>APPROVED</span>";
                                        }elseif($data['request_status'] == 2){
                                            echo "<span class='label label-danger'>DECLINED</span>";
                                        }else{
                                            echo "<span class='label label-success'>DONE</span>";
                                        }
                                        echo "</td>";
                                      echo "</tr>";
                                    }
                                  ?>
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
