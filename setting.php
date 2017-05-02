<?php

include 'header.php';

if(isset($_POST['save_setting'])){
    $saveSetting = $oms->save_setting($_POST);
}

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    
                        <?php
                            if(isset($saveSetting['su'])){
                        ?>
                        <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php
                            echo $saveSetting['su'];
                        ?>
                        </div>
                        <?php
                            }
                        ?>
                    <h1 class="page-header">Setting <a href="edit-setting.php" class="btn btn-info navbar-right">Edit</a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-sm-10">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="company_name" class="form-control">
                            <?php
                                if(isset($saveSetting['company_name'])){
                                    echo $saveSetting['company_name'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Company Logo</label>
                            <input type="file" name="company_logo" class="form-control">
                            <?php
                                if(isset($saveSetting['company_logo'])){
                                    echo $saveSetting['company_logo'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Company Address</label>
                            <input type="text" name="company_address" class="form-control">
                            <?php
                                if(isset($saveSetting['company_address'])){
                                    echo $saveSetting['company_address'];
                                }
                            ?>
                        </div>
                        <label>Office Start Time</label>
                        <div class="form-group">
                            <input type="time" name="office_start_time" class="form-control">
                        </div>
                        <label>Office End Time</label>
                        <div class="form-group">
                            <input type="time" name="office_end_time" class="form-control">
                        </div>
                        <input type="submit" name="save_setting" class="btn btn-primary" value="Save">
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