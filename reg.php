<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script type="text/javascript" src="assets/js/sweetalert.min.js"></script>
</head>
<body>
<h3 class="text-center">User Registrion Apply Form</h3>
<p class="text-center" style="font-size: 20px;">Inventory Management System 2.0  <a href="index.php">Login</a></p>

<marquee class="text-danger" style="font-weight: bolder;">
PLEASE PROVIDE RIGHT INFORMATION OTHERWISE YOUR APPLICATION WILL DECLINE
</marquee>
<h6 class="text-center">For Submition Instarction Contact <span><a href="https://www.facebook.com/omorfaruk.tanim/">TANIM</a></h6>
<div class="main-content container bg-success mb-5">
	<div class="row">
			<div class="col-md-6">
				<p style="color:white;font-size:24px; font-weight: bolder; width: 300px;" class="text-center offset-10">Personal Information : </p>
			</div>
		</div>
		<form class="pb-3" action="" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-4 form-group">
					<label class="text-light"><i style="font-weight: bolder; font-size: 18px;">User Name:</i></label>
					<input type="text" required="" name="s_name" placeholder="Enter your Name" class="form-control">
				</div>
				<div class="col-md-4 form-group">
					<label class="text-light"><i style="font-weight: bolder; font-size: 18px;">Father's Name:</i></label>
					<input type="text" required="" name="f_name" placeholder="Enter your Father Name" class="form-control">
				</div>
				<div class="col-md-4 form-group">
					<label class="text-light"><i style="font-weight: bolder; font-size: 18px;">Mother's Name:</i></label>
					<input type="text" name="m_name" placeholder="Enter your Mother Name" class="form-control">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 form-group">
					<label class="text-light"><i style="font-weight: bolder; font-size: 18px;">Date Of Birth</i></label>
					<input type="date" name="dod" required="" class="form-control">
				</div>
				<div class="col-md-4 form-group">
					<label class="text-light"><i style="font-weight: bolder; font-size: 18px;">Blood Group</i></label>
					<select class="form-control" name="blood" required="">
						<option value=''>Select Blood Group</option>
						<option value="A+">A+</option>
						<option value="AB+">AB+</option>
						<option value="B+">B+</option>
						<option value="A-">A-</option>
						<option value="AB-">AB-</option>
						<option value="O+">O+</option>
						<option value="O-">O-</option>
						<option value="B+">B+</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 form-group">
					<label class="text-light"><i style="font-weight: bolder; font-size: 18px;">Gender</i><select class="form-control" name="gender" required="">
						<option value=''>Select Gender</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label class="text-light"><i style="font-weight: bolder; font-size: 18px;">Contact Phone</i></label>
					<input type="text" name="phone" required="" class="form-control" style="width: 400px;">
				</div>
			</div>
			<p style="color:white;font-size:28px; font-weight: bolder;" class="ml-2 mt-5">Address:</p>
			<div class="row">
				<div class="col-md-6">
					<div  class="card">
						<div class="card-header">
							<h4>Permanent Address</h4>
						</div>
						<div class="card-body">
							<label class="text-dark"><i style="font-weight: bolder; font-size: 20px;"><br> Care of</i>
							<input type="text" name="per_careof" required="" class="form-control" style="width: 450px;">
							<br>
							<label class="text-dark"><i style="font-weight: bolder; font-size: 20px;">Village /Town /Road:</i></label>
							<input type="text" name="per_village" required="" class="form-control" style="width: 450px;">
							<br>
							<div class="row">
								<div class="col-md-4">
									<label class="text-dark"><i style="font-weight: bolder; font-size: 20px;">Divison</i></label>
									<input type="text" name="pdivi" required="" class="form-control">
								</div>
								<div class="col-md-4">
									<label class="text-dark"><i style="font-weight: bolder; font-size: 20px;">Distrirct</i></label>
									<input type="text" name="pdist" required="" class="form-control">
								</div>
								<div class="col-md-4">
									<label class="text-dark"><i style="font-weight: bolder; font-size: 20px;">PS/Upzila</i></label>
									<input type="text" name="p_posto" required="" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
			
			<p class="text-center mt-5" style="font-weight: bolder; font-size: 28px; color: #fff;">
				Users Photo
			</p>
			<div class="row">
				<div class="col-md-6 offset-3">
					<input type="file" class="form-control" name="image" required="">
				</div>
			</div>
			<p class="text-center mt-5" style="font-weight: bolder; font-size: 28px; color: #fff;">
				Users NID Photo
			</p>
			<div class="row">
				<div class="col-md-6 offset-3">
					<input type="file" class="form-control" name="nid" required="">
					<label class="text-danger" style="font-weight: bolder;">Clear NID front photo if it's not your application will decline</label>
				</div>
			</div>
			<p class="text-center mt-5" style="font-weight: bolder; font-size: 28px; color: #fff;">
				Users Account
			</p>
			<div class="row mt-5">
				<div class="col-md-6">
					<label><i class="text-light" style="font-size: 25px; font-weight: bolder;">Email</i></label>
					<input type="email" required="" name="email" placeholder="enter your email" class="form-control">
				</div>
				<div class="col-md-6">
					<label><i class="text-light" style="font-size: 25px; font-weight: bolder;">Password</i></label>
					<input type="password" required="" name="password" class="form-control">
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-md-6">
					<button class="btn btn-primary form-control" name="submit">Submit</button>
				</div>
				<div class="col-md-6">
					<button class="btn btn-danger form-control" type="reset"><a href="" style="color:#fff; text-decoration: none;">Clear All</a></button>
				</div>
			</div>
		</form>
