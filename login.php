<?php
include './dbconnection.php';
if(isset($_POST['login']))
{
    $uid=$_POST['log_uid'];
    $pas=$_POST['log_pas'];
    $chk=mysqli_query($dbcon,"select * from user_login where uid='$uid' and pas='$pas'");
    if(mysqli_num_rows($chk)>0)
    {
        session_start();
        $rchk=mysqli_fetch_row($chk);
        if($rchk[3]=="admin")
        {
            $_SESSION['adm']=$uid;
            header("location:admin/");
        }
        else if($rchk[3]=="student")
        {
            $_SESSION['stud']=$uid;
            header("location:student/");
        }
        else if($rchk[3]=="staff")
        {
            $_SESSION['stf']=$uid;
            header("location:staff/");
        }
    }
    else{
        header("location:login.php?error=1");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $title ?></title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="admin/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="admin/assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="admin/assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="admin/assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="admin/assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="admin/assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="admin/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="admin/assets/js/html5shiv.min.js"></script>
		<script src="admin/assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
                                                    <div class="center" style="background-color: whitesmoke; padding: 10px; margin-top: 25px;">
                                                            <img src="logo/collegelogo.png" alt="" class="img img-responsive"/>
                                                        </div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">                                                                                  
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-lock green"></i>
												Enter Login Information
											</h4>

											<div class="space-6"></div>

											
												<fieldset>
                                                                                                    <form method="post">                                                                                                        
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
                                                                                                                    <input type="text" name="log_uid" class="form-control" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
                                                                                                                    <input type="password" name="log_pas" class="form-control" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														

                                                                                                            <input type="submit" class="width-35 pull-right btn btn-sm btn-primary" name="login" value="Login Here">
															
														</button>
													</div>
                                                                                                        <b><font color="red">
                                                                                                        <?php
                                                                                                        if(isset($_GET['error']))
                                                                                                        {
                                                                                                            if($_GET['error']==1)
                                                                                                            {
                                                                                                                echo"Invalid User Credentials";
                                                                                                            }
                                                                                                            if($_GET['error']==2)
                                                                                                            {
                                                                                                                echo"Please wait... Your Account Not yet Verified...";
                                                                                                            }
                                                                                                            if($_GET['error']==3)
                                                                                                            {
                                                                                                                echo"Login Blocked by Administrator";
                                                                                                            }
                                                                                                        }
                                                                                                        ?></font></b>
													<div class="space-4"></div>
                                                                                                   
                                                                                                    </form>
												</fieldset>
											
                                                                                                    
											

											<div class="space-6"></div>

											
										</div><!-- /.widget-main -->

                                                                                <div class="clearfix" style="background-color: #08C; padding: 10px; color: white;">
                                                                                    <div style="text-align: center;"><center>
                                                                                            <b>LOURDES MATHA COLLEGE OF SCIENCE AND TECHNOLOGY</b>
                                                                                        </center>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<!-- /.forgot-box -->

								<!-- /.signup-box -->
							</div><!-- /.position-relative -->

							<div class="navbar-fixed-top align-right">
								<br />
								&nbsp;
								<a id="btn-login-dark" href="#">Dark</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="#">Blur</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="#">Light</a>
								&nbsp; &nbsp; &nbsp;
                                                               
							</div>
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="admin/assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="admin/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='admin/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			
			
			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });
			 
			});
		</script>
	</body>
</html>
