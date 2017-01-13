<style>
b{color:#222;font-weight:600}
table tr td {border:0}
#patient-info tr td{border:0}
</style>
<section id="main-content">
  <section class="wrapper">
      <div class="row">
          <div class="col-sm-12">
            <section class="panel" style="height: 100%;">
              <header class="panel-heading">
                  Patient Information
              </header>
              <table class="table" style="text-align: center;">
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
                <tr>
                  <td style="border:0;width: 50%;"><b>Patient Number:</b></td>
                  <td><?=" ".$patient->patient_id?></td>
                </tr>

                <tr>
                  <td style="border:0;width: 50%;"><b>Age:</b></td>
                  <td><?=" ".$patient->age?></td>
                </tr>

                <tr>
                  <td style="border:0;width: 50%;"><b>Birthday:</b></td>
                  <td><?=" ".date('F d, Y', strtotime($patient->birthdate))?></td>
                </tr>
                <tr>
                  <td style="border:0;width: 50%;"><b>Gender:</b></td>
                  <td>
                    <?php
                     if($patient->gender == 'M'){
                       echo "Male";
                     }else{
                       echo "Female";
                     }
                    ?>
                  </td>
                </tr>

                <tr>
                  <td style="border:0;width: 50%;"><b>Mobile Number:</b></td>
                  <td><?=" ".$patient->mobile_number?></td>
                </tr>

                <tr>
                  <td style="border:0;width: 50%;"><b>Telephone Number:</b></td>
                  <td><?=" ".$patient->telephone_number?></td>
                </tr>

                <tr>
                  <td style="border:0;width: 50%;"><b>Address:</b></td>
                  <td><?=" ".$patient->present_address?></td>
                </tr>

                <tr>
                  <td style="border:0;width: 50%;"><b>Nationality:</b></td>
                  <td><?=" ".$patient->nationality?></td>
                </tr>

                <tr>
                  <td colspan="2" style="text-align:left">
                    <a href="<?=base_url()?>Patient/PatientBilling/<?=$patient->patient_id?>" role="button" class="btn btn-shadow btn-default"><i class="fa fa-money"></i> Overall Billing</a>
                    <a href="<?=base_url()?>Patient/AdmittingHistory/<?=$patient->patient_id?>" role="button" class="btn btn-shadow btn-primary"><i class="fa fa-archive"></i> Admitting History</a>
                    <a href="<?=base_url()?>Patient/VitalsHistory/<?=$patient->patient_id?>" role="button" class="btn btn-shadow btn-success"><i class="fa fa-h-square"></i> Vital Signs</a>
                    <br>
                    <br>
                    <a href="<?=base_url()?>Patient/PharmacyHistory/<?=$patient->patient_id?>" role="button" class="btn btn-shadow btn-info"><i class="fa fa-medkit"></i> Pharmacy</a>
                    <a href="<?=base_url()?>Patient/LaboratoryHistory/<?=$patient->patient_id?>" role="button" class="btn btn-shadow btn-warning"><i class="fa fa-flask"></i> Laboratory</a>
                    <a href="<?=base_url()?>Patient/RadiologyHistory/<?=$patient->patient_id?>" role="button" class="btn btn-shadow btn-danger"><i class="fa fa-stethoscope"></i> Radiology</a>
                  </td>
                </tr>
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
