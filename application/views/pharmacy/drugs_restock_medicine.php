<section id="main-content">
  <section class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading" style="background-color: #000;"></header>
              <header class="panel-heading">
                  <center><h4>Restock Medicine<h4></center>
              </header>

                <form role="form" id="formfield" action="<?php echo base_url();?>Pharmacy/drug_restock_medicine_submit" method="post">
                <input type="button" name="btn" value="Submit request" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-success" />

              <table class="table table-striped">
                  <thead>
                  <tr>
                      <th style="text-align: center;">#</th>
                      <th style="text-align: center;">Name</th>
                      <th style="text-align: center;">Description</th>
                      <th style="text-align: center;">Stock</th>
                      <th style="text-align: center;">Order quantity</th>
                  </tr>
                  </thead>
                  <tbody align="center">
                    <?php
                    $count = 0;
                      foreach($items as $i)
                      {
                        echo '<input type="hidden" name="itemid[]" value="'.$i->drug_code.'">';
                        echo '<tr>';
                        echo '<td>'.$count.'</td>';
                        echo '<td>'.$i->drug_name.'</td>';
                        echo '<td>'.$i->packaging_desc.'</td>';
                        echo '<td>'.$i->drug_quantity.'</td>';
                        echo '<td>';
                        echo '<input type="number" name="quantity[]" style="width:100%" class="form-control" value="0">';
                        echo '</td>';
                        echo "</tr>";
                        $count++;
                      }

                      echo '<input type="hidden" name="count" value="'.$count.'">';
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



</body>

<!-- Mirrored from thevectorlab.net/flatlab/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 May 2016 02:05:28 GMT -->
</html>
