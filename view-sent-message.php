<?php

include 'header.php';
  
//Count Send Item  
$countSent = $oms->count_sent($id);

if(isset($_GET['view-id'])){
    $viewId = $_GET['view-id'];
}

$viewSentMessage = $oms->view_sent_message_by_id($viewId);

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="page-header">Message</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <a href="compose.php" class="btn btn-info">Compose</a>
                    <a href="message.php" class="btn btn-primary" type="button">Inbox <span class="badge"><?php if(isset($countInbox)){ echo $countInbox; } ?></span></a>
                    <a href="sent.php" class="btn btn-success" type="button">Sent <span class="badge"><?php if(isset($countSent)){ echo $countSent; } ?></span></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <br/>
            <!-- /.row -->
            <div class="row">
                <div class="col-sm-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <?php
                            if($viewSentMessage){
                                foreach ($viewSentMessage as $value) {
                        ?>
                            <strong>To: <?php echo $value['name']; ?></strong> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <strong>Subject: </strong><em><?php echo $value['subject']; ?></em>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <p><?php echo $value['body']; ?></p>
                            <p>Date: <?php echo date('d-M-Y', strtotime($value['date_times'])); ?></p>
                            <p>Time: <?php echo date('h-i-s A', strtotime($value['date_times'])); ?></p>
                        <?php
                                }
                            }
                            else{
                                echo "Data Not Found.";
                            }
                        ?>
                        </div>
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