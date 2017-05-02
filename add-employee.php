<?php
include "header.php";

$desig_select = $oms->select_designation();

 if(isset($_POST['emp_save'])){
    $saveImp = $oms->save_employee($_POST);
}

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <?php
                        if(isset($saveImp['su'])){
                            echo $saveImp['su'];
                        }
                    ?>
                    <h1 class="page-header">Add Employee</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-sm-10">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label>Employee Name</label>
                            <input type="text" name="name" class="form-control">
                            <?php
                                if(isset($saveImp['name'])){
                                    echo $saveImp['name'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <select name="designation" class="form-control">
                                <option value="">--- Select ---</option>
                                <?php
                                    if(isset($desig_select)){
                                        foreach($desig_select as $value) {
                                ?>
                                <option value="<?php echo $value['designation']; ?>"> <?php echo $value['designation']; ?> </option>
                                <?php } } ?>
                            </select>
                            <?php
                                if(isset($saveImp['designation'])){
                                    echo $saveImp['designation'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control">
                            <?php
                                if(isset($saveImp['address'])){
                                    echo $saveImp['address'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control">
                            <?php
                                if(isset($saveImp['phone'])){
                                    echo $saveImp['phone'];
                                }
                            ?>
                        </div>
                        <label>Joining Date</label>
                        <div class="input-group form-group date" data-provide="datepicker">
                            <input type="text" name="joining_date" class="form-control" data-date-format="mm-dd-yyyy" placeholder="mm-dd-yyyy">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                            <?php
                                if(isset($saveImp['email'])){
                                    echo $saveImp['email'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="user_name" class="form-control">
                            <?php
                                if(isset($saveImp['user_name'])){
                                    echo $saveImp['user_name'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            <?php
                                if(isset($saveImp['password'])){
                                    echo $saveImp['password'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <label class="radio-inline">
                                <input type="radio" name="status" id="optionsRadiosInline1" value="1" checked>Active
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" id="optionsRadiosInline2" value="0">Inactive
                            </label>
                        </div>
                        <input type="submit" name="emp_save" class="btn btn-primary" value="Save">
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