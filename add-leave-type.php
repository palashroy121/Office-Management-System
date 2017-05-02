<?php
include 'header.php';

if(isset($_POST['leave_type_value'])){
    $leaveType = $oms->save_leave_type($_POST);
}

$viewLeaveType = $oms->view_leave_type();

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="page-header">Add Leave Type</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-sm-10">
                <?php
                    if(isset($leaveType['su'])){
                        echo $leaveType['su'];
                    }
                ?>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label>Leave Type Name</label>
                            <input type="text" name="leave_type" class="form-control">
                            <?php
                                if(isset($leaveType['leave_type'])){
                                    echo $leaveType['leave_type'];
                                }
                            ?>
                        </div>
                        
                        <button type="submit" name="leave_type_value" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
            <br/>
            <!-- /.row -->
            <div class="row">
                <div class="col-sm-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Leave Type List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Leave Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;
                                    if($viewLeaveType){
                                        foreach ($viewLeaveType as $LeaveValue) {
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $LeaveValue['leave_type']; ?></td>
                                        <td><a href="edit-leave-type.php?edit_id=<?php echo $LeaveValue['id']; ?>" class="btn btn-success btn-xs">Edit</a> <a href="delete-leave-type.php?delete_id=<?php echo $LeaveValue['id']; ?>" class="btn btn-danger btn-xs">Delete</a></td>
                                    </tr>
                                    <?php
                                        $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
        include "footer.php";
    ?>