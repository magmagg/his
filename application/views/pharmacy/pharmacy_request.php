<section id="main-content">
  <section class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading" style="background-color: #000;"></header>
              <header class="panel-heading">
                  <center><h4>PHARMACY REQUEST<h4></center>
              </header>

                <form role="form" id="formfield" action="<?php echo base_url();?>Pharmacy/pharmacy_request_submit" method="post">
                <input type="button" name="btn" value="Submit request" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-success" />

                <center>
                <div class="form-group" style="width:50%">
                <label for="sel1">For patient:</label>
                <select class="form-control" name="patientid">
                  <?php foreach($patient as $p)
                  {
                    echo '<option value="'.$p->patient_id.'">'.$p->patient_id.' '.$p->last_name.' '.$p->first_name.' '.$p->middle_name.'</option>';
                  }
                  ?>
                </select>
              </div>
            </center>

              <table class="table table-striped">
                  <thead>
                  <tr>
                      <th style="text-align: center;">#</th>
                      <th style="text-align: center;">Name</th>
                      <th style="text-align: center;">Description</th>
                      <th style="text-align: center;">Stock</th>
                      <th style="text-align: center;">Price</th>
                      <th style="text-align: center;">Order quantity</th>
                  </tr>
                  </thead>
                  <tbody align="center">
                    <?php
                    $count = 0;
                      foreach($items as $i)
                      {
                        $selectquantity = $i->item_quantity;
                        echo '<input type="hidden" name="itemid[]" value="'.$i->item_id.'">';
                        echo '<input type="hidden" name="price[]" value="'.$i->item_price.'">';
                        echo '<tr>';
                        echo '<td>'.$count.'</td>';
                        echo '<td>'.$i->item_name.'</td>';
                        echo '<td>'.$i->item_description.'</td>';
                        echo '<td>'.$i->item_quantity.'</td>';
                        echo '<td>'.$i->item_price.'</td>';
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
