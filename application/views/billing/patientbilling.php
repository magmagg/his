<section id="main-content">
    <section class="wrapper">
        <!-- invoice start-->
        <section>
            <div class="panel panel-primary">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div class="panel-body">
                    <div class="row invoice-list">
                        <div class="text-center corporate-id">
                          <h4><b><?=$patient_detail->first_name." ".$patient_detail->middle_name." ".$patient_detail->last_name?></b></h4>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <p>Age: <b><?=$patient_detail->age?></b></p>
                            <p>Gender: <b><?=$patient_detail->gender?></b></p>
                            <p>Address: <b><?=$patient_detail->present_address?></b></p>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <p>Doctor: </p>
                            <p>PHIC: </p>
                            <p>HMD/Comp: </p>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                          <p>Date Admitted: <b><?=date('M d, Y - h:i A', strtotime($patient_detail->date_admitted))?></b></p>
                        </div>
                    </div>
                    <?php
                      $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                      echo form_open('Billing/submit_to_cashier', $attributes);
                      $overall_amount = 0;
                    ?>
                    <input type="hidden" name="patient_id" value="<?=$patient_detail->patient_id?>">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Item</th>
                            <th class="hidden-phone">Description</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td>Room</td>
                              <td class="hidden-phone">Room Fee</td>
                              <td>
                                <?php
                                    $total_room_price = 0;
                                    $room_data_1 = array();
                                    $room_data_2 = "";
                                    if(!empty($directroom_bill)){
                                      foreach($directroom_bill as $bill){
                                        $total_room_price += $bill['price'];
                                        array_push($room_data_1, $bill['bed_bill_id']);
                                        $room_data_2 = implode(',', $room_data_1);
                                      }
                                      $overall_amount += $total_room_price;
                                    }

                                    if($total_room_price != 0){
                                      echo $total_room_price;
                                    }
                                ?>
                                <input type='hidden' name='total_room_price' value='<?=$total_room_price?>'>
                                <input type="hidden" name="room_data" value="<?=$room_data_2?>">
                              </td>
                          </tr>
                          <tr>
                              <td>Emergency Room</td>
                              <td class="hidden-phone">Emergency Room Fee</td>
                              <td>
                                <?php
                                    $total_er_price = 0;
                                    $er_data_1 = array();
                                    $er_data_2 = "";
                                    if(!empty($emergencyroom_bill)){
                                      foreach($emergencyroom_bill as $bill){
                                        $total_er_price += $bill['price'];
                                        array_push($er_data_1, $bill['bed_bill_id']);
                                        $er_data_2 = implode(',', $er_data_1);
                                      }
                                      $overall_amount += $total_er_price;
                                    }

                                    if($total_er_price != 0){
                                      echo $total_er_price;
                                    }
                                ?>                                
                                <input type='hidden' name='total_er_price' value='<?=$total_er_price?>'>
                                <input type="hidden" name="er_data" value="<?=$er_data_2?>">
                              </td>
                          </tr>
                          <tr>
                              <td>Operating Room</td>
                              <td class="hidden-phone">Operating Room Fee</td>
                              <td>
                                <?php
                                    $total_or_price = 0;
                                    $or_data_1 = array();
                                    $or_data_2 = "";
                                    if(!empty($operatingroom_bill)){
                                      foreach($operatingroom_bill as $bill){
                                        $total_or_price += $bill['price'];
                                        array_push($or_data_1, $bill['bed_bill_id']);
                                        $or_data_2 = implode(',', $or_data_1);
                                      }
                                      $overall_amount += $total_or_price;
                                    }
                                    if($total_or_price != 0){
                                        echo $total_or_price;
                                    }
                                ?>
                                <input type='hidden' name='total_or_price' value='<?=$total_or_price?>'>
                                <input type="hidden" name="or_data" value="<?=$or_data_2?>">
                              </td>
                          </tr>
                          <tr>
                              <td>ICU</td>
                              <td class="hidden-phone">ICU Fee</td>
                              <td>
                                <?php
                                    $total_icu_price = 0;
                                    $icu_data_1 = array();
                                    $icu_data_2 = "";
                                    if(!empty($icu_bill)){
                                      foreach($icu_bill as $bill){
                                        $total_icu_price += $bill['price'];
                                        array_push($icu_data_1, $bill['bed_bill_id']);
                                        $icu_data_2 = implode(',', $icu_data_1);
                                      }
                                      $overall_amount += $total_icu_price;
                                    }
                                    if($total_icu_price != 0){
                                        echo $total_icu_price;
                                    }
                                ?>
                                <input type='hidden' name='total_icu_price' value='<?=$total_icu_price?>'>
                                <input type="hidden" name="icu_data" value="<?=$icu_data_2?>">
                              </td>
                          </tr>
                          <tr>
                              <td>Laboratory</td>
                              <td class="hidden-phone">Laboratory Fee</td>
                              <td>
                                <?php
                                $total_lab_price = 0;
                                $lab_data_1 = array();
                                $lab_data_2 = "";
                                  if(!empty($laboratory_bill)){
                                    foreach($laboratory_bill as $bill){
                                      $total_lab_price += $bill['price'];
                                      array_push($lab_data_1, $bill['lab_bill_id']);
                                      $lab_data_2 = implode(',', $lab_data_1);
                                    }
                                    $overall_amount += $total_lab_price;
                                  }
                                  if($total_lab_price != 0){
                                      echo $total_lab_price;
                                  }
                                ?>
                                <input type='hidden' name='total_lab_price' value='<?=$total_lab_price?>'>
                                <input type="hidden" name="lab_data" value="<?=$lab_data_2?>">
                              </td>
                          </tr>
                          <tr>
                              <td>Radiology</td>
                              <td class="hidden-phone">Radiology Fee</td>
                              <td>
                              <?php
                                $total_rad_price = 0;
                                $rad_data_1 = array();
                                $rad_data_2 = "";
                                if(!empty($radiology_bill)){
                                  foreach($radiology_bill as $bill){
                                    $total_rad_price += $bill['price'];
                                    array_push($rad_data_1, $bill['rad_bill_id']);
                                    $rad_data_2 = implode(',', $rad_data_1);
                                  }
                                  $overall_amount += $total_rad_price;
                                }
                                if($total_rad_price != 0){
                                    echo $total_rad_price;
                                }
                              ?>
                              <input type='hidden' name='total_rad_price' value='<?=$total_rad_price?>'>
                              <input type="hidden" name="rad_data" value="<?=$rad_data_2?>">
                              </td>
                          </tr>
                          <tr>
                              <td>CSR</td>
                              <td class="hidden-phone">CSR Fee</td>
                              <td>
                                <?php
                                    $total_csr_price = 0;
                                    $csr_data_1 = array();
                                    $csr_data_2 = "";
                                    if(!empty($csr_bill)){
                                      foreach($csr_bill as $bill){
                                        $total_csr_price += $bill['price'];
                                        array_push($csr_data_1, $bill['csr_bill_id']);
                                        $csr_data_2 = implode(',', $csr_data_1);
                                      }
                                      $overall_amount += $total_csr_price;
                                    }
                                    if($total_csr_price != 0){
                                        echo $total_csr_price;
                                    }
                                ?>
                            <input type='hidden' name='total_csr_price' value='<?=$total_csr_price?>'>
                            <input type="hidden" name="csr_data" value="<?=$csr_data_2?>">
                              </td>
                          </tr>
                          <tr>
                              <td>Pharmacy</td>
                              <td class="hidden-phone">Pharmacy Fee</td>
                              <td>

                              </td>
                          </tr>
                          <hr>
                          <tr>
                              <td>Professional Fee</td>
                              <td class="hidden-phone">Professional Fee</td>
                              <td id="prof_fee">
                              </td>
                              <input type="hidden" id="prof_fee_input" name="prof_fee">
                          </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-4 invoice-block pull-right">
                            <ul class="unstyled amounts">
                                <li id="grand_total"><strong>Grand Total: </strong><?=" ".$overall_amount?> php</li>
                                <input type="hidden" id="overall_amount" name="overall_amount" class="form-control" readonly>
                            </ul>
                        </div>
                    </div>
                    <div class="text-center invoice-btn">
                        <a onclick="input_pf_modal()" class="btn btn-success btn-lg"><i class="fa fa-address-card" aria-hidden="true"></i> Input Professional Fee</a>
                        <button type="submit" class="btn btn-danger btn-lg"><i class="fa fa-check"></i> Submit Billing </button>
                    </div>
                    <?=form_close()?>
                </div>
            </div>
        </section>
        <!-- invoice end-->
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
    var new_grand_total = +overall_amount + +pf_amount;
    $("#grand_total").html("<strong>Grand Total: </strong>"+new_grand_total+" php</li>");
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
