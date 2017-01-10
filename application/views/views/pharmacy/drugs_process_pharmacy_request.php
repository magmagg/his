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

                              <?php $count = 1; ?>
                              <?php foreach($table_details as $t): ?>

                              <tr>
                                <td><?=$count?></td>
                                <td><?=$t['price']?></td>
                                <td><?=$t['quantity']?></td>
                                <td><?=$t['date']?></td>
                                <td><?=$t['requestedby']?></td>
                                <td><?=$t['patient']?></td>

                              <?php if($t['status'] == 0):?>
                              <td><span class="label label-info label-mini">Due</span></td>
                              <?php elseif($t['status'] == 1):?>
                              <td><span class="label label-danger label-mini">For releasing</span></td>
                              <?php elseif($t['status'] == 2):?>
                              <td><span class="label label-success label-mini">Released</span></td>
                              <?php else: ?>
                              <td><span class="label label-danger label-mini">Rejected</span></td>
                              <?php endif;?>

                              <?php if($t['status'] == 1):?>
                              <td><button class="btn btn-success btn" data-href="<?php echo base_url();?>pharmacy/drug_release_pharmacy_request/<?php echo $t['unique_id']?>" data-toggle="modal" data-target="#confirm-release">Release</button></td>
                              <?php else: ?>
                              <td><a href="<?php echo base_url();?>pharmacy/drug_view_one_request/<?php echo $t['unique_id']?>" class="btn btn-danger">View</a></td>
                              <?php endif;?>

                              <?php $count++; ?>
                              <?php endforeach;?>

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
    $('#confirm-release').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

    });
</script>



</body>

<!-- Mirrored from thevectorlab.net/flatlab/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 May 2016 02:05:28 GMT -->
</html>
