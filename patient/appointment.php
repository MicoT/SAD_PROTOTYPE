<?php
session_start();
include_once '../asset/conn/dbconnect.php';
$session= $_SESSION['patientSession'];
// $appid=null;
// $appdate=null;
if (isset($_GET['scheduleDate']) && isset($_GET['appid'])) {
	$appdate =$_GET['scheduleDate'];
	$appid = $_GET['appid'];
}
// on b.icPatient = a.icPatient
$res = mysqli_query($con,"SELECT a.*, b.* FROM doctorschedule a INNER JOIN patient b
WHERE a.scheduleDate='$appdate' AND scheduleId=$appid AND b.icPatient=$session");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);


	
//INSERT
if (isset($_POST['appointment'])) {
$patientIc = mysqli_real_escape_string($con,$userRow['icPatient']);
$scheduleid = mysqli_real_escape_string($con,$appid);
$symptom = mysqli_real_escape_string($con,$_POST['symptom']);
$comment = mysqli_real_escape_string($con,$_POST['comment']);
$avail = "notavail";


$query = "INSERT INTO appointment (  patientIc , scheduleId , appSymptom , appComment  )
VALUES ( '$patientIc', '$scheduleid', '$symptom', '$comment') ";

//update table appointment schedule
$sql = "UPDATE doctorschedule SET bookAvail = '$avail' WHERE scheduleId = $scheduleid" ;
$scheduleres=mysqli_query($con,$sql);
if ($scheduleres) {
	$btn= "disable";
} 


$result = mysqli_query($con,$query);
// echo $result;
if( $result )
{
?>
<script type="text/javascript">
alert('Appointment made successfully.');
</script>
<?php
header("Location: patientapplist.php");
}
else
{
	echo mysqli_error($con);
?>
<script type="text/javascript">
alert('Appointment booking fail. Please try again.');
</script>
<?php
header("Location: patient/patient.php");
}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		
		<title>Make Appoinment</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rcel="stylesheet">

		<link rel="stylesheet" href="assets/css/mycss.css">
		<script src="https://kit.fontawesome.com/f165d3da56.js" crossorigin="anonymous"></script>

		<!-- favicon  -->
        <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
        <link rel="manifest" href="assets/img/site.webmanifest">
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
			.popup_box_disclaimer{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			border-radius: 5px;
			}
			.popup_box_disclaimer{
			width: 400px;
			background: #f2f2f2;
			text-align: center;
			align-items: center;
			padding: 50px;
			border: 1px solid #b3b3b3;
			box-shadow: 0px 5px 10px rgba(0,0,0,.2);
			z-index: 9999;
			display: none;
			}
			.popup_box_disclaimer i{
			font-size: 60px;
			color: #eb9447;
			padding: 20px 40px;
			margin: -10px 0 20px 0;
			}
			.popup_box_disclaimer h1{
			font-size: 30px;
			color: #1b2631;
			margin-bottom: 5px;
			}
			.popup_box_disclaimer label{
			font-size: 23px;
			color: #404040;
			}
			.popup_box_notif .confirm{
			margin: 40px 0 0 0;
			}
			.confirm .confirm-btn{
			background: #999999;
			color: white;
			font-size: 18px;
			border-radius: 5px;
			border: 1px solid #808080;
			padding: 10px 13px;
			}
			.confirm .confirm-btn{
			margin-left: 20px;
			background: #ff3333;
			border: 1px solid #cc0000;
			}
			.confirm :hover{
			transition: .5s;
			background: #8c8c8c;
			}
			.confirm .confirm-btn:hover{
			transition: .5s;
			background: #e60000;
			}

			.popup_box_notif{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			border-radius: 5px;
			}
			.popup_box_notif{
			width: 400px;
			background: #f2f2f2;
			text-align: center;
			align-items: center;
			padding: 40px;
			border: 1px solid #b3b3b3;
			box-shadow: 0px 5px 10px rgba(0,0,0,.2);
			z-index: 9999;
			display: none;
			}
			.popup_box_notif i{
			font-size: 60px;
			color: #eb9447;
			padding: 20px 40px;
			border-radius: 50%;
			margin: -10px 0 20px 0;
			}
			.popup_box_notif h1{
			font-size: 30px;
			color: #1b2631;
			margin-bottom: 5px;
			}
			.popup_box_notif label{
			font-size: 23px;
			color: #404040;
			}
			.popup_box_notif .close{
			margin: 40px 0 0 0;
			}
			.close .close-btn{
			color: white;
			font-size: 18px;
			border-radius: 5px;
			padding: 10px 13px;
			}
			.close .close-btn{
			margin-left: 20px;
			background: #ff3333;
			border: 1px solid #cc0000;
			}

			.close .close-btn:hover{
			transition: .5s;
			background: #e60000;
			}
		</style>
	</head>
	<body>
		<!-- navigation -->
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid" style="background-color: white;">
				<!-- Brand and toggle get grouped for better mobile display -->
				<a class="navbar-brand" href="patient.php"><img alt="Brand" src="assets/img/logo.jpg" height="100px"></a>
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
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<li><a href="patient.php">Home</a></li>
							<!-- <li><a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>" >Profile</a></li> -->
							<li><a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>">Appointment</a></li>
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
		<div class="container">
			<section style="padding-bottom: 50px; padding-top: 50px;">
				<div class="row">
					<!-- start -->
					<!-- USER PROFILE ROW STARTS-->
					<div class="row">
					
						
						<div class="col-md-12 col-sm-9  user-wrapper">
							<div class="description">
								
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<form class="form" role="form" method="POST" accept-charset="UTF-8">
											<div class="panel panel-default">
												<div class="panel-heading">Patient Information</div>
												<div class="panel-body">
													
													Patient Name: <?php echo $userRow['patientFirstName'] ?> <?php echo $userRow['patientLastName'] ?><br>
													Patient ID: <?php echo $userRow['icPatient'] ?><br>
													Contact Number: <?php echo $userRow['patientPhone'] ?><br>
													Address: <?php echo $userRow['patientAddress'] ?>
												</div>
											</div>
											<div class="panel panel-default">
												<div class="panel-heading">Appointment Information</div>
												<div class="panel-body">
													Therapist: <?php echo $userRow['scheduleDay'] ?><br>
													Branch: <?php echo $userRow['Branch'] ?><br>
													Date: <?php echo $userRow['scheduleDate'] ?><br>
													Time: <?php echo $userRow['startTime'] ?> - <?php echo $userRow['endTime'] ?><br>
												</div>
											</div>
											
											<div class="form-group">
												<label for="recipient-name" class="control-label">Required Therapy:</label>
													<select iclass="form-control" name="symptom" required>
														<option value="Occupational">Occupational Therapy</option>
														<option value="Speech">Speech Language Therapy</option>
													</select>
											</div>
											<div class="form-group">
												<label for="message-text" class="control-label">Additional Information:</label>
												<textarea class="form-control" name="comment" required></textarea>
											</div>
												<a href="#" class="btn btn-danger notif">Make Appointment</a>
												<a href="patient.php" class="btn btn-danger">Cancel</a>
											<div class="popup_box_notif modal-fade" style="position:fixed;">
                                            <i class="fa-solid fa-circle-check"></i>
                                            <h5 style="color: black">You have an appointment on <?php echo $userRow['scheduleDate'] ?>, at <?php echo $userRow['startTime'] ?>. The Appointment will take place at our branch in <?php echo $userRow['Branch'] ?>. Please let us know in advance if you cannot make it at +63 921 391 0361 or contact our email: dynamicprocesstherapycenter@gmail.com </h5>
                                            <div class="close">
                                                <button class=" close-btn btn-danger"type="submit" name="appointment" id="submit" type="submit">Confirm</button>
                                            </div>
										</form>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->
					<script src="assets/js/jquery.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
			<script>
        $(document).ready(function(){
            $('.click').click(function(){
            $('.popup_box_disclaimer').css("display", "block");
            });
            $('.confirm-btn').click(function(){
            $('.popup_box_disclaimer').css("display", "none");
            });
            $('.notif').click(function(){
            $('.popup_box_notif').css("display", "block");
            });
            $('.close-btn').click(function(){
            $('.popup_box_notif').css("display", "none");
            });
        });
    	</script>
				</body>
			</html>