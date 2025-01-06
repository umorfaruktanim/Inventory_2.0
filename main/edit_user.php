<?php 
include('ini/header.php');
$idd = $_GET['id'];

$get_user = "SELECT * FROM user WHERE id= $idd";
$run = mysqli_query($con, $get_user);
$data = mysqli_fetch_assoc($run);

?>


<h6 class="text-center">Edit <span class="text-danger"><?php echo $data['s_name'] ?>'s</span> Information</h6>
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
					<input type="text" required="" name="s_name" value="<?php echo $data['s_name'] ?>" class="form-control">
				</div>
				<div class="col-md-4 form-group">
					<label class="text-light"><i style="font-weight: bolder; font-size: 18px;">Father's Name:</i></label>
					<input type="text" required="" name="f_name" value="<?php echo $data['f_name'] ?>" class="form-control">
				</div>
				<div class="col-md-4 form-group">
					<label class="text-light"><i style="font-weight: bolder; font-size: 18px;">Mother's Name:</i></label>
					<input type="text" name="m_name" value="<?php echo $data['m_name'] ?>" class="form-control">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 form-group">
					<label class="text-light"><i style="font-weight: bolder; font-size: 18px;">Date Of Birth</i></label>
					<input type="date" name="dod" value="<?php echo $data['dod'] ?>" required="" class="form-control">
				</div>
				<div class="col-md-4 form-group">
					<label class="text-light"><i style="font-weight: bolder; font-size: 18px;">Blood Group</i></label>
					<select class="form-control" name="blood" required="">
						<option value="<?php echo $data['blood'] ?>"><?php echo $data['blood'] ?></option>
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
						<option value="<?php echo $data['gender'] ?>"><?php echo $data['gender'] ?></option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label class="text-light"><i style="font-weight: bolder; font-size: 18px;">Contact Phone</i></label>
					<input type="text" name="phone" value="<?php echo $data['phone'] ?>" required="" class="form-control" style="width: 400px;">
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
							<input type="text" name="per_careof" required="" value="<?php echo $data['per_careof'] ?>" class="form-control" style="width: 450px;">
							<br>
							<label class="text-dark"><i style="font-weight: bolder; font-size: 20px;">Village /Town /Road:</i></label>
							<input type="text" name="per_village" required="" value="<?php echo $data['per_village'] ?>" class="form-control" style="width: 450px;">
							<br>
							<div class="row">
								<div class="col-md-4">
									<label class="text-dark"><i style="font-weight: bolder; font-size: 20px;">Divison</i></label>
									<input type="text" name="pdivi" value="<?php echo $data['pdivi'] ?>" required="" class="form-control">
								</div>
								<div class="col-md-4">
									<label class="text-dark"><i style="font-weight: bolder; font-size: 20px;">Distrirct</i></label>
									<input type="text" name="pdist" value="<?php echo $data['pdist'] ?>" required="" class="form-control">
								</div>
								<div class="col-md-4">
									<label class="text-dark"><i style="font-weight: bolder; font-size: 20px;">PS/Upzila</i></label>
									<input type="text" name="p_posto" required="" value="<?php echo $data['p_posto'] ?>" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
			
			<p class="text-center mt-5" style="font-weight: bolder; font-size: 28px; color: #fff;">
				Photo
			</p>
			<div class="row">
				<div class="col-md-6 offset-3">
					<input type="file" class="form-control" name="image" required="">
				</div>
			</div>
			<p class="text-center mt-5" style="font-weight: bolder; font-size: 28px; color: #fff;">
				Change Password
			</p>
			<div class="row">
				<div class="col-md-6">
					<label><i class="text-light" style="font-size: 25px; font-weight: bolder;">Password</i></label>
					<input type="text" required="" value="<?php echo $data['password'] ?>" name="password" class="form-control">
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

<?php 
include('ini/footer.php');
if(isset($_POST['submit'])){
    $s_name = $_POST['s_name'];
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $dod = $_POST['dod'];
    $blood = $_POST['blood'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $per_careof = $_POST['per_careof'];
    $per_village = $_POST['per_village'];
    $pdivi = $_POST['pdivi'];
    $pdist = $_POST['pdist'];
    $p_posto = $_POST['p_posto'];
    $password = $_POST['password'];
    $image = $_FILES['image']['name'];
 	$tmp_name = $_FILES['image']['tmp_name'];
 	$upload_path = '../user_img/';
 	$upload_check = move_uploaded_file($tmp_name,$upload_path.$image);
 	if ($upload_check) {
 		$sql = "UPDATE user SET 
                s_name = '$s_name',
                f_name = '$f_name',
                m_name = '$m_name',
                dod = '$dod',
                blood = '$blood',
                gender = '$gender',
                phone = '$phone',
                per_careof = '$per_careof',
                per_village = '$per_village',
                pdivi = '$pdivi',
                pdist = '$pdist',
                p_posto = '$p_posto',
                password = '$password',
                image = '$image'
            WHERE id = '$idd'";

    $exe = mysqli_query($con, $sql);
    if ($exe) {
        echo '<script>
                swal("Updated", "Your Information is updated", "success")
                .then((value) => {
                    window.location.href = "view_user.php?id=' . $idd . '";
                });
              </script>';
    } else {
        echo '<script>swal("Error","Data update error","error");</script>';
    }

 	}

    
}
?>