</div>
</body>
</html>

<?php 
 	if (isset($_POST['submit'])) {
 		$s_name = $_POST['s_name'];
 		$f_name = $_POST['f_name'];
 		$m_name =$_POST['m_name'];
 		$dod = $_POST['dod'];
 		$blood = $_POST['blood'];
 		$gender = $_POST['gender'];
 		$phone = $_POST['phone'];
 		$per_careof = $_POST['per_careof'];
 		$per_village = $_POST['per_village'];
 		$pdivi = $_POST['pdivi'];
 		$pdist = $_POST['pdist'];
 		$p_posto = $_POST['p_posto'];
 		$email = $_POST['email'];
 		$password = $_POST['password'];
 		$image = $_FILES['image']['name'];
 		$tmp_name = $_FILES['image']['tmp_name'];
 		$upload_path = 'user_img/';
 		$upload_check = move_uploaded_file($tmp_name,$upload_path.$image);

 		$nid = $_FILES['nid']['name'];
 		$nidtmp_name = $_FILES['nid']['tmp_name'];
 		$nidupload_path = 'user_img/nid/';
 		$upload_check1 = move_uploaded_file($nidtmp_name,$nidupload_path.$nid);

 		if ($upload_check && $upload_check1) {
 			include('dbcon.php');

 		$chk_email = "SELECT * FROM user WHERE email = '$email'";

 		$chk_run = mysqli_query($con,$chk_email);

 		if(mysqli_num_rows($chk_run)!=0){
 			?>
				<script>
					swal("This Email Already Registered","Please go to login page and login","error");
				</script>
			<?php 
 		}else{

 		$sql = "INSERT INTO `user`(`s_name`, `f_name`, `m_name`, `dod`, `blood`, `gender`, `phone`,`per_careof`, `per_village`, `pdivi`, `pdist`, `p_posto`, `image`, `nid`, `email`, `password`)

 			 VALUES ('$s_name','$f_name','$m_name','$dod','$blood','$gender','$phone','$per_careof','$per_village','$pdivi','$pdist','$p_posto','$image','$nid', '$email','$password')";

 		$exe = mysqli_query($con,$sql);
 		if ($exe == true) {
				?>
				<script>
					swal("Data Submitted","You will be get an email from our us about your approval","success");
				</script>
			<?php 		

			}else{
 			echo "Error";

 			}
 		}
 	}
 		
 }

 ?>