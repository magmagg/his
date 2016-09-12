<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-16">
        <header class="panel-heading">
			<center><h4 style="font-size: 30px;font-weight:300">Laboratory Request #<?=$requestno?><h4></center>
        </header>
      </div>
	  <div class="row" style="padding-left:10px; padding-right: 10px">
        <div class="col-sm-4">
            <section class="panel">
             
                <header class="panel-heading">
					Patient Details
                </header>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td style="text-align: left; padding-left:50px"><b>Name:</b> &ensp;<?php echo $laboratorytopatient->first_name." ".$laboratorytopatient->last_name; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; padding-left:50px"><b>Address:</b> &ensp;<?php echo $laboratorytopatient->present_address; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;padding-left:50px"><b>Number:</b> &ensp;<?php echo $laboratorytopatient->mobile_number." / ".$laboratorytopatient->telephone_number; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;padding-left:50px"><b>Date of Birth:</b> &ensp;<?php echo $laboratorytopatient->birthdate; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;padding-left:50px"><b>Gender:</b> &ensp;<?php echo $laboratorytopatient->gender ?></td>
                    </tr>
                    </thead>
                    <tbody align="center">

                    </tbody>
                </table>
            </section>
        </div>
        <div class="col-sm-4">
            <section class="panel">
                
                <header class="panel-heading">
                    Requester Details
                </header>
                <table class="table table-striped">
                    <thead>
                      <tr>
                          <td style="text-align: left;padding-left:50px"><b>Name:</b> &ensp;<?php echo $laboratorytouser->first_name." ".$laboratorytouser->last_name; ?></td>
                      </tr>
                      <tr>
                          <td style="text-align: left;padding-left:50px"><b>Email:</b> &ensp;<?php echo $laboratorytouser->email; ?></td>
                      </tr>
                      <tr>
                          <td style="text-align: left;padding-left:50px"><b>Number:</b> &ensp;<?php echo $laboratorytouser->contact_number; ?></td>
                      </tr>
                      <tr>
                          <td style="text-align: left;padding-left:50px"><b>Date of Birth:</b> &ensp;<?php echo $laboratorytouser->birthdate; ?></td>
                      </tr>
                    </thead>
                    <tbody align="center">

                    </tbody>
                </table>
            </section>
        </div>
        <div class="col-sm-4">
            <section class="panel">

                <header class="panel-heading">
					Urgency and Fasting Details
                </header>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td style="text-align: left;padding-left:50px"><b>Urgency: </b>&ensp;<?php echo $laboratorytolabrequest->urg_name; ?> </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;padding-left:50px"><b>Fasting: </b>&ensp;<?php echo $laboratorytolabrequest->fast_name; ?></td>
                    </tr>
                    </thead>
                    <tbody align="center">

                    </tbody>
                </table>
            </section>
        </div>
	</div>
	
	<div class="row" style="padding-left:10px; padding-right: 10px">
        <div class="col-sm-4">
            <section class="panel">
                
                <header class="panel-heading">
					Specimen/s Received
                </header>
                <table class="table table-striped">
                    <thead>
                    <?php
                    foreach($laboratorytospecimen as $spec)
                    {
                      echo "<tr>";
                      echo "<td style='text-align: left; padding-left:50px'>".$spec['specimen_name']."</td>";
                      echo "</tr>";
                    }
                    ?>
                    </thead>
                    <tbody align="center">

                    </tbody>
                </table>
            </section>
        </div>
        <div class="col-sm-8">
            <section class="panel">
                <header class="panel-heading">
					Examination Details
                </header>
                <table class="table table-striped">
                    <thead>
                    <tr>
                      <th style="text-align: left;">Name</th>
                      <th style="text-align: left;">Category</th>
                      <th style="text-align: left;">Description</th>
                    </tr>
                    <tr>
                      <td style="text-align: left;"><?php echo $laboratorytolabrequest->lab_exam_type_name; ?></td>
                      <td style="text-align: left;"><?php echo $laboratorytolabrequest->exam_cat_name; ?></td>
                      <td style="text-align: left;"><?php echo $laboratorytolabrequest->lab_exam_type_description; ?></td>
                    </tr>
                    </thead>
                    <tbody align="center">

                    </tbody>
                </table>
            </section>
        </div>
		</div>
        <div class="col-sm-12">
            <section class="panel">
               
                <header class="panel-heading">
					Additional Remarks
                </header>
                <table class="table table-striped">
                    <thead>
                    <tr>
                      <td style="text-align: center;"><?php echo $laboratorytoremarks->remark; ?></td>
                    </tr>
                    </thead>
                    <tbody align="center">

                    </tbody>
                </table>
            </section>
        </div>
		
    </div>
  </section>
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
