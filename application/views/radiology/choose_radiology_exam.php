<section id="main-content">
    <section class="wrapper">
        <section class="panel">
            <header style="font-weight:300" class="panel-heading text-center">
                Radiology Exam List
            </header>
             <?php
                $attributes = array('class'=>'form-horizontal', 'role'=>'form');
                echo form_open(base_url().'Radiology/insert_request/');
            ?>
            <div class="panel-body">
                    <section class="panel">
                            <center>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <div class="checkboxes">
                                                <?php
                                                    foreach($radiology_exams as $radiology_exam){
                                                        echo "<div class='col-lg-3'>";
                                                        echo "<label class='checkbox-inline'>";
                                                        echo "<input type='checkbox' name='exams[]' value='".$radiology_exam['exam_id']."'>".$radiology_exam['exam_name'];
                                                        echo "</label>";
                                                        echo "</div>";
                                                    }
                                                ?>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </center>
                    </section>

                <div class="row">
                    <div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading text-center">
                                Request Note (Optional)

                            </header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Note</label>
                                    <div class="col-md-9">
                                        <textarea class="wysihtml5 form-control" name="note" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12">
                        <input type="hidden" name="patient_id" id="patient_id" value="<?=$this->uri->segment(3)?>"/>
                        <center><input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info"></center>
                    </div>
                </div>
            </div>
        </section>
        <?=form_close()?>
    </section>
</section>


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
    
<!--custom checkbox & radio-->
<script type="text/javascript" src="<?=base_url()?>js/ga.js"></script>
<!--script for this page-->
<script src="<?=base_url()?>js/form-component.js"></script>