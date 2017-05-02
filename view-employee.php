<?php

include 'header.php';

$viewImp = $oms->view_employee();

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <?php
                        if(isset($saveImp['su'])){
                            echo $saveImp['su'];
                        }
                    ?>
                    <h1 class="page-header">View Employee</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                            		if($viewImp){
                            			foreach ($viewImp as $EmpValue) {
                            	?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $EmpValue['name']; ?></td>
                                        <td><?php echo $EmpValue['designation']; ?></td>
                                        <td><?php echo $EmpValue['address']; ?></td>
                                        <td><?php echo $EmpValue['email']; ?></td>
                                        <td><a href="edit-employee.php?edit_id=<?php echo $EmpValue['id']; ?>" class="btn btn-success btn-xs">Edit</a> <a href="edit-employee.php?delete_id=<?php echo $EmpValue['id']; ?>" class="btn btn-danger btn-xs">Delete</a></td>
                                    </tr>
                                    <?php
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