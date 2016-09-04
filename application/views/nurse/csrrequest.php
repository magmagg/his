<title><?php echo $title; ?></title>
<section id="main-content">
    <section class="wrapper">


      <!-- page start-->
      <section class="panel">
            <?php if(isset($_SESSION['succ'])){
                    echo $_SESSION['succ'];
                    //a
                }

                 ?>
          <header class="panel-heading">
              Request Material
              <span class="pull-right">
                  <a href="<?php echo base_url();?>plan/vitalsigns"><button type="button" id="loading-btn" class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Refresh</button></a>

              </span>
          </header>
          <div class="panel-body">
              <div class="row">
                <?php echo form_open("Nurse/vitalsigns"); ?>
                  <div class="col-md-12">
                      <div class="input-group"><input type="text" name="keyword" placeholder="Search Here" class="input-sm form-control"> <span class="input-group-btn">
                      <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-search"></i> Search</button> </span></div>
                  </div>
                </form>
              </div>
          </div>

          <table class="table table-hover p-table">
              <thead>
              <tr>
                  <th>Item Name</th>
                  <th>Description</th>
                  <th>Stocks</th>
                  <th>Custom</th>
              </tr>
              </thead>
              <tbody>


                <?php foreach ($CSRItems as $CSRItem) {
                      ?>
              <tr>
                  <td class="p-name">
                      <?php echo $CSRItem['item_name'];  ?>
                      <br>
                      <small>Stock updated --</small>
                  </td>
                  <td class="p-name">
                      <p><?php echo $CSRItem['item_desc'];?></p>
                  </td>

                  <td>
                      <!-- <span class="label label-primary">Active</span> -->
                      <p>
                            <?php echo $CSRItem['item_stock']; ?>
                      </p>
                  </td>
                  <td>
                      <!-- <a href="project_details.html" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a> -->
                      <a class="btn btn-round btn-info" data-toggle="modal" href="#<?php echo $CSRItem['csr_id'];?>">
                                 Request </a>
                  </td>
              </tr>


              <!-- Modal -->
                               <div class="modal fade" id="<?php echo $CSRItem['csr_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                   <div class="modal-dialog modal-sm">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                               <h4 class="modal-title">Modal Tittle</h4>
                                           </div>
                                           <div class="modal-body">
                                               <?php echo form_open("Nurse/csr_singlerequest"); ?>
                                               <div class="form-group">
                                                   <label for="exampleInputEmail1">Stocks available <?php echo $CSRItem['item_stock'];?></label>
                                                   <input type="text" name="stock" class="form-control" id="exampleInputEmail1" placeholder="enter stocks">
                                                   <?php echo form_hidden("hiddenItemId", $CSRItem['csr_id']); ?>
                                                </div>


                                           </div>
                                           <div class="modal-footer">
                                               <button class="btn btn-danger" type="submit"> Request</button>
                                           </div>
                                                </form>
                                       </div>
                                   </div>
                               </div>
                               <!-- modal -->


<!-- tr sds-->
              <?php } ?>




              </tbody>
          </table>
      </section>





      <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Multiple Material Requests
                        </header>
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> Company</th>

                                <th><i class="fa fa-bookmark"></i> Profit</th>
                                <th><i class=" fa fa-edit"></i> Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="#">Vector Ltd</a></td>

                                <td>12120.00$ </td>
                                <td><span class="label label-info label-mini">Due</span></td>
                                <td>
                                    <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </section>
                </div>
            </div>

      <!-- page end-->






    </section>
  </section>
      <!--main content end-->
