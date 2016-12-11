<section id="main-content">
    <section class="wrapper">
      <form>
        <div class="row">

          <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="<?=$patient_detail->first_name." ".$patient_detail->middle_name." ".$patient_detail->last_name?>" disabled>
            </div>
          </div>

          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label>Age</label>
              <input type="text" class="form-control" id="exampleInputPassword1" value="<?=$patient_detail->age?>" disabled>
            </div>
          </div>

          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label>Sex</label>
              <input type="text" class="form-control" id="exampleInputPassword1" value="<?=$patient_detail->gender?>" disabled>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-lg-9">
            <div class="form-group">
              <label>Address</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="<?=$patient_detail->present_address?>" disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-3">
            <div class="form-group">
              <label>Doctor</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" disabled>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="form-group">
              <label>PHIC</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" disabled>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="form-group">
              <label>Room</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" disabled>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="form-group">
              <label>Day</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label>Type</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" disabled>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label>HMD/Comp</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" disabled>
            </div>
          </div>

          <div class="col-lg-2">
            <div class="form-group">
              <label>Date Admitted</label>
              <?php
                if(!empty($admitting_detail)){
                  $admission_date = date('F d, Y', strtotime($admitting_detail->admission_date));
                }else{
                  $admission_date = "";
                }
              ?>
              <input type="text" class="form-control" id="exampleInputEmail1" value="<?=$admission_date?>" disabled>
            </div>
          </div>

          <div class="col-lg-2">
            <div class="form-group">
              <label>Time</label>
              <?php
                if(!empty($admitting_detail)){
                  $admission_time = date('h:i:s', strtotime($admitting_detail->admission_date));
                }else{
                  $admission_time = "";
                }
              ?>
              <input type="text" class="form-control" id="exampleInputEmail1" value="<?=$admission_time?>" disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label>Final Diagnosis</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" disabled>
            </div>
          </div>

          <div class="col-lg-2 col-lg-offset-4">
            <div class="form-group">
              <label>Date Discharge</label>

              <input type="text" class="form-control" id="exampleInputEmail1" value="" disabled>
            </div>
          </div>

          <div class="col-lg-2">
            <div class="form-group">
              <label>Time</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" disabled>
            </div>
          </div>
        </div>
        </div>

        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
    <!--==========================================================================================================================================================-->
    <!--Horizontal = AMOUNT, RETURNS, TOTAL, SC/PWD DISC, PHIC, C/O HMO, OTHER DISC, NET TOTAL
    Vertical = ADMITTING, PHARMACY, R/B ACCOMODATION, LABORATORY, ER, PULMONARY, RADIOLOGY, OPERATING ROOM, CSR, NURSE STATION, ICU, NICU, PT REHAB, DIALYSIS, BILLING, HEART STATION, OTHERS-->
        <div class="row">
          <div class="col-lg-12 text-center">
            <label>HOSPITAL BILL</label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-1 col-lg-offset-2">
            <label>AMOUNT</label>
          </div>
          <div class="col-lg-1">
            <label>RETURNS</label>
          </div>
          <div class="col-lg-1">
            <label>TOTAL</label>
          </div><div class="col-lg-1">
            <label>SC/PWD DISC</label>
          </div><div class="col-lg-1">
            <label>PHIC</label>
          </div><div class="col-lg-1">
            <label>C/O HMO</label>
          </div><div class="col-lg-1">
            <label>OTHER DISC</label>
          </div><div class="col-lg-1">
            <label>NET TOTAL</label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2">
            <label>ADMITTING</label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2">
            <label>PHARMACY</label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2">
            <label>LABORATORY</label>
          </div>
          <div class="col-lg-1">
            <label>
              <?php
              if(!empty($laboratory_bill)){
                echo $laboratory_bill->price;
              }
              ?>
            </label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2">
            <label>EMERGENCY ROOM</label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div>
        </div>

                <div class="row">
          <div class="col-lg-2">
            <label>RADIOLOGY</label>
          </div>
          <div class="col-lg-1">
            <label>
              <?php
                $total_price = 0;
                if(!empty($radiology_bill)){
                  foreach($radiology_bill as $bill){
                    $total_price += $bill['price'];
                  }
                }
                echo $total_price;
              ?>
            </label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2">
            <label>OPERATING ROOM</label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2">
            <label>CENTRAL SUPPLY ROOM</label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2">
            <label>ICU</label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2">
            <label>OTHERS</label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div>
        </div>

        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

        <div class="row">
          <div class="col-lg-12 text-center">
            <label>PROFESSIONAL FEE</label>
          </div>
        </div>
      </form>
    </section>
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
