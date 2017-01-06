<section id="main-content">
    <section class="wrapper">
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="<?=$patient_detail->first_name." ".$patient_detail->middle_name." ".$patient_detail->last_name?>" readonly>
            </div>
          </div>

          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label>Age</label>
              <input type="text" class="form-control" id="exampleInputPassword1" value="<?=$patient_detail->age?>" readonly>
            </div>
          </div>

          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label>Sex</label>
              <input type="text" class="form-control" id="exampleInputPassword1" value="<?=$patient_detail->gender?>" readonly>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-lg-9">
            <div class="form-group">
              <label>Address</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="<?=$patient_detail->present_address?>" readonly>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-3">
            <div class="form-group">
              <label>Doctor</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" readonly>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="form-group">
              <label>PHIC</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" readonly>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="form-group">
              <label>Room</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" readonly>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="form-group">
              <label>Day</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" readonly>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label>Type</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" readonly>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label>HMD/Comp</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="" readonly>
            </div>
          </div>

          <div class="col-lg-2">
            <div class="form-group">
              <label>Date Admitted</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="<?=date('M d, Y', strtotime($patient_detail->date_admitted))?>" readonly>
            </div>
          </div>

          <div class="col-lg-2">
            <div class="form-group">
              <label>Time</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="<?=date('h:i:s A', strtotime($patient_detail->date_admitted))?>" readonly>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label>Final Diagnosis</label>
            </div>
          </div>

          <div class="col-lg-2 col-lg-offset-4">
            <div class="form-group">
              <label>Date Discharge</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="<?=date('M d, Y')?>" readonly>
            </div>
          </div>

          <div class="col-lg-2">
            <div class="form-group">
              <label>Time</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="<?=date('h:i:s A')?>" readonly>
            </div>
          </div>
        </div>
        </div>

        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
    <!--==========================================================================================================================================================-->
    <!--Horizontal = AMOUNT, RETURNS, TOTAL, SC/PWD DISC, PHIC, C/O HMO, OTHER DISC, NET TOTAL
    Vertical = ADMITTING, PHARMACY, R/B ACCOMODATION, LABORATORY, ER, PULMONARY, RADIOLOGY, OPERATING ROOM, CSR, NURSE STATION, ICU, NICU, PT REHAB, DIALYSIS, BILLING, HEART STATION, OTHERS-->
        <?php
          $overall_amount = 0;
        ?>
        <?php
          $attributes = array('class'=>'form-horizontal', 'role'=>'form');
          echo form_open('Billing/submit_to_cashier', $attributes);
        ?>
        <input type="hidden" name="patient_id" value="<?=$patient_detail->patient_id?>"
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
            <label>Room</label>
          </div>
          <div class="col-lg-1">
            <label>
            <?php
                $total_price = 0;
                $room_data_1 = array();
                $room_data_2 = "";
                if(!empty($directroom_bill)){
                  foreach($directroom_bill as $bill){
                    $total_price += $bill['price'];
                    array_push($room_data_1, $bill['bed_bill_id']);
                    $room_data_2 = implode(',', $room_data_1);
                  }
                  $overall_amount += $total_price;
                }

                if($total_price != 0){
                  echo $total_price;
                }
            ?>
            <input type="hidden" name="room_data" value="<?=$room_data_2?>">
            </label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label>
            <?php
              if($total_price != 0){
                echo $total_price;
              }
            ?>
            </label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label>
              <?php
                if($total_price != 0){
                  echo $total_price;
                }
              ?>
            </label>
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
              $total_price = 0;
              $lab_data_1 = array();
              $lab_data_2 = "";
                if(!empty($laboratory_bill)){
                  foreach($laboratory_bill as $bill){
                    $total_price += $bill['price'];
                    array_push($lab_data_1, $bill['lab_bill_id']);
                    $lab_data_2 = implode(',', $lab_data_1);
                  }
                  $overall_amount += $total_price;
                }
                if($total_price != 0){
                    echo $total_price;
                }
              ?>
              <input type="hidden" name="lab_data" value="<?=$lab_data_2?>">
            </label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label>
            <?php
            if($total_price != 0){
                echo $total_price;
            }
            ?>
            </label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label>
              <?php
              if($total_price != 0){
                  echo $total_price;
              }
              ?>
            </label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2">
            <label>EMERGENCY ROOM</label>
          </div>
          <div class="col-lg-1">
            <label>
            <?php
                $total_price = 0;
                $er_data_1 = array();
                $er_data_2 = "";
                if(!empty($emergencyroom_bill)){
                  foreach($emergencyroom_bill as $bill){
                    $total_price += $bill['price'];
                    array_push($er_data_1, $bill['bed_bill_id']);
                    $er_data_2 = implode(',', $er_data_1);
                  }
                  $overall_amount += $total_price;
                }

                if($total_price != 0){
                  echo $total_price;
                }
            ?>
            <input type="hidden" name="er_data" value="<?=$er_data_2?>">
            </label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label>
              <?php
              if($total_price != 0){
                  echo $total_price;
              }
              ?>
            </label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label>
              <?php
              if($total_price != 0){
                  echo $total_price;
              }
              ?>
            </label>
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
                $rad_data_1 = array();
                $rad_data_2 = "";
                if(!empty($radiology_bill)){
                  foreach($radiology_bill as $bill){
                    $total_price += $bill['price'];
                    array_push($rad_data_1, $bill['rad_bill_id']);
                    $rad_data_2 = implode(',', $rad_data_1);
                  }
                  $overall_amount += $total_price;
                }
                if($total_price != 0){
                    echo $total_price;
                }
              ?>
              <input type="hidden" name="rad_data" value="<?=$rad_data_2?>">
            </label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label>
              <?php
              if($total_price != 0){
                  echo $total_price;
              }
              ?>
            </label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label>
              <?php
              if($total_price != 0){
                  echo $total_price;
              }
              ?>
            </label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2">
            <label>OPERATING ROOM</label>
          </div>
          <div class="col-lg-1">
            <label>
            <?php
                $total_price = 0;
                $or_data_1 = array();
                $or_data_2 = "";
                if(!empty($operatingroom_bill)){
                  foreach($operatingroom_bill as $bill){
                    $total_price += $bill['price'];
                    array_push($or_data_1, $bill['bed_bill_id']);
                    $or_data_2 = implode(',', $or_data_1);
                  }
                  $overall_amount += $total_price;
                }
                if($total_price != 0){
                    echo $total_price;
                }
            ?>
            <input type="hidden" name="or_data" value="<?=$or_data_2?>">
            </label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label>
              <?php
              if($total_price != 0){
                  echo $total_price;
              }
              ?>
            </label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label>
              <?php
              if($total_price != 0){
                  echo $total_price;
              }
              ?>
            </label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2">
            <label>CENTRAL SUPPLY ROOM</label>
          </div>
          <div class="col-lg-1">
            <label>
                <?php
                    $total_price = 0;
                    $csr_data_1 = array();
                    $csr_data_2 = "";
                    if(!empty($csr_bill)){
                      foreach($csr_bill as $bill){
                        $total_price += $bill['price'];
                        array_push($csr_data_1, $bill['csr_bill_id']);
                        $csr_data_2 = implode(',', $csr_data_1);
                      }
                      $overall_amount += $total_price;
                    }
                    if($total_price != 0){
                        echo $total_price;
                    }
                ?>
            <input type="hidden" name="csr_data" value="<?=$csr_data_2?>">
            </label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label>
              <?php
              if($total_price != 0){
                  echo $total_price;
              }
              ?>
            </label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label>
              <?php
              if($total_price != 0){
                  echo $total_price;
              }
              ?>
            </label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2">
            <label>ICU</label>
          </div>
          <div class="col-lg-1">
            <label>
                <?php
                    $total_price = 0;
                    $icu_data_1 = array();
                    $icu_data_2 = "";
                    if(!empty($icu_bill)){
                      foreach($icu_bill as $bill){
                        $total_price += $bill['price'];
                        array_push($icu_data_1, $bill['bed_bill_id']);
                        $icu_data_2 = implode(',', $icu_data_1);
                      }
                      $overall_amount += $total_price;
                    }
                    if($total_price != 0){
                        echo $total_price;
                    }
                ?>
            <input type="hidden" name="icu_data" value="<?=$icu_data_2?>">
            </label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label>
              <?php
              if($total_price != 0){
                  echo $total_price;
              }
              ?>
            </label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label>
              <?php
              if($total_price != 0){
                  echo $total_price;
              }
              ?>
            </label>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-2">
            <label>TOTAL</label>
          </div>
          <div class="col-lg-1">
            <label>
              <?php
              if($overall_amount != 0){
                  echo $overall_amount;
              }
              ?>
            </label>
          </div>
          <div class="col-lg-1">
            <label></label>
          </div>
          <div class="col-lg-1">
            <label>
              <?php
              if($overall_amount != 0){
                  echo $overall_amount;
              }
              ?>
            </label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label></label>
          </div><div class="col-lg-1">
            <label>
              <?php
              if($overall_amount != 0){
                  echo $overall_amount;
              }
              ?>
            </label>
          </div>
        </div>

        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

        <div class="row">
          <div class="col-lg-2">
            <label>PROFESSIONAL FEE</label>
          </div>
          <div class="col-lg-8">
            <label id="prof_fee"></label>
            <input type="hidden" id="prof_fee_input" name="prof_fee">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-2">
            <a role="button" class="btn btn-info btn-xs" onclick="input_pf_modal()">Input Fee</a>
          </div>
        </div>

        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

        <div class="row">
          <div class="col-lg-2">
            <label>OVERALL TOTAL</label>
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
          </div><div class="col-lg-2">
            <label>
              <?php
              if($overall_amount != 0){
                  //echo $overall_amount;
              }
              ?>
              <input type="text" id="overall_amount" name="overall_amount" class="form-control" readonly>
            </label>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-12">
            <label>
              <?php
              if($overall_amount != 0){
                  //echo $overall_amount;
              }
              ?>
              <button class="btn btn-success btn-xs">Submit to cashier</button>
            </label>
          </div>
        </div>
      <?=form_close()?>
    </section>
</section>
<script>
  function input_pf_modal(){
    $("#input_pf").modal();
  }

  function submit_by_id() {
    var pf_amount = document.getElementById("inputted_pf").value;
    var overall_amount = <?=$overall_amount?>;
    document.getElementById("prof_fee_input").value = pf_amount;
    $("#prof_fee").html(pf_amount);
    document.getElementById("overall_amount").value = +overall_amount + +pf_amount;
    $("#input_pf").modal('hide');
  }
</script>
<!-- js placed at the end of the document so the pages load faster -->
<script src="<?=base_url()?>js/jquery.js"></script>
<script>
  $(document).ready(function(){
    document.getElementById("overall_amount").value = <?=$overall_amount?>;
    //alert(document.getElementById("overall_amount").value);
  });
</script>
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
