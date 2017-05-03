<?php

include 'header.php';

$viewSetting = $oms->view_setting();

if(isset($_POST['edit_setting'])){
    $editSetting = $oms->edit_setting($_POST);
}

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="page-header">Edit Setting</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-sm-10">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $viewSetting->id; ?>">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="company_name" class="form-control" value="<?php echo $viewSetting->company_name; ?>">
                            <?php
                                if(isset($editSetting['company_name'])){
                                    echo $editSetting['company_name'];
                                }
                            ?>
                        </div>
                        <img src="image/<?php echo $viewSetting->company_logo; ?>" style="width: 80px; height: 80px; border: 2px solid #777;"/>
                        <div class="form-group">
                            <label>Company Logo</label>
                            <input type="file" name="company_logo" class="form-control">
                            <?php
                                if(isset($editSetting['company_logo'])){
                                    echo $editSetting['company_logo'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Company Address</label>
                            <input type="text" name="company_address" class="form-control"value="<?php echo $viewSetting->company_address; ?>">
                            <?php
                                if(isset($editSetting['company_address'])){
                                    echo $editSetting['company_address'];
                                }
                            ?>
                        </div>
                        <label>Office Start Time</label>
                        <div class="form-group">
                            <input type="time" name="office_start_time" class="form-control" value="<?php echo $viewSetting->office_start_time; ?>">
                        </div>
                        <label>Office End Time</label>
                        <div class="form-group">
                            <input type="time" name="office_end_time" class="form-control" value="<?php echo $viewSetting->office_end_time; ?>">
                        </div>
                        <input type="submit" name="edit_setting" class="btn btn-primary" value="Save">
                    </form>
                </div>
            </div>
            <div class="cliyerfix"></div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
        include "footer.php";
    ?>