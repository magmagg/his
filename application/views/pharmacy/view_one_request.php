<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading" style="background-color: #000;"></header>
                    <header class="panel-heading">
                        Pharmacy requests
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
                    <?php $ctr = 1; ?>
                    <?php foreach($details as $d): ?>
                    <?php if($d->phar_stat == 0):?>
                        <?php if($ctr == 1): ?>
                    <center>
                        <button class="btn btn-success btn" data-href="<?php echo base_url();?>Pharmacy/accept_pharmacy_request/<?php echo $id?>" data-toggle="modal" data-target="#confirm-accept"><i class="fa fa-check"></i></button>
                        <button class="btn btn-danger btn" data-href="<?php echo base_url();?>Pharmacy/reject_pharmacy_request/<?php echo $id?>" data-toggle="modal" data-target="#confirm-reject"><i class="fa fa-ban"></i></button>
                    </center>
                    <?php $ctr++; ?>
                <?php endif; ?>
                        <?php endif;?>
                    <?php endforeach; ?>

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

<script type="text/javascript">
    $('#confirm-accept').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

<script type="text/javascript">
    $('#confirm-reject').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>


</body>

<!-- Mirrored from thevectorlab.net/flatlab/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 May 2016 02:05:28 GMT -->

</html>
