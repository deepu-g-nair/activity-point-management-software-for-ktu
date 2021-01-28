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
    $c=  encrypt_url($_POST['crs']);
    $d=  encrypt_url($_POST['dep']);
    $ay=  encrypt_url($_POST['ay']);
    header("location:add-student.php?c=$c&d=$d&ay=$ay");
}
if(isset($_POST['addstud']))
{
    $cid=  decrypt_url($_GET['c']);
    $did=  decrypt_url($_GET['d']);
    $ay=  decrypt_url($_GET['ay']);
    $sn=$_POST['sn'];
    $rn=$_POST['rn'];
    $adn=$_POST['adn'];
    $addr=$_POST['addr'];
    $con=$_POST['con'];
    $fn=$_POST['fn'];
    $pcon=$_POST['pcon'];
    $gn=$_POST['gn'];
    $bg=$_POST['bg'];
    $pas="student";
    $dob=$_POST['dob'];
    if($_FILES['up']['name'])
    {
        $up=$_FILES['up']['name'];
        $nfn=$rn."".substr($up,strrpos($up,"."));
        if(move_uploaded_file($_FILES['up']['tmp_name'], getcwd()."\\studpic\\$nfn"))
        {           
            $insstud=mysqli_query($dbcon,"INSERT INTO `student_data`(`cid`, `did`, `ay`, `sem`, `nme`, `rol_num`, `adm_num`, `addr`, `con`, `fath_nme`, `pcon`, `gndr`, `bg`, `pic`, `dob`, `st`) VALUES ('$cid','$did','$ay','0','$sn','$rn','$adn','$addr','$con','$fn','$pcon','$gn','$bg','$nfn','$dob','1')");
        }
    }
    else{
        $nfn="nopic.jpg";
        $insstud=mysqli_query($dbcon,"INSERT INTO `student_data`(`cid`, `did`, `ay`, `sem`, `nme`, `rol_num`, `adm_num`, `addr`, `con`, `fath_nme`, `pcon`, `gndr`, `bg`, `pic`, `dob`, `st`) VALUES ('$cid','$did','$ay','0','$sn','$rn','$adn','$addr','$con','$fn','$pcon','$gn','$bg','$nfn','$dob','1')");
    }
    if($insstud>0)
    {
        $inslog=mysqli_query($dbcon,"INSERT INTO `user_login`(`uid`, `pas`, `typ`, `st`) VALUES ('$rn','$pas','student','1')");
        if($inslog>0)
        {
            header("location:add-student.php?suc=1&c=".  encrypt_url($cid)."&d=".  encrypt_url($did)."&ay=".  encrypt_url($ay));
        }
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
					<li class="">
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
                                        
					<li class="open">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text">
								Manage Students
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="active">
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
									Add Students
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
                                                    <div class="col-xs-12">
                                                        <?php
                                                        if(isset($_GET['c']))
                                                        {
                                                            $cid=  decrypt_url($_GET['c']);
                                                            $did=  decrypt_url($_GET['d']);
                                                            $ay=  decrypt_url($_GET['ay']);
                                                            $selcrs=mysqli_query($dbcon,"select * from course_data where crsid='$cid'");
                                                            $rcrs=mysqli_fetch_row($selcrs);
                                                            $seldep=mysqli_query($dbcon,"select * from dep_data where depid='$did'");
                                                            $rdep=mysqli_fetch_row($seldep);
                                                            $msg="$rcrs[1] - $rdep[2] - $ay";
                                                           ?>
                                                        <div class="col-md-6">
                                                            <form method="post" enctype="multipart/form-data">
                                                            <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
                                                                <tr>
                                                                    <td colspan="2"><center><b><?php echo strtoupper($msg) ?></b></center></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Name</td>
                                                                    <td><input type="text" name="sn" class="form-control" required="required" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>KTU Roll Number</td>
                                                                    <td><input type="text" name="rn" class="form-control" required="required" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Admission Number</td>
                                                                    <td><input type="text" name="adn" class="form-control" required="required" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Address</td>
                                                                    <td><textarea name="addr" class="form-control" required="required"></textarea></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Contact Number</td>
                                                                    <td><input type="text" name="con" class="form-control" required="required" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Fathers Name</td>
                                                                    <td><input type="text" name="fn" class="form-control" required="required" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Parent Contact Number</td>
                                                                    <td><input type="text" name="pcon" class="form-control" required="required" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gender</td>
                                                                    <td><input type="radio" name="gn" value="Male" /> Male
                                                                    <input type="radio" name="gn" value="Female" /> Female
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Blood Group</td>
                                                                    <td>
                                                                        <select name="bg" class="form-control" required="required">
                                                                            <option>O+</option>
                                                                            <option>O-</option>
                                                                            <option>A+</option>
                                                                            <option>A-</option>
                                                                            <option>B+</option>
                                                                            <option>B-</option>
                                                                            <option>AB+</option>
                                                                            <option>AB-</option>
                                                                        </select>                                                                        
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Date of Birth</td>
                                                                    <td><input type="date" name="dob" class="form-control" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Photo</td>
                                                                    <td><input type="file" name="up" class="form-control" /></td>
                                                                </tr>
                                                                <tr>
                                                                <td colspan="2"><center>                                                                
                                                                    <input type="submit" name="addstud" value="ADD STUDENT" class="btn btn-success btn-sm" />
                                                                </center>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                                <center>
                                                                    <?php
                                                                    if(isset($_GET['suc']))
                                                                    {
                                                                        ?>
                                                                    <span class="label label-success">SUCCESSFULLY ADDED</span>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </center>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <?php
                                                            $sel_stud=mysqli_query($dbcon,"select * from student_data where cid='$cid' and did='$did' and ay='$ay'");
                                                            if(mysqli_num_rows($sel_stud)>0)
                                                            {
                                                                ?>
                                                            <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
                                                                <tr>
                                                                    <td>#</td>
                                                                    <td>Student Name</td>
                                                                    <td>Contact Details</td>
                                                                </tr>
                                                                <?php
                                                                $i=0;
                                                                while($rstud=mysqli_fetch_row($sel_stud))
                                                                {
                                                                    $i++;
                                                                    ?>
                                                                <tr>
                                                                    <td><?php echo $i ?></td>
                                                                    <td><b><?php echo $rstud[5] ?></b><br />
                                                                    <?php
                                                                    if($rstud[12]=="Male")
                                                                    {
                                                                        echo"S/o ";
                                                                    }
                                                                    else{
                                                                        echo"D/o ";
                                                                    }
                                                                    echo $rstud[10];
                                                                    ?>                                                                        
                                                                    </td>
                                                                    <td><?php echo $rstud[9] ?><br />
                                                                    <?php echo $rstud[11] ?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </table>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                                echo"No Data Found";
                                                            }
                                                            ?>
                                                        </div>                                                        
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <div class="col-md-3"></div>
                                                        <div class="col-md-6">
                                                            <form method="post" enctype="multipart/form-data">
                                                                <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
                                                                    <tr>
                                                                        <td colspan="2">
                                                                    <center>
                                                                        <b>ADD STUDENTS HERE</b>
                                                                    </center>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                    <td>Course</td>
                                                                    <td>
                                                                        <select name="crs" class="form-control" onchange="loaddep(this.value)" required="required">
                                                                            <option value="">Choose Course</option>
                                                                            <?php
                                                                            $sel_c=mysqli_query($dbcon,"select * from course_data order by crs_nme asc");
                                                                            if(mysqli_num_rows($sel_c)>0)
                                                                            {
                                                                                while($rc=mysqli_fetch_row($sel_c))
                                                                                {
                                                                                    ?>
                                                                            <option value="<?php echo $rc[0] ?>"><?php echo $rc[1] ?></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <script>
                                                                function loaddep(x)
                                                                {
                                                                    var xmlhttp = new XMLHttpRequest();
                                                                    xmlhttp.onreadystatechange = function() {
                                                                        if (this.readyState == 4 && this.status == 200) {
                                                                            document.getElementById("dep2").innerHTML = this.responseText;
                                                                        }
                                                                    };
                                                                    xmlhttp.open("GET", "loaddep1.php?q=" + x, true);
                                                                    xmlhttp.send();
                                                                }            
                                                            </script>
                                                            <tr>
                                                                <td>Department</td>
                                                                <td>
                                                                    <div id="dep2">
                                                                        <select name="dep" class="form-control" required="required">
                                                                            <option>Choose Department</option>                                                                        
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Academic Year</td>
                                                                <td>
                                                                    <select name="ay" class="form-control" required="required">
                                                                        <?php
                                                                        $yr=date('Y');
                                                                        for($i=$yr;$i>=$yr-5;$i--)
                                                                        {
                                                                            ?>
                                                                        <option><?php echo $i ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>                                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"><center>                                                                
                                                                    <input type="submit" name="sub" value="ADD STUDENT" class="btn btn-success btn-sm" />
                                                            </center>
                                                                </td>
                                                                
                                                            </tr>
                                                                </table>
                                                        </div>
                                                        <div class="col-md-3"></div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div><!-- /.col -->
						</div><!-- /.row -->
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