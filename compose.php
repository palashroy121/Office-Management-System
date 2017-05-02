<?php
include 'header.php';
  
$viewImp = $oms->view_employee();

if(isset($_POST['savemessage'])){
    $saveMessage = $oms->save_message($id, $_POST);
}

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
                    <form role="form" method="post">
                        <div class="form-group">
                            <select name="receiver_id" class="form-control">
                                <option value="">To</option>
                                <?php
                                    if(isset($viewImp)){
                                        foreach($viewImp as $value) {
                                ?>
                                <option value="<?php echo $value['id']; ?>"> <?php echo $value['name']; ?> </option>
                                <?php } } ?>
                            </select>
                            <?php
                                if(isset($saveMessage['receiver_id'])){
                                    echo $saveMessage['receiver_id'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                            <?php
                                if(isset($saveMessage['subject'])){
                                    echo $saveMessage['subject'];
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <textarea name="body" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="file">
                        </div>
                        <input type="submit" name="savemessage" class="btn btn-primary" value="Send">
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