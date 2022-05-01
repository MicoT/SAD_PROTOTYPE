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
            html{

            }
            #main {
				position: fixed;
                background: linear-gradient(-45deg, #a72222, #6d1111de, #23a6d5, #23d5ab);
                background-size: 900% 900%;
				translate: (-50%, -50%);
                animation: gradient 15s ease infinite;
                height: 1vh;
            }

            @keyframes gradient {
                0% {
                    background-position: 0% 50%;
                }
                50% {
                    background-position: 100% 50%;
                }
                100% {
                    background-position: 0% 50%;
                }
            }
            .wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            background: rgb(223, 215, 215);
            margin: 10px auto;
            padding: 5px 30px;
            width: 800px;
            box-shadow: 0 0 5px black;
            }

            .hr {
            display: flex;
            align-items: center;
            }

            hr {
            width: 30px;
            height: 1px;
            background: black;
            margin: 0 15px;
            }

            h2 {
            font-size: 25px;
            font-weight: normal;
            text-transform: uppercase;
            }

            .mission-txt {
            font-size: 18px;
            font-weight: 500px;
            font-style: italic;
            margin-top: 0;
            }

            div img {
            width: 150px;
            filter: drop-shadow(0 10px 5px black);
            }

            p {
            text-align: justify;
            }

            .faculties {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 20px;
            }

            .unit {
            margin: 25px;
            width: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            }

            .unit img {
            border-radius: 100px;
            width: 150px;
            height: 150px;
            margin-bottom: 10px;
            }

            .unit p {
            text-align: left;
            margin: 2px;
            }

            .unit p:first-of-type {
            font-weight: bolder;
            margin-bottom: 5px;
            }

            @media screen and (max-width:820px) {
            .wrapper {
                width: 80%;
                padding: 5px 30px;
            }
            }
        </style>
		
	</head>
	<body >
		
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
		
		<!-- 1st section start -->
		<div id="main" class="content-block" style="min-height: 750px; background-color:aqua;">
			<div class="container">
				
            <div class="hr">
        <hr>
        <h2>Our Mission</h2>
        <hr>
      </div>

      <p class="mission-txt">"To Provide Quality Education at Low Cost"</p>

    </div>

    <div class="wrapper">
      <h2>About</h2>
      <div>
        <img src="https://vidyasheela.com/web-contents/website-components/About-Us-Pages/responsive-about-us-page-html/teaching.png" alt="img">
        <p>A school is an educational institution designed to provide learning spaces and learning environments for the teaching of students under the direction of teachers. Most countries have systems of formal education, which is sometimes compulsory.
          teenagers who have completed primary education. An institution where higher education is taught, is commonly called a university college or university. </p>
        <p>A school is an educational institution designed to provide learning spaces and learning environments for the teaching of students under the direction of teachers. Most countries have systems of formal education, which is sometimes compulsory.
          teenagers who have completed primary education. An institution where higher education is taught, is commonly called a university college or university. </p>

      </div>
    </div>

    <div class="wrapper">
      <h2>Faculties</h2>
      <div class="faculties">
        <div class="unit">
          <img src="https://vidyasheela.com/web-contents/website-components/About-Us-Pages/responsive-about-us-page-html/Director.jpg" alt="">
          <p>Jona Chen, Director</p>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus unde aliquid laborum voluptatum distinctio nobis?'</p>

        </div>
        <div class="unit">
          <img src="https://vidyasheela.com/web-contents/website-components/About-Us-Pages/responsive-about-us-page-html/Principal.jpg" alt="">
          <p>Mathew Tram, Principal</p>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus unde aliquid laborum voluptatum distinctio nobis?'</p>

        </div>
        <div class="unit">
          <img src="https://vidyasheela.com/web-contents/website-components/About-Us-Pages/responsive-about-us-page-html/vice-principal.jpg" alt="">
          <p>Lawn Sethi, Vice Principal</p>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus unde aliquid laborum voluptatum distinctio nobis?'</p>
        </div>
      </div>
    </div>

				<!-- /.row -->
			</div>
		</div>
		<!-- first section end -->
		<!-- forth sections start -->
		
		<!-- forth section end -->
		
		<!-- footer start -->
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