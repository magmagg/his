<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-sm-3">
          <section class="panel">
                <header style="font-weight:300" class="panel-heading">
                   New User
          </header>
          <div class="panel-body">
                <div class="adv-table">
                <table class="table">

                </table>
        <center style="padding: 20px;" >
        <a class="btn btn-round btn-sm btn-success" data-toggle="modal" href="#addnewuser"><i class="fa fa-plus-circle"></i> Add User</a>
        </center>
        </div>
        </div>
            </section>
        </div>
        <div class="col-sm-9">
            <section class="panel">

				<header style="font-weight:300" class="panel-heading">
					 Employee List
				 <span class="tools pull-right">
				 </span>
				</header>

				<div class="panel-body">
				<div class="adv-table">
                <table class="table table-striped" style="text-align: center;" id="dynamic-table">
				<thead>
                  <tr id="tblheader">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Role</th>
                      <th>Contact No.</th>
                      <th>Action</th>
                  </tr>
				  </thead>
				  <tbody>
                  <?php
                    foreach($users as $user){
                      echo "<tr>";
                        echo "<td>".$user['user_id']."</td>";
                        echo "<td>";
                          if($user['gender'] == 'M'){
                            echo "Mr. ";
                          }else{
                            echo "Ms. ";
                          }
                          echo $user['first_name']." ".$user['middle_name']." ".$user['last_name'];
                        echo "</td>";
                        echo "<td>".$user['name']."</td>";
                        echo "<td>".$user['contact_number']."</td>";
                        echo "<td>";
                          echo "<div class='btn-group' role='group' aria-label='...'>";
                            echo "<a data-userid='". $user['user_id'] ."'
                                     data-firstname='". $user['first_name'] ."'
                                     data-lastname='". $user['last_name'] ."'
                                     data-username='". $user['username'] ."'
                                     data-middlename='". $user['middle_name'] ."'
                                     data-email='". $user['email'] ."'
                                     data-name='". $user['name'] ."'
                                     data-birthdate='". $user['birthdate'] ."'
                                     data-mobilenumber='". $user['contact_number'] ."'
                                     onclick='updateuser(this)' role='button' class='btn btn-warning btn-sm'>Update Schedule</a>";
                          echo "</div>";
                        echo "</td>";
                      echo "</tr>";
                    }
                  ?>
				</tbody>
                </table>
				</div>
				</div>
            </section>

        </div>
    </div>

    <div class="modal fade modal-dialog-center" id="addnewuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">Add User</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('usermanagement/insert_user', $attributes);
                      ?>



                      <div class="form-group">
                         <label  class="col-lg-3 col-sm-3 control-label">User Role </label>
                         <div class="col-lg-9" id="usertype">
                             <select class="form-control" name="usertype" id="usertype" onChange="doctorspecialization(this);">
                               <?php
                                 foreach($usertypes as $type){
                                   echo "<option value=".$type['type_id'].">".$type['name']."</option>";
                                 }
                               ?>
                             </select>
                         </div>
                     </div>

                     <div class="form-group" id="specialization">

                     </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Last Name: </label>
                          <div class="col-lg-9">
                              <input type="text" name="lastname" class="form-control" placeholder="Last Name">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">First Name: </label>
                          <div class="col-lg-9">
                              <input type="text" name="firstname" class="form-control" placeholder="First Name">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Middle Name: </label>
                          <div class="col-lg-9">
                              <input type="text" name="middlename" class="form-control" placeholder="Middle Name">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Username: </label>
                          <div class="col-lg-9">
                              <input type="text" name="username" class="form-control" placeholder="Username">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Email: </label>
                          <div class="col-lg-9">
                              <input type="text" name="email" class="form-control" placeholder="Email">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Gender: </label>
                          <div class="col-lg-9">
                            <div class="radios">
                                <label class="label_radio" for="radio-01">
                                    <input name="gender" id="radio-01" value="M" type="radio" checked /> MALE &nbsp;
                                    <input name="gender" id="radio-02" value="F" type="radio" /> FEMALE
                                </label>
                            </div>
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Birth Date: </label>
                          <div class="col-lg-9">
                              <input type="date" name="birthday" class="form-control">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Mobile Number: </label>
                          <div class="col-lg-9">
                              <input type="text" name="mobile_number" class="form-control" placeholder="Mobile Number">
                          </div>
                      </div>



                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <input type="submit" value="Submit" class="btn btn-success">
                    </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-dialog-center" id="updateuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" align="center">Update User</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                        $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                        echo form_open('admin/update_user', $attributes, $attributes);
                      ?>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">User Role </label>
                          <div class="col-lg-9">
                              <select class="form-control" name="usertype">
                                <?php
                                  foreach($usertypes as $type){
                                    echo "<option value=".$type['type_id'].">".$type['name']."</option>";
                                  }
                                ?>
                              </select>
                          </div>
                      </div>

                      <input type="hidden" name="userid" id="updateuserid">

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Last Name: </label>
                          <div class="col-lg-9">
                              <input type="text" id="updatelastname" name="lastname" class="form-control" placeholder="Last Name">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">First Name: </label>
                          <div class="col-lg-9">
                              <input type="text" id="updatefirstname" name="firstname" class="form-control" placeholder="First Name">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Middle Name: </label>
                          <div class="col-lg-9">
                              <input type="text" id="updatemiddlename" name="middlename" class="form-control" placeholder="Middle Name">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Username: </label>
                          <div class="col-lg-9">
                              <input type="text" id="updateusername" name="username" class="form-control" placeholder="Username">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Email: </label>
                          <div class="col-lg-9">
                              <input type="text" id="updateemail" name="email" class="form-control" placeholder="Email">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Birth Date: </label>
                          <div class="col-lg-9">
                              <input type="date" id="updatebirthdate" name="birthday" class="form-control">
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-lg-3 col-sm-3 control-label">Mobile Number: </label>
                          <div class="col-lg-9">
                              <input type="text" id="updatemobilenumber" name="mobile_number" class="form-control" placeholder="Mobile Number">
                          </div>
                      </div>



                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <input type="submit" value="Submit" class="btn btn-success">
                    </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>
    </div>

  </section>
