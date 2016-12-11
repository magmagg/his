<section id="main-content">
    <section class="wrapper">
      <section class="panel">
          <header class="panel-heading">
              <h3 align="center">Choose Room</h3>
          </header>
          <table class="table table-hover p-table">
              <thead>
              <tr>
                  <th>Room</th>
                  <th>Action</th>
              </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Direct Room</td>
                  <td><a href='<?=base_url()?>Admitting/DirectRoomPatients' role='button' class='btn btn-success btn-xs'>CONFIRM</td>
                </tr>
                <tr>
                  <td>Emergency Room</td>
                  <td><a href='<?=base_url()?>Admitting/EmergencyRoomPatients' role='button' class='btn btn-success btn-xs'>CONFIRM</td>
                </tr>
                <tr>
                  <td>Operating Room</td>
                  <td><a href='<?=base_url()?>Admitting/OperatingRoomPatients' role='button' class='btn btn-success btn-xs'>CONFIRM</td>
                </tr>
                <tr>
                  <td>Intensive Care Unit</td>
                  <td><a href='<?=base_url()?>Admitting/ICUPatients' role='button' class='btn btn-success btn-xs'>CONFIRM</td>
                </tr>
              </tbody>
          </table>
      </section>
    </section>
</section>


<section>
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
