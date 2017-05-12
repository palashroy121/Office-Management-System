<?php
ob_start();
include 'lib/oms.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/lib/session.php';
Session::init();
$name = Session::get("name");
$msg = Session::get("loginmsg");
$id = Session::get("id");
//Session::sessionCheck();

$oms = new oms();

$taskLimit = $oms->view_task_limit();

//Count Inbox Item  
$viewInbox = $oms->view_inbox($id);
$countInbox = $oms->count_inbox($id);

//Logout
if(isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}

//Check Out
if(isset($_GET['action']) && $_GET['action'] == "ckeckout") {
    $empCheckout = $oms->ckeckout_time($id);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>OMS - Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php">Office Management System</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a href="?action=ckeckout" class="btn btn-success"><strong>Check Out</strong></a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i><sup><span class="badge">
                        <?php
                            if(isset($countInbox)){ echo $countInbox; } 
                        ?>
                        </span></sup> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <?php
                            if($viewInbox){
                                foreach ($viewInbox as $viewValue) {
                        ?>
                        <li>
                            <a href="view-inbox-message.php?view-id=<?php echo $viewValue['id']; ?>">
                                <div>
                                    <strong><?php echo $viewValue['name']; ?></strong>
                                    <span class="pull-right text-muted">
                                        <em><?php echo date('h-i-s A', strtotime($viewValue['date_times'])); ?></em>
                                    </span>
                                </div>
                                <div><?php echo $viewValue['subject']; ?></div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <?php
                            }
                        }
                        ?>
                        <li>
                            <a href="message.php" class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <?php
                            if($taskLimit){
                                foreach ($taskLimit as $value) {
                        ?>
                        <li>
                            <a href="view-task.php?view-id=<?php echo $value['id']; ?>">
                                <div>
                                    <p>
                                        <strong><?php echo $value['task_name']; ?></strong>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $value['completion']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value['completion']; ?>%">
                                            <span class="sr-only"><?php echo $value['completion']; ?>% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <?php
                            }
                        }
                        ?>
                        <li>
                            <a class="text-center" href="task-list.php">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php if(isset($name)){ echo $name; } ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="setting.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="?action=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a><i class="fa fa-users fa-fw"></i> Employee<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="add-employee.php">Add Employee</a>
                                </li>
                                <li>
                                    <a href="view-employee.php">View Employee</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="add-designation.php"><i class="fa fa-plus fa-fw"></i> Add Designation</a>
                        </li>
                        <li>
                            <a><i class="fa fa-plus fa-fw"></i> Leave<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="leave.php">Add Leave</a>
                                </li>
                                <li>
                                    <a href="add-leave-type.php">Add Leave Type</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="setting.php"><i class="fa fa-cog fa-fw"></i> Setting</a>
                        </li>
                        <li>
                            <a><i class="fa fa-tasks fa-fw"></i> Task<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="task.php">Add Task</a>
                                </li>
                                <li>
                                    <a href="task-list.php">Task List</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="message.php"><i class="fa fa-comment fa-fw"></i> Message</a>
                        </li>
                        <li>
                            <a href="attendance.php"><i class="fa fa-sitemap fa-fw"></i> Attendance<span class="fa arrow"></span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Report<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Daily Report</a>
                                </li>
                                <li>
                                    <a href="#">Monthly Report</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>