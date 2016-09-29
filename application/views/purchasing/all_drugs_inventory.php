

<section id="main-content">
  <section class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
			<header style="font-weight:300" class="panel-heading">
                 Inventory List
             <span class="tools pull-right">
             </span>
             </header>
				<div class="panel-body">
                <div class="adv-table">

                <table class="table table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th style="text-align: center;">#</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Description</th>
                        <th style="text-align: center;">Stock</th>
                        <th style="text-align: center;">Price</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                    </thead>
                    <tbody align="center">
                      <?php
                      $count = 1;
                        foreach($items as $i)
                        {
                          echo '<tr>';
                          echo '<td>'.$count.'</td>';
                          echo '<td>'.$i->drug_name.'</td>';
                          echo '<td>'.$i->packaging_desc.'</td>';
                          echo '<td>'.$i->drug_quantity.'</td>';
                          echo '<td>'.$i->drug_price.'</td>';
                          echo '<td>';
                          echo "<div class='btn-group' role='group' aria-label='...'>";
                        ?>
                        <?php if($i->status == 1): ?>
                                <a href="#" class="btn btn-danger" data-href="<?php echo base_url();?>Purchasing/deactivate_drug/<?php echo $i->drug_code?>" data-toggle="modal" data-target="#confirm-deactivate">Deactivate</a></td>
                        <?php else: ?>
                          <a href="#" class="btn btn-success" data-href="<?php echo base_url();?>Purchasing/activate_drug/<?php echo $i->drug_code?>" data-toggle="modal" data-target="#confirm-activate">Activate</a></td>
                        <?php endif;?>
                        <?php
                          echo "</div>";
                          echo "</td>";
                          echo "</tr>";
                          $count++;
                        }
                      ?>
                    </tbody>
                </table>
				</div>
				</div>
            </section>
        </div>
    </div>
  </section>
</section>

<!--footer start-->
<footer class="">

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
$('#myModal').on('show.bs.modal', function(e)
{
  //get data-id attribute of the clicked element
  var updatingid = $(e.relatedTarget).data('updatingid');
  var updatingname = $(e.relatedTarget).data('updatingname');
  var updatingdescription = $(e.relatedTarget).data('updatingdescription');
  var updatingquantity = $(e.relatedTarget).data('updatingquantity');
  var updatingprice = $(e.relatedTarget).data('updatingprice');
  //populate the textbox
  $(e.currentTarget).find('input[name="itemid"]').val(updatingid);
  $(e.currentTarget).find('input[name="name"]').val(updatingname);
  $(e.currentTarget).find('input[name="description"]').val(updatingdescription);
  $(e.currentTarget).find('input[name="quantity"]').val(updatingquantity);
  $(e.currentTarget).find('input[name="price"]').val(updatingprice);
});
  </script>


    <script>
$('#confirm-deactivate').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
  </script>

  <script>
$('#confirm-activate').on('show.bs.modal', function(e) {
  $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>


<!--dynamic table initialization -->
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url()?>js/dynamic_table_init.js"></script>

</body>

<!-- Mirrored from thevectorlab.net/flatlab/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 May 2016 02:05:28 GMT -->
</html>
