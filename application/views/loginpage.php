<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">
    <title>Norahs</title>
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?=base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?=base_url()?>css/owl.carousel.css" type="text/css">
    <!--right slidebar-->
    <link href="<?=base_url()?>css/slidebars.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>css/style.css" rel="stylesheet">
    <link href="<?=base_url()?>css/style-responsive.css" rel="stylesheet" />
  </head>
  <style>
  body{
	  font-weight: 300;
  }

  ::-webkit-input-placeholder {
   color: red;
}


  </style>
  <body>

<br>
<div class="container" style="padding:0px;">
    <div class="row" style="margin: 0 auto;">
                  <div class="text-center">
                              <fieldset>
                               <?php
                                 $attributes = array('name' => 'userLogin', 'id' => 'userLogin', 'method' => 'post');
                                 echo form_open('Norahs/checkLogin', $attributes); ?>
								<img width="350" src="<?php echo base_url()?>/img/norahslogo.png">
								<div class="col-md-6 col-md-offset-3">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input class="form-control" placeholder="Employee Username" name="user_username" type="text" autofocus>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input class="form-control" placeholder="Employee Password" name="user_password" type="password" value="">
										</div>
									</div>
								</div>
                                <!-- Change this to a button or input when using this as a form -->
                                <center> <font color="red"><p><?=$this->session->flashdata('msg')?></p></font></center>
								<label class="pull-left" style="font-weight: 300">
											<a href="<?=base_url()?>Norahs/forgotPassword">Forgot Password?</a>
								</label>

									<input style="font-weight: 300; BORDER: #B2203C;background-color:#B2203C " type="submit" class="btn btn-lg btn-danger btn-block" value="LOGIN"/>

								</div>
                            </fieldset>
                        </form>
        </div>
    </div>
</div>

</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="<?=base_url()?>js/jquery.js"></script>
<script src="<?=base_url()?>js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?=base_url()?>js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?=base_url()?>js/jquery.scrollTo.min.js"></script>
<script src="<?=base_url()?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/jquery.sparkline.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="<?=base_url()?>js/owl.carousel.js" ></script>
<script src="<?=base_url()?>js/jquery.customSelect.min.js" ></script>
<script src="<?=base_url()?>js/respond.min.js" ></script>

<!--right slidebar-->
<script src="<?=base_url()?>js/slidebars.min.js"></script>

<!--common script for all pages-->
<script src="<?=base_url()?>js/common-scripts.js"></script>

<!--script for this page-->
<script src="<?=base_url()?>js/sparkline-chart.js"></script>
<script src="<?=base_url()?>js/easy-pie-chart.js"></script>
<script src="<?=base_url()?>js/count.js"></script>

<script>

//owl carousel

$(document).ready(function() {
    $("#owl-demo").owlCarousel({
        navigation : true,
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem : true,
  autoPlay:true

    });
});

//custom select box

$(function(){
    $('select.styled').customSelect();
});

$(window).on("resize",function(){
    var owl = $("#owl-demo").data("owlCarousel");
    owl.reinit();
});

</script>

</body>

<!-- Mirrored from thevectorlab.net/flatlab/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 May 2016 02:05:28 GMT -->
</html>
