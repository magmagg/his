<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading" style="background-color: #000;"></header>
                    <header class="panel-heading">
                        Return medicine
                        <form role="form" id="formfield" action="<?php echo base_url();?>Pharmacy/submit_nurse_return_medicine" method="post">
                            <input type="button" name="btn" value="Submit request" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn pull-right btn-success" />

                    </header>

                    <table class="table table-striped table-advance table-hover" id="dynamic-table">
                        <thead>
                            <tr>
                                <th>
                                    </i>#</th>
                                <th><i class="fa fa-bookmark"></i>Medicine</th>
                                <th><i class="fa fa-bookmark"></i>Quantity</th>
                                <th><i class=" fa fa-edit"></i> Price</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                              $count = 1;
                              foreach($details as $d)
                              {
                              $phar_patient = $d->phar_patient;
                              $unique_id = $d->unique_id;
                                foreach($items as $i)
                                {
                                  if($d->phar_item == $i->item_id)
                                  {
                                    $medicine = $i->item_name;
                                    $price = $i->item_price;
                                    $itemid = $i->item_id;
                                  }
                                }
                                echo '<input type="hidden" name="uniqueid" value="'.$unique_id.'">';
                                echo '<input type="hidden" name="patientid" value="'.$phar_patient.'">';
                                echo '<input type="hidden" name="itemid[]" value="'.$itemid.'">';
                                echo '<input type="hidden" name="price[]" value="'.$price.'">';
                                echo '<tr>';
                                echo '<td>'.$count.'</td>';
                                echo '<td>'.$medicine.'</td>';
                                echo '<td>'.$d->quant_requested.' Medicines'.'</td>';
                                echo '<td>'.$price.'</td>';
                                echo '<td>'.$d->total_price.'</td>';
                                echo '<td>';
                                ?>
                                <input type="number" name="quantity[]" style="width:100%" class="form-control" value="0">
                                <?php
                                echo '</td>';

                                echo '</tr>';
                                $count++;
                              }
                              ?>


                        </tbody>
                    </table>
                </form>

            </div>
            </section>
    </section>

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
<!--right slidebar-->
<script src="<?=base_url()?>js/slidebars.min.js"></script>
<!--common script for all pages-->
<script src="<?=base_url()?>js/common-scripts.js"></script>


<script>

window.onload = function(){
document.getElementById("submitme").onclick = function() {myFunction()};
};

function myFunction()
{
    document.getElementById("formfield").submit();
}
</script>

<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url()?>js/dynamic_table_init.js"></script>

</body>

<!-- Mirrored from thevectorlab.net/flatlab/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 May 2016 02:05:28 GMT -->

</html>
