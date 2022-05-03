<?php
session_start();
include_once '../asset/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}

$usersession = $_SESSION['patientSession'];


$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient=".$usersession);

if ($res===false) {
	echo mysqli_error();
} 

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Patient Dashboard</title>
		<link href="assets/css/material.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/default/blocks.css">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/mypatcss.css">
		<link rel="stylesheet" href="assets/css/mycss.css">

		<!-- favicon  -->
        <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
        <link rel="manifest" href="assets/img/site.webmanifest">
		<script src="https://kit.fontawesome.com/f165d3da56.js" crossorigin="anonymous"></script>

		<style>
            @import url('https://fonts.googleapis.com/css?family=Allura|Josefin+Sans');

			*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			}

			body{
			background-image: url("assets/img/repeat.jpg");
			font-family: 'Josefin Sans', sans-serif;
			overflow-x: hidden;
			}

			.wrapper{
			margin-top: 10%;
			}

			.next{
			margin-top: 5%;
			padding-bottom: 10%;
			}

			.wrapper h1{
			
			font-size: 52px;
			margin-bottom: 60px;
			text-align: center;
			
			border-radius: 10px;
			padding: 10px;
			margin-left: 650px;
			margin-right: 650px;
			color: red;
			}

			.team{
			display: flex;
			justify-content: center;
			width: auto;
			text-align: center;
			flex-wrap: wrap;
			}

			.team .team_member{
			border: solid;
			background: #fff;
			margin: 5px;
			margin-bottom: 50px;
			width: 300px;
			padding: 20px;
			line-height: 20px;
			color: #8e8b8b;  
			position: relative;
			}

			.team .team_member h3{
			color: black;
			font-size: 26px;
			margin-top: 50px;
			}

			.team .team_member p.role{
			color: red;
			margin: 12px 0;
			font-size: 12px;
			text-transform: uppercase;
			}

			.team .team_member .team_img{
			position: absolute;
			top: -50px;
			left: 50%;
			transform: translateX(-50%);
			width: 100px;
			height: 100px;
			border-radius: 50%;
			background: #fff;
			}

			.team .team_member .team_img img{
			width: 100px;
			height: 100px;
			padding: 5px;
			border-radius: 50%;
			border: solid;
			}
        </style>
		
	</head>
	<body >
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0" nonce="v51P6Yn2"></script>	
		<!-- navigation -->
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<a class="navbar-brand" href="patient.php"><img alt="Brand" src="assets/img/logo.jpg" height="80px" style="margin-right: 10px;"></a>
				<a href="#" id="logo"><span>Dynamic</span> Process</a>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                </div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-left"style="margin-left: 10px;">
						<ul class="nav navbar-nav">
							<li><a href="patient.php">Home</a></li>
							<!-- <li><a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>" >Profile</a></li> -->
							<li><a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>">Appointment</a></li>
                            <li><a href="about.php?patientId=<?php echo $userRow['icPatient']; ?>">About Us</a></li>
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
								</li>
								<li>
									<a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="fa-solid fa-file"></i> Appointment</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="patientlogout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- navigation -->
		
		<div class="wrapper row" style="">
		<h1>	Bangkal Branch</h1>
		<div class="team">
			<div class="team_member">
			<div class="team_img">
				<img src="assets/img/none.webp" alt="Team_image">
			</div>
			<h3>Meg Saavedra</h3>
			<p class="role">OTRP (Head/ Owner)</p>
			</div>
			<div class="team_member">
			<div class="team_img">
				<img src="assets/img/none.webp" alt="Team_image">
			</div>
			<h3>Allysha Arranguez</h3>
			<p class="role">OTRP (Junior OT staff) </p>
			</div>
			<div class="team_member">
			<div class="team_img">
				<img src="assets/img/none.webp" alt="Team_image">
			</div>
			<h3>Vannesa Abueva</h3>
			<p class="role">OTRP (Junior OT staff) </p>
			</div>
		</div>
		</div>	
		<div class="wrapper row next">
		<div class="team">
		<div class="team_member">
			<div class="team_img">
				<img src="assets/img/none.webp" alt="Team_image">
			</div>
			<h3>Rachelle Sereno</h3>
			<p class="role">Secretary</p>
			</div>
			<div class="team_member">
			<div class="team_img">
				<img src="assets/img/none.webp" alt="Team_image">
			</div>
			<h3>Gwayne Mosquida</h3>
			<p class="role">OTRP (OT staff)</p>
			</div>
			<div class="team_member">
			<div class="team_img">
				<img src="assets/img/none.webp" alt="Team_image">
			</div>
			<h3>Micah Superio</h3>
			<p class="role">LPT (Sped staff)</p>
			</div>
		</div>
		</div>	
		<div class="wrapper row next" style="">
		<h1>Toril Branch</h1>
		<div class="team">
			<div class="team_member">
			<div class="team_img">
				<img src="assets/img/none.webp" alt="Team_image">
			</div>
			<h3>Nikki Militar</h3>
			<p class="role">OT Staff</p>
			</div>
			<div class="team_member">
			<div class="team_img">
				<img src="assets/img/none.webp" alt="Team_image">
			</div>
			<h3>Cecil Tabanao</h3>
			<p class="role">Secretary</p>
			</div>
			<div class="team_member">
			<div class="team_img">
				<img src="assets/img/none.webp" alt="Team_image">
			</div>
			<h3>Catherine Santos</h3>
			<p class="role">OTRP (OT staff)</p>
			</div>
		</div>
		</div>
		<div class="copyright-bar bg-black foot" style="position: fixed;">
			<div class="container">
				<p class="small" style="display:flex;justify-content:center">© T&T SOLUTIONS</p>
				
			</div>
		</div>
		<!-- footer end -->
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/date/bootstrap-datepicker.js"></script>
		<script src="assets/js/moment.js"></script>
		<script src="assets/js/transition.js"></script>
		<script src="assets/js/collapse.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- date start -->
		<script>
		$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		})
		})
		</script>
		<!-- date end -->
		
		
	</body>
</html>