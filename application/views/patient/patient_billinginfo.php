<section id="main-content">
  <section class="wrapper">
      <div class="row">
          <div class="col-sm-12">
            <section class="panel" style="height: 100%;">
              <t able class="table" style="text-align: center;">
                <tr id="tblheader">
                  <td>
                  <?php
                      echo "<h4>";
                      if($patient->gender == 'M'){
                        echo "Mr. ";
                      }else{
                        echo "Ms. ";
                      }
                      echo $patient->first_name." ".$patient->middle_name." ".$patient->last_name;
                      echo "</h4>";
                    ?>
                </td>
                </tr>
              </table>
              <center>
              <table id="patient-info" class="table" style="width: 55%; text-align: left; ">
                <thead>
                  <tr>
                    <th></th>
                    <th>Price</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    echo form_open(base_url()."Patient/Pushforbilling/");
                    $total_price = 0;
                    foreach($patient_billing_rad as $data){
                      $total_price += $data['radiology_exam_price'];
                      echo "<tr>";
                        echo "<td>".$data['exam_name']."</td>";
                        echo "<td>".$data['radiology_exam_price']."</td>";
                        echo "<td>".$data['status']."</td>";
                      echo "</tr>";
                      echo "<input type='hidden' name='billing_breakdown_id[]' value='".$data['billing_breakdown_id']."' />";
                    }
                    echo "<tr>";
                      echo "<td></td>";
                      echo "<td><b>Total:</b></td>";
                      echo "<td>".$total_price."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td></td>";
                      echo "<td></td>";
                      echo "<td><button type='submit' class='btn btn-info btn-xs'>For Billing</button></td>";
                    echo "</tr>";
                    echo form_close();
                  ?>
                </tbody>
              </table>
            </section>
          </div>
      </div>
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
