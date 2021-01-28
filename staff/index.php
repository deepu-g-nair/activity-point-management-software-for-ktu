 <?php
include '../dbconnection.php';
include '../admin/encode_decode.php';
session_start();
if(isset($_SESSION['stf']))
{
    $uid=$_SESSION['stf'];
    $sel=mysqli_query($dbcon,"select * from staff_data where stfid='$uid'");
    $r=mysqli_fetch_row($sel);
}
else{
    header("location:../index.php");
}
if(isset($_POST['sub']))
{
    $chk=mysqli_query($dbcon,"select * from student_data where rol_num='".$_POST['rn']."'");
    if(mysqli_num_rows($chk)>0)
    {
        $rn=  encrypt_url($_POST['rn']);
        header("location:index.php?rn=$rn");
    }
    else
    {
        header("location:index.php?error=1");
    }
}
if(isset($_POST['addmrk']))
{
    $rn=  decrypt_url($_GET['rn']);
    $scat=$_POST['subcat'];
    $ldata=explode(",",$_POST['l10']);
    $sublevelid=$ldata[0];
    $mrk=$ldata[1];
    $mrk_id=$ldata[2];
    $yr=date('Y');
    $up=$_FILES['up']['name'];
    $fn=time().uniqid(rand()).substr($up,strrpos($up,"."));
    $ins_mrk=mysqli_query($dbcon,"INSERT INTO `student_point`(`rol_num`, `subcatid`, `level_id`, `mark`, `mark_typ`, `mark_id`, `docfile`, `year`) VALUES ('$rn','$scat','$sublevelid','$mrk','1','$mrk_id','$fn','$yr')");
    if($ins_mrk>0)
    {
        header("location:index.php?rn=".encrypt_url($rn));
    }
}
if(isset($_POST['xmark']))
{
    $rn=  decrypt_url($_GET['rn']);
    $scat=$_POST['subcat1'];
    $ldata=explode(",",$_POST['xm']);
    $sublevelid=$ldata[0];
    $mrk=$ldata[1];
    $mrk_id=$ldata[2];
    $yr=date('Y');
    $up=$_FILES['xup']['name'];
    $fn=time().uniqid(rand()).substr($up,strrpos($up,"."));
    $ins_mrk=mysqli_query($dbcon,"INSERT INTO `student_point`(`rol_num`, `subcatid`, `level_id`, `mark`, `mark_typ`, `mark_id`, `docfile`, `year`) VALUES ('$rn','$scat','$sublevelid','$mrk','2','$mrk_id','$fn','$yr')");
    if($ins_mrk>0)
    {
        header("location:index.php?rn=".encrypt_url($rn));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $title ?></title>

		<meta name="description" content="Students activity management project developed by Trinity Technologies, Pulimood." />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../admin/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../admin/assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="../admin/assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="../admin/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../admin/assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="../admin/assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../admin/assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../admin/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="../admin/assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="../admin/assets/js/html5shiv.min.js"></script>
		<script src="../admin/assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.php" class="navbar-brand">
						<small>
							<i class="fa fa-graduation-cap"></i>
							<?php echo $college ?> : 
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<?php
                                                include './notification.php';
                                                ?>

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                                            <img class="nav-user-photo" src="../admin/staffpic/<?php echo $r[9] ?>" alt=""/>
								
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo $r[1] ?> ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="admin_password.php">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li class="divider"></li>

								<li>
                                                                    <a href="../logout.php">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="active">
						<a href="index.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
                                        <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-wrench"></i>
							<span class="menu-text">
								Settings
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
                                                            <a href="settings.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Manage Category
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="levels.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Manage Levels
								</a>

								<b class="arrow"></b>
							</li>
                                                        <li class="">
								<a href="admark.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Manage Add-on Mark
								</a>

								<b class="arrow"></b>
							</li>
                                                        
                                                        
                                                    </ul>
					</li>
                                        
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text">
								Manage Students
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="add-student.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Students
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="view-student.php">
									<i class="menu-icon fa fa-caret-right"></i>
									View Students
								</a>

								<b class="arrow"></b>
							</li>
                                                        
                                                        
                                                    </ul>
					</li>
                                        <li class="">
						<a href="apoint.php">
							<i class="menu-icon fa fa-line-chart"></i>
							<span class="menu-text"> Activity Points</span>
						</a>

						<b class="arrow"></b>
					</li>
                                        <li class="">
                                                 <a href="../logout.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Logout
								</a>

								<b class="arrow"></b>
							</li>
                                        
                                </ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">
						

						<div class="page-header">
							<h1>
								Dashboard
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									overview &amp; stats
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="col-md-3"></div>
                                                        <div class="col-md-6">
                                                            <form method="post">
                                                            <table class="table table-condensed table-hover table-responsive">
                                                                <tr>
                                                                    <td><input type="text" name="rn" class="form-control" placeholder="KTU Roll Number.." />
                                                                        <input type="submit" name="sub" value="PROCEED" class="btn btn-sm btn-success pull-right" /></td>
                                                                </tr>
                                                            </table>
                                                                <center>
                                                                    <?php
                                                                    if(isset($_GET['error']))
                                                                    {
                                                                        ?>
                                                                    <span class="label label-danger">Invalid KTU Roll Number</span>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </center>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-3"></div>
                                                    </div><!-- /.col -->
						</div><!-- /.row -->
                                                <div class="row">
                                                    <?php
                                                    if(isset($_GET['rn']))
                                                    {
                                                    $rn=  decrypt_url($_GET['rn']);
                                                    $selst=mysqli_query($dbcon,"select * from student_data where rol_num='$rn'");
                                                    $rst=mysqli_fetch_row($selst);
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-3"></div>
                                                        <div class="col-md-6">
                                                            <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
                                                                <tr>
                                                                    <td style="width: 50%;">
                                                                        <img src="studpic/<?php echo $rst[14] ?>" alt="<?php echo $rst[5] ?>" class="img img-responsive img-thumbnail" /> 
                                                                    </td>
                                                                    <td>
                                                                        <h4 style="color: green;"><b><?php echo strtoupper($rst[5]) ?></b></h4>
                                                                        <?php
                                                                        if($rst[12]=="Male")
                                                                        {
                                                                            echo"<b>S/o. $rst[10]</b>";
                                                                        }
                                                                        else{
                                                                            echo"<b>D/o. $rst[10]</b>";
                                                                        }
                                                                        ?>
                                                                        <hr />
                                                                        KTU Roll No: <?php echo $rst[6] ?><br />
                                                                        Admission No: <?php echo $rst[7] ?>
                                                                        <hr />
                                                                        <span class="fa fa-phone-square"></span> <?php echo $rst[9] ?><br />
                                                                        <span class="fa fa-phone-square"></span> <?php echo $rst[11] ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-3"></div>
                                                    </div>
                                                    <div class="row">
                                                        <?php
                                                        if(isset($_GET['sid']))
                                                        {
                                                            $sid=  decrypt_url($_GET['sid']);
                                                            $rn= decrypt_url($_GET['rn']);                                                            
                                                            $selsc=mysqli_query($dbcon,"select * from subcategory_data where subid='$sid'");
                                                            if(mysqli_num_rows($selsc)>0)
                                                            {
                                                                $rsc=mysqli_fetch_row($selsc);
                                                                ?>
                                                        <div class="col-md-12">
                                                            <a href="index.php?rn=<?php echo encrypt_url($rn) ?>" class="label label-danger pull-right" style="margin-right: 5px;">BACK</a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <form method="post" enctype="multipart/form-data">
                                                            <table class="table table-bordered table-condensed table-responsive table-striped table-hover">
                                                                <tr>
                                                                    <td colspan="3"><center><b><?php echo $rsc[2] ?></b></center></td>
                                                                </tr>
                                                                <?php
                                                                $sel_subl=mysqli_query($dbcon,"select * from level_settings where lid='$rsc[3]'");
                                                                $rsl=mysqli_fetch_row($sel_subl);                                                                
                                                                ?>
                                                                <tr>
                                                                    <td colspan="3"><center><?php echo $rsl[1] ?> : <?php echo $rsc[6] ?> Times</center></td>
                                                                </tr>                                                                
                                                                <tr>
                                                                    <td colspan="2">
                                                                        Choose a level
                                                                    </td>
                                                                    <td><input type="hidden" name="subcat" value="<?php echo $sid ?>" />
                                                                        <select class="form-control" name="l10">
                                                                            <option value="">Choose</option>
                                                                            <?php
                                                                            $sel_sublv1=mysqli_query($dbcon,"select * from sublevel_settings where lid='$rsc[3]'");
                                                                            while($rslv1=mysqli_fetch_row($sel_sublv1))
                                                                            {
                                                                                $selmrk1=mysqli_query($dbcon,"select * from subcat_mrk where subid='$sid' and st='$rslv1[0]'");
                                                                                $rmrk1=mysqli_fetch_row($selmrk1);
                                                                                ?>
                                                                            <option value="<?php echo $rslv1[0] ?>,<?php echo $rmrk1[2] ?>,<?php echo $rmrk1[0] ?>"><?php echo $rslv1[2] ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">Choose File</td>
                                                                    <td><input type="file" name="up" class="form-control" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3">
                                                                <center>
                                                                    <input type="submit" name="addmrk" class="btn btn-sm btn-success" value="ADD MARK" />
                                                                </center>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                
                                                                $sel_sublv=mysqli_query($dbcon,"select * from sublevel_settings where lid='$rsc[3]'");
                                                                while($rslv=mysqli_fetch_row($sel_sublv))
                                                                {
                                                                    ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo $rslv[2] ?>
                                                                       
                                                                    </td>
                                                                    <td colspan="2">
                                                                         <?php
                                                                        $selmrk=mysqli_query($dbcon,"select * from subcat_mrk where subid='$sid' and st='$rslv[0]'");
                                                                        $rmrk=mysqli_fetch_row($selmrk);
                                                                        echo $rmrk[2];
                                                                        ?>
                                                                                                                                         
                                                                        <?php
                                                                        if($rsc[7]=="1")
                                                                        {
                                                                            ?>
                                                                        <div style="float: right; color: white;" class="label label-danger">
                                                                            <a style="color: white;" href="index.php?lid=<?php echo encrypt_url($rslv[0]) ?>&sid=<?php echo encrypt_url($sid) ?>&rn=<?php echo encrypt_url($rn) ?>"><span class="fa fa-plus-square"></span> EXTRA MARK</a>
                                                                        </div>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </table>
                                                            </form>
                                                            <center><h4><b>AVAILABLE POINTS</b></h4></center>
                                                            <?php
                                                            $sel_scn=mysqli_query($dbcon,"select * from subcategory_data where subid='$sid'");
                                                                    $rscn=mysqli_fetch_row($sel_scn);
                                                                    
                                                            $selyr=mysqli_query($dbcon,"select distinct year from student_point where rol_num='$rn' and subcatid='$sid'");
                                                            if(mysqli_num_rows($selyr)>0)
                                                            {
                                                                ?>
                                                            <table class="table table-bordered table-condensed table-hover table-responsive">
                                                                <tr>
                                                                    <td colspan="5"><b><?php echo $rscn[2]; ?></b></td>
                                                                </tr>
                                                                <?php
                                                                while($ry=mysqli_fetch_row($selyr))
                                                                {
                                                                    ?>
                                                                <tr>
                                                                    <td colspan="5"><?php echo $ry[0] ?></td>
                                                                </tr>
                                                                <?php
                                                                $sel_mrk=mysqli_query($dbcon,"select * from student_point where rol_num='$rn' and subcatid='$sid' and year='$ry[0]'");
                                                                while($rmrk=mysqli_fetch_row($sel_mrk))
                                                                {
                                                                    ?>
                                                                <tr>
                                                                    <td style="width: 10%"></td>
                                                                    <td style="width: 10%"><center><?php echo $rmrk[4] ?></center></td>
                                                                    <td>
                                                                        <?php
                                                                        if($rmrk[5]=="1")
                                                                        {
                                                                            echo"Normal Mark";                                                                            
                                                                        }
                                                                        else{
                                                                            $seldata=mysqli_query($dbcon,"select * from subcat_xmrk where id='$rmrk[6]'");
                                                                            $rdata=mysqli_fetch_row($seldata);
                                                                            echo "<b>$rdata[2]</b><br />$rdata[3]";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </table>
                                                            <?php
                                                            }
                                                            ?>
                                                            <script>
                                                            function shodata(x)
                                                            {
                                                                $("#data"+x).show();
                                                                $("#a"+x).hide();
                                                                $("#b"+x).show();
                                                            }
                                                            </script>
                                                            <?php
                                                            $selp=mysqli_query($dbcon,"select * from student_point where rol_num='$rn'");
                                                            if(mysqli_num_rows($selp)>0)
                                                            {
                                                                ?>
                                                            <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
                                                                <?php
                                                                $sel_sc=mysqli_query($dbcon,"select distinct subcatid from student_point where rol_num='$rn'");
                                                                $i=0;
                                                                while($rsc=mysqli_fetch_row($sel_sc))
                                                                {
                                                                    $i++;
                                                                    ?>
                                                                <tr>
                                                                    <td><?php
                                                                    $sel_scn=mysqli_query($dbcon,"select * from subcategory_data where subid='$rsc[0]'");
                                                                    $rscn=mysqli_fetch_row($sel_scn);
                                                                    echo $rscn[2];
                                                                    ?></td>
                                                                    <td>
                                                                        <?php
                                                                        $selmrk=mysqli_query($dbcon,"select sum(mark) from student_point where rol_num='$rn' and subcatid='$rsc[0]'");
                                                                        $rmrk=mysqli_fetch_row($selmrk);
                                                                        echo $rmrk[0];
                                                                        ?>
                                                                       
                                                                    </td>
                                                                </tr>
                                                                <tr id="data<?php echo $i ?>" style="display: none;">
                                                                    <td colspan="2">
                                                                        
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </table>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <?php 
                                                            if(isset($_GET['lid']))
                                                            {
                                                                $lid=  decrypt_url($_GET['lid']);
                                                                $sel_slvl=mysqli_query($dbcon,"select * from sublevel_settings where slid='$lid'");
                                                                $rsl1=mysqli_fetch_row($sel_slvl);
                                                                    ?>
                                                            <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
                                                            <?php
                                                            $z=0;
                                                            $xm1=mysqli_query($dbcon,"select * from subcat_xmrk where subid='$sid' and lvlid='$lid'");
                                                            ?>
                                                                <tr>
                                                                    <td colspan="4"><center><b><?php echo $rsl1[2] ?></b></center></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3">
                                                                        <form method="post" enctype="multipart/form-data">
                                                                        <table class="table table-bordered">
                                                                <tr>
                                                                    <td>Choose Category</td>
                                                                    <td><input type="hidden" name="subcat1" value="<?php echo $sid ?>" />
                                                                        <select name="xm" class="form-control">
                                                                            <option value="">Choose</option>
                                                                            <?php
                                                                            while($rxm1=mysqli_fetch_row($xm1))
                                                                            {
                                                                                ?>
                                                                            <option value="<?php echo $rsl1[0] ?>,<?php echo $rxm1[4] ?>,<?php echo $rxm1[0] ?>"><?php echo $rxm1[2] ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Support File</td>
                                                                    <td><input type="file" name="xup" class="form-control" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                <center>
                                                                    <input type="submit" name="xmark" value="ADD EXTRA MARK" class="btn btn-sm btn-danger" />
                                                                </center>
                                                                    </td>
                                                                </tr>
                                                                        </table>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                <?php                                                                
                                                            $xm=mysqli_query($dbcon,"select * from subcat_xmrk where subid='$sid' and lvlid='$lid'");
                                                            if(mysqli_num_rows($xm)>0)
                                                            {
                                                                while($rxm=mysqli_fetch_row($xm))
                                                                {
                                                                    $z++;
                                                                    ?>
                                                            <tr>
                                                                <td><?php echo $z ?></td>
                                                                <td><b><?php echo $rxm[2] ?></b><br /><?php echo $rxm[3] ?></td>
                                                                <td><?php echo $rxm[4] ?></td>
                                                            </tr>
                                                            <?php
                                                                }
                                                            }
                                                                    ?>
                                                            </table>
                                                                <?php
                                                                
                                                            }
                                                            ?>
                                                        </div>
                                                        <?php
                                                            }
                                                            else{
                                                                header("location:index.php?rn=".encrypt_url($rn));
                                                            }
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                            <center><h3>CATEGORY INFORMATION</h3></center>
                                                            <?php
                                                            $tcount=mysqli_query($dbcon,"select count(lid) from sublevel_settings group by lid");
                                                            $x=0;
                                                            while($rcount=mysqli_fetch_row($tcount))
                                                            {
                                                                $data[$x]=$rcount[0];
                                                                $x++;
                                                            }                                                            
                                                            rsort($data);
                                                            $count=$data[0];
                                                            $sel5=mysqli_query($dbcon,"select * from category_data");
                                                            if(mysqli_num_rows($sel5)>0)
                                                            {
                                                                $i=0;
                                                                ?>
                                                            
                                                            <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
                                                                <?php
                                                                while($r5=mysqli_fetch_row($sel5))
                                                                {
                                                                ?>
                                                                <tr>
                                                                    <td><b><?php echo $r5[1] ?></b></td>                                                                    
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                <?php
                                                                $sel6=mysqli_query($dbcon,"select * from subcategory_data,level_settings where level_settings.lid=subcategory_data.levlid and  subcategory_data.catid='$r5[0]'");
                                                                if(mysqli_num_rows($sel6)>0)
                                                                {
                                                                    ?>
                                                                        <table class="table table-bordered" style="margin-bottom: 1px;">
                                                                        <?php
                                                                    
                                                                    while($r6=mysqli_fetch_row($sel6))
                                                                    {
                                                                        $i++;
                                                                        ?>
                                                                <tr>
                                                                    <td style="width: 3%;"><?php echo $i ?></td>
                                                                    <td style="width: 25%;"><?php echo $r6[2] ?></td>
                                                                    <?php
                                                                    $sel7=mysqli_query($dbcon,"select * from subcat_mrk where subid='$r6[0]'");
                                                                    if(mysqli_num_rows($sel7)>0)
                                                                    {
                                                                        $xcount=mysqli_num_rows($sel7);
                                                                        $span=$count-$xcount;
                                                                        while($r7=mysqli_fetch_row($sel7))
                                                                        {
                                                                            ?>
                                                                    <td colspan="<?php echo $span+1 ?>"><?php echo $r7[2] ?></td>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <td style="width: 15%;"><a class="label label-primary" href="index.php?rn=<?php echo encrypt_url($rn) ?>&sid=<?php echo encrypt_url($r6[0]) ?>"><span class="fa fa-arrow-circle-o-right" style="color: yellow;"></span>  More</a></td>
                                                                   
                                                                </tr>
                                                                <?php
                                                                    }
                                                                    ?>
                                                                        </table>
                                                                <?php
                                                                }
                                                                ?>
                                                                    </td>
                                                                </tr>
                                                                        <?php
                                                                }
                                                                ?>
                                                            </table>
                                                            <?php
                                                            }
                                                            else{
                                                                echo"No Data Found";
                                                            }
                                                        }
                                                            ?>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<?php                                                                            
                                include '../admin/footer.php';
                                ?>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="../admin/assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="../admin/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../admin/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../admin/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="../admin/assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="../admin/assets/js/jquery-ui.custom.min.js"></script>
		<script src="../admin/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../admin/assets/js/jquery.easypiechart.min.js"></script>
		<script src="../admin/assets/js/jquery.sparkline.index.min.js"></script>
		<script src="../admin/assets/js/jquery.flot.min.js"></script>
		<script src="../admin/assets/js/jquery.flot.pie.min.js"></script>
		<script src="../admin/assets/js/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->
		<script src="../admin/assets/js/ace-elements.min.js"></script>
		<script src="../admin/assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: ace.vars['old_ie'] ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
				});
			
			
			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});
			
			
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if(ace.vars['touch'] && ace.vars['android']) {
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				  });
				}
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
			
			
				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();
			
					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
				});
			
			})
		</script>
	</body>
</html>
