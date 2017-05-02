<?php

include 'header.php';

if(isset($_POST['save-task'])){
    $saveTask = $oms->save_task($_POST);
}

$viewImp = $oms->view_employee();

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <?php
                        if(isset($saveTask['su'])){
                            echo $saveTask['su'];
                        }
                    ?>
                    <h1 class="page-header">Add Task <a href="task-list.php" class="btn btn-primary">View Task List</a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-sm-10">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <select name="employee_id" class="form-control">
                                <option value="">--- Select Name ---</option>
                                <?php
                                    if(isset($viewImp)){
                                        foreach($viewImp as $value) {
                                ?>
                                <option value="<?php echo $value['id']; ?>"> <?php echo $value['name']; ?> </option>
                                <?php } } ?>
                            </select>
                            <?php
                                if(isset($saveTask['employee_id'])){
                                    echo $saveTask['employee_id'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Task Name</label>
                            <input type="text" name="task_name" class="form-control">
                            <?php
                                if(isset($saveTask['task_name'])){
                                    echo $saveTask['task_name'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Task Details</label>
                            <textarea name="task_details" class="form-control" rows="3"></textarea>
                        </div>
                        <label>Start Date</label>
                        <div class="input-group form-group date" data-provide="datepicker">
                            <input type="text" name="start_date" class="form-control" data-date-format="mm-dd-yyyy" placeholder="mm-dd-yyyy">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        <label>End Date</label>
                        <div class="input-group form-group date" data-provide="datepicker">
                            <input type="text" name="end_date" class="form-control" data-date-format="mm-dd-yyyy" placeholder="mm-dd-yyyy">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        <input type="submit" name="save-task" class="btn btn-primary" value="Save">
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