<?php
include '../dbconnection.php';
$chk=mysqli_query($dbcon,"select * from student_point_temp where st='0'");
?>
<li class="purple dropdown-modal">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                <span class="badge badge-important"><?php echo mysqli_num_rows($chk) ?></span>
        </a>

        <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                <li class="dropdown-header">
                        <i class="ace-icon fa fa-exclamation-triangle"></i>
                         Notifications
                </li>

                <li class="dropdown-content">
                        <ul class="dropdown-menu dropdown-navbar navbar-pink">
                            <?php
                            while($rchk=mysqli_fetch_row($chk))
                            {
                            ?>
                                <li>
                                        <a href="#">
                                                <div class="clearfix">
                                                        <span class="pull-left">
                                                                <i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
                                                                Request from <?php echo $rchk[1] ?>
                                                        </span>
                                                       
                                                </div>
                                        </a>
                                </li>
                            <?php
                            }
                            ?>
                         </ul>
                </li>

                <li class="dropdown-footer">
                        <a href="studnotification.php">
                                See all notifications
                                <i class="ace-icon fa fa-arrow-right"></i>
                        </a>
                </li>
        </ul>
</li>