</section>

<script>
  function updateuser(d){
      //console.log(d.getAttribute("data-userid"))
      document.getElementById("updateuserid").value = d.getAttribute("data-userid")
      document.getElementById("updatefirstname").value = d.getAttribute("data-firstname")
      document.getElementById("updatelastname").value = d.getAttribute("data-lastname")
      document.getElementById("updatemiddlename").value = d.getAttribute("data-middlename")
      document.getElementById("updateusername").value = d.getAttribute("data-username")
      document.getElementById("updateemail").value = d.getAttribute("data-email")
      document.getElementById("updatemobilenumber").value = d.getAttribute("data-mobilenumber")
      document.getElementById("updatebirthdate").value = d.getAttribute("data-birthdate")
      $("#updateuser").modal()

  }
</script>


<script src="<?=base_url()?>js/jquery.js"></script>
<script src="<?=base_url()?>js/bootstrap.min.js"></script>

<script class="include" type="text/javascript" src="<?=base_url()?>js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?=base_url()?>js/jquery.scrollTo.min.js"></script>
<script src="<?=base_url()?>js/jquery.nicescroll.js" type="text/javascript"></script>

<!--right slidebar-->
<script src="<?=base_url()?>js/slidebars.min.js"></script>
<!--common script for all pages-->
<script src="<?=base_url()?>js/common-scripts.js"></script>

<!--dynamic table initialization -->
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url()?>js/dynamic_table_init.js"></script>


<script>
    function doctorspecialization(e) {
        if (e.value == "2") {
            var html = $("<label  class='col-lg-3 col-sm-3 control-label'>Specialization</label><div class='col-lg-9'><select class='form-control' name='specialization'>\<?php foreach($specializations as $type){echo '<option value='.$type['spec_id'].'>'.$type['spec_name'].'</option>';}?></select></div>");
            $("#specialization").append(html);
            $("div.usertype select").val("2");
        }
    }
</script>
