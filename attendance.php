<?php

include 'header.php';

$viewAtten = $oms->view_attendance();

$viewSetting = $oms->view_setting();

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="page-header">View Employee</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Entry</th>
                                <th>Exit</th>
                                <th>Duty</th>
                                <th>Late</th>
                                <th>Extra</th>
                                <th>Status</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($viewAtten){
                                foreach ($viewAtten as $Value) {
                        ?>
                            <tr class="odd gradeX">
                                <td><?php echo $Value['employee_id']; ?></td>
                                <td><?php echo $Value['daily_date']; ?></td>
                                <td><?php echo date('H:i A', strtotime($Value['entry_time'])); ?></td>
                                <td><?php echo date('H:i A', strtotime($Value['exit_time'])); ?></td>
                                <td>
                                    <?php
                                        $exit_time = date('H:i', strtotime($Value['exit_time']));
                                        $entry_time = date('H:i', strtotime($Value['entry_time']));
                                        $diff=($entry_time-$exit_time);
                                        echo date('H:i', $diff);
                                    ?>  
                                </td>
                                <td>
                                    <?php
                                        if($viewSetting->office_start_time<$Value['entry_time']){
                                            echo "Late";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($viewSetting->office_start_time<$Value['entry_time']){
                                            echo "Extra";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($Value){
                                            echo '<p class="btn btn-success btn-xs">Present</p>';
                                        }
                                    ?>
                                </td>
                                <td>
                                   
                                </td>

                                <td>
                                <a href="edit-employee.php?delete_id=<?php echo $EmpValue['id']; ?>" class="btn btn-danger btn-xs">Delete</a>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
        include "footer.php";
    ?>