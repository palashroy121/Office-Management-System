<?php

include 'header.php';

//Count Send Item  
$countSent = $oms->count_sent($id);

$getID = $_GET['view-id'];

$viewTask = $oms->view_task_by_id($getID);

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="page-header">View Task</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-sm-10">
                <?php if(!empty($viewTask)) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>From: <?php echo $viewTask->name; ?></strong> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <strong>Task Name: </strong><em><?php echo $viewTask->task_name; ?></em>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <p>Start Date: <?php echo $viewTask->start_date; ?></p>
                            <p>End Date: <?php echo $viewTask->start_date; ?></p>
                            <?php
                            $status = ['Not Started', 'Pending', 'In Progress', 'Completed'];
                                foreach($status as $key => $value){
                                    if($viewTask->status == $key){
                            ?>
                                <p>Status: <em class="btn btn-info btn-xs"><?php echo $value; ?></em></p>
                            <?php
                                }
                            }
                            ?>
                            <p>Details: <?php echo $viewTask->task_details; ?></p>
                        </div>
                    </div>
                    <!-- /.panel -->
                    <?php
                        }
                        else{
                            echo '<h2 class="text-danger text-center">No data found!</h2>';
                        }
                    ?>
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