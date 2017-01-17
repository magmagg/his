<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading" style="background-color: #000;"></header>
                    <header class="panel-heading">
                        Pharmacy requests
                        <?php if($released == 1): ?>
                            <a href="<?php echo base_url();?>Pharmacy/nurse_return_medicine/<?=$id?>"><button class="btn btn-success pull-right btn">Return Medicine</button></a>
                        <?php endif; ?>
                    </header>

                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th>
                                    </i>#</th>
                                <th><i class="fa fa-bookmark"></i>Medicine</th>
                                <th><i class="fa fa-bookmark"></i>Quantity</th>
                                <th><i class=" fa fa-edit"></i> Price</th>
                                <th><i class=" fa fa-edit"></i> Total price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                              $count = 1;
                              foreach($details as $d)
                              {
                                foreach($items as $i)
                                {
                                  if($d->phar_item == $i->item_id)
                                  {
                                    $medicine = $i->item_name;
                                    $price = $i->item_price;
                                  }
                                }
                                echo '<tr>';
                                echo '<td>'.$count.'</td>';
                                echo '<td>'.$medicine.'</td>';
                                echo '<td>'.$d->quant_requested.' Medicines'.'</td>';
                                echo '<td>'.$price.'</td>';
                                echo '<td>'.$d->total_price.'</td>';

                                echo '</tr>';

                              }
                              ?>


                        </tbody>
                    </table>


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


</body>

<!-- Mirrored from thevectorlab.net/flatlab/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 May 2016 02:05:28 GMT -->

</html>
