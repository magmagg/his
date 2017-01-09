<section id="main-content">
    <section class="wrapper">
        <!-- invoice start-->
        <section>
            <div class="panel panel-primary">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div class="panel-body">
                    <div class="row invoice-list">
                        <div class="text-center corporate-id">
                          <h4><b><?=$billing_detail->first_name." ".$billing_detail->middle_name." ".$billing_detail->last_name?></b></h4>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <p>Age: <b><?=$billing_detail->age?></b></p>
                            <p>Gender: <b><?=$billing_detail->gender?></b></p>
                            <p>Address: <b><?=$billing_detail->present_address?></b></p>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <p>Doctor: </p>
                            <p>PHIC: </p>
                            <p>HMD/Comp: </p>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                          <p><b><?=$billing_detail->transaction_id?></b></p>
                          <p>Date Admitted: <b><?=date('M d, Y - h:i A', strtotime($billing_detail->date_admitted))?></b></p>
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
                              <td>Hospital Fee</td>
                              <td class="hidden-phone">Hospital Fee</td>
                              <td><?=$billing_detail->total_bill - $billing_detail->professional_fee?></td>
                          </tr>
                          
                          <tr>
                              <td>Professional Fee</td>
                              <td class="hidden-phone">Professional Fee</td>
                              <td><?=$billing_detail->professional_fee?></td>
                          </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-4 invoice-block pull-right">
                            <ul class="unstyled amounts">
                                <li>Grand Total: <?=$billing_detail->total_bill?> php</li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-center invoice-btn">
                        <a href="<?=base_url()?>Billing/mark_as_paid/<?=$billing_detail->transaction_id?>" class="btn btn-success btn-lg"><i class="fa fa-check"></i> Mark as paid </a>
                    </div>
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
