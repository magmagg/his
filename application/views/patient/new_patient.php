<section id="main-content">
    <section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <!--progress bar start-->
            <section class="panel">
                <header class="panel-heading">
                    Wizard with Validation
                </header>
                <div class="panel-body">
                    <?php
                      $attributes = array('class'=>'form-horizontal', 'role'=>'form', 'id'=>"wizard-validation-form");
                      echo form_open('Patient/test', $attributes);
                    ?>
                        <div>
                            <h3>Step 1</h3>
                            <section>
                                <div class="form-group clearfix">
                                    <label class="col-lg-2 control-label"> First Name</label>
                                    <div class="col-lg-10">
                                        <input id="first_name" name="first_name" type="text" class="required form-control">
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-lg-2 control-label " for="password"> Last Name</label>
                                    <div class="col-lg-10">
                                        <input id="last_name" name="last_name" type="text" class="required form-control">

                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-lg-2 control-label " for="confirm"> Middle Name</label>
                                    <div class="col-lg-10">
                                        <input id="middle_name" name="middle_name" type="text" class="required form-control">
                                    </div>
                                </div>
                            </section>
                            <h3>Step 2</h3>
                            <section>

                                <div class="form-group clearfix">
                                    <label class="col-lg-2 control-label" for="name"> Age </label>
                                    <div class="col-lg-10">
                                        <input id="age" name="age" type="number" class="required form-control">
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-lg-2 control-label " for="surname"> Birthday</label>
                                    <div class="col-lg-10">
                                        <input id="birthday" name="birthday" type="text" class="required form-control">

                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-lg-2 control-label " for="email">Birthplace</label>
                                    <div class="col-lg-10">
                                        <input id="birthplace" name="birthplace" type="text" class="required form-control">
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-lg-2 control-label " for="address">Occupation </label>
                                    <div class="col-lg-10">
                                        <input id="occupation" name="occupation" type="text" class="required form-control">
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-lg-2 control-label " for="address">Religion </label>
                                    <div class="col-lg-10">
                                        <input id="religion" name="religion" type="text" class="required form-control">
                                    </div>
                                </div>

                            </section>
                            <h3>Step 3</h3>
                            <section>
                              <div class="form-group clearfix">
                                  <label class="col-lg-2 control-label " for="address">Nationality </label>
                                  <div class="col-lg-10">
                                      <input id="nationality" name="nationality" type="text" class="required form-control">
                                  </div>
                              </div>

                              <div class="form-group clearfix">
                                  <label class="col-lg-2 control-label " for="address">Present Address </label>
                                  <div class="col-lg-10">
                                      <input id="address" name="address" type="text" class="required form-control">
                                  </div>
                              </div>

                              <div class="form-group clearfix">
                                  <label class="col-lg-2 control-label " for="address">Telephone Number</label>
                                  <div class="col-lg-10">
                                      <input id="tel_number" name="tel_number" type="text" class="required form-control">
                                  </div>
                              </div>

                              <div class="form-group clearfix">
                                  <label class="col-lg-2 control-label " for="address">Mobile Number Address </label>
                                  <div class="col-lg-10">
                                      <input id="mobile_number" name="mobile_number" type="text" class="required form-control">
                                  </div>
                              </div>

                              <div class="form-group clearfix">
                                  <label class="col-lg-2 control-label " for="address">Email Address </label>
                                  <div class="col-lg-10">
                                      <input id="email" name="email" type="email" class="required email form-control">
                                  </div>
                              </div>
                            </section>
                        </div>
                    <?=form_close()?>
                </div>
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
<script src="<?=base_url()?>js/respond.min.js" ></script>
<!--right slidebar-->
<script src="<?=base_url()?>js/slidebars.min.js"></script>
<!--Form Validation-->
<script src="<?=base_url()?>js/bootstrap-validator.min.js" type="text/javascript"></script>
<!--Form Wizard-->
<script src="<?=base_url()?>js/jquery.steps.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js" type="text/javascript"></script>
<!--common script for all pages-->
<script src="<?=base_url()?>js/common-scripts.js"></script>
<!--script for this page-->
<script src="<?=base_url()?>js/jquery.stepy.js"></script>
<script>
  //step wizard
  $(function() {
      $('#default').stepy({
          backLabel: 'Previous',
          block: true,
          nextLabel: 'Next',
          titleClick: true,
          titleTarget: '.stepy-tab'
      });
  });
</script>

<script type="text/javascript">
  $(document).ready(function () {
      var form = $("#wizard-validation-form");
      form.validate({
          errorPlacement: function errorPlacement(error, element) {
              element.after(error);
          }
      });
      form.children("div").steps({
          headerTag: "h3",
          bodyTag: "section",
          transitionEffect: "slideLeft",
          onStepChanging: function (event, currentIndex, newIndex) {
              form.validate().settings.ignore = ":disabled,:hidden";
              return form.valid();
          },
          onFinishing: function (event, currentIndex) {
              form.validate().settings.ignore = ":disabled";
              return form.valid();
          },
          onFinished: function (event, currentIndex) {
              alert("Submitted!");
          }
      });


  });
</script>
</body>
</html>
