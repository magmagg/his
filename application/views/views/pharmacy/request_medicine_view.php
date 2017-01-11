

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
             <form role="form" id="formfield" action="<?php echo base_url();?>Pharmacy/request_medicine_submit" method="post">
             <input type="button" name="btn" value="Submit request" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-success" />

				<div class="panel-body">
                <div class="adv-table">

                <table class="table table-striped" id="dynamic-table" style="width:100%">
                    <thead>
                    <tr>
                        <th style="text-align: center;">#</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Description</th>
                        <th style="text-align: center;">Request</th>
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
                          echo '<td>';
                          ?>
                          <input type="checkbox" name="itemids[]" value="<?=$i->drug_code?>">
                          <?php
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
          </form>
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

window.onload = function(){
document.getElementById("submitme").onclick = function() {myFunction()};
};

function myFunction()
{
    document.getElementById("formfield").submit();
}
</script>



<!--dynamic table initialization -->
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url()?>js/dynamic_table_init.js"></script>

</body>

<!-- Mirrored from thevectorlab.net/flatlab/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 May 2016 02:05:28 GMT -->
</html>
