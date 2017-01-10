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
                              <td><?=$billing_data->room_price?></td>
                          </tr>
                          <tr>
                              <td>Emergency Room</td>
                              <td class="hidden-phone">Emergency Room Fee</td>
                              <td><?=$billing_data->er_price?></td>
                          </tr>
                          <tr>
                              <td>Operating Room</td>
                              <td class="hidden-phone">Operating Room Fee</td>
                              <td><?=$billing_data->or_price?></td>
                          </tr>
                          <tr>
                              <td>ICU</td>
                              <td class="hidden-phone">ICU Fee</td>
                              <td><?=$billing_data->icu_price?></td>
                          </tr>
                          <tr>
                              <td>Radiology</td>
                              <td class="hidden-phone">Radiology Fee</td>
                              <td><?=$billing_data->rad_price?></td>
                          </tr>
                          <tr>
                              <td>Laboratory</td>
                              <td class="hidden-phone">Laboratory Fee</td>
                              <td><?=$billing_data->lab_price?></td>
                          </tr>
                          <tr>
                              <td>CSR</td>
                              <td class="hidden-phone">CSR Fee</td>
                              <td><?=$billing_data->csr_price?></td>
                          </tr>
                          <tr>
                              <td>Pharmacy</td>
                              <td class="hidden-phone">Pharmacy Fee</td>
                              <td><?=$billing_data->pharm_price?></td>
                          </tr>
                          <hr>
                          <tr>
                              <td>Professional Fee</td>
                              <td class="hidden-phone">Professional Fee</td>
                              <td><?=$billing_data->professional_fee?></td>
                          </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-4 invoice-block pull-right">
                            <ul class="unstyled amounts">
                                <li id="grand_total"><strong>Grand Total: </strong><?=$billing_data->total_bill?> php</li>
                            </ul>
                        </div>
                    </div>
                    <?=form_close()?>
                </div>
            </div>
        </section>
        <!-- invoice end-->
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
