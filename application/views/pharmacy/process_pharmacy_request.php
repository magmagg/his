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
                                  <th></i>#</th>
                                  <th><i class="fa fa-bookmark"></i>Total Price</th>
                                  <th><i class="fa fa-bookmark"></i>Total Quantity</th>
                                  <th><i class=" fa fa-edit"></i> Date</th>
                                  <th><i class=" fa fa-edit"></i> Requested by</th>
                                  <th><i class=" fa fa-edit"></i> For patient</th>
                                  <th><i class=" fa fa-edit"></i> Status</th>
                                  <th><i class=" fa fa-edit"></i> View</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>

                              <?php
                              $count = 1;
                              foreach($table_details as $t)
                              {
                                echo '<tr>';
                                echo '<td>'.$count.'</td>';
                                echo '<td>'.$t['price'].'</td>';
                                echo '<td>'.$t['quantity'].' Medicines'.'</td>';
                                echo '<td>'.$t['date'].'</td>';
                                echo '<td>'.$t['requestedby'].'</td>';
                                echo '<td>'.$t['patient'].'</td>';
                                if($t['status'] == 0)
                                {
                                  echo '<td><span class="label label-info label-mini">Due</span></td>';
                                }
                                else if ($t['status'] == 1)
                                {
                                  echo '<td><span class="label label-success label-mini">OK</span></td>';
                                }
                                else
                                {
                                    echo '<td><span class="label label-danger label-mini">Rejected</span></td>';
                                }
                                echo '<td>';
                                ?>
                                  <a href="<?php echo base_url();?>pharmacy/view_one_request/<?php echo $t['unique_id']?>" class="btn btn-danger">View</a>
                                  <?php
                                echo '</td>';
                                $count++;

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
