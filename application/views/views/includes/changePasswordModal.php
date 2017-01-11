<?php

    if($defaultpassword != 0 ){


?>
<div class="alert alert-warning" role="alert">
  Hello, please change your default password.
  <a  data-toggle="modal" href="#myModal" class="alert-link">click here</a>
</div>

<!-- Modal -->
<?php
    echo form_open('Dashboard/changepass');
 ?>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change password</h4>
      </div>
      <div class="modal-body">
        <div class="input-group input-group-lg">
          <input type="password" class="form-control" placeholder="New password" name="npassword">
        </div><br>
        <div class="input-group input-group-lg">
          <input type="password" class="form-control" placeholder="Confrim password" name="cpassword">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Change</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</form>

<?php

    }
?>
