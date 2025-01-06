<?php 
$idd = $_GET['id'];
include('ini/header.php');
include('dbcon.php');
$sql = "SELECT * FROM supplier WHERE id = $idd";
$run = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($run);
?>

<h1 class="text-center">Update Supplier :</h1>
        <div class="row">
            <div class="col-md-6 offset-3 card text-success" style="background: white; font-weight: bold;">
                <div class="card-body">
                    	<form method="post" action="" enctype="multipart/form-data" class="container">
						    <label class="form-group">Supplier Name :</label>
						    <input type="text" name="sup_name" required="" value="<?php echo $data['sup_name'] ?>" class="form-control"><br>
						    <label class="form-group">Supplier Address :</label>
						    <input type="text" name="sup_add" required="" value="<?php echo $data['sup_add'] ?>" class="form-control"><br>
						    <label class="form-group">Supplier Phone :</label>
						    <input type="text" name="sup_phone" required="" value="<?php echo $data['sup_phone'] ?>" class="form-control"><br>
						    <label class="form-group">Supplier Email :</label>
						    <input type="text" name="sup_email" required="" value="<?php echo $data['sup_email'] ?>" class="form-control"><br>
						    <label class="form-group">Supplier Photo :</label>
						    <input type="file" name="sup_photo" class="form-control"><br>
						    <input type="submit" name="submit" class="btn btn-success form-control">
						</form>

                    </div>
                </div>

            </div>


<?php
include('ini/footer.php');
 if ((isset($_POST['submit']))) {
	$sup_name = $_POST['sup_name'];
    $sup_add = $_POST['sup_add'];
	$sup_phone = $_POST['sup_phone'];
    $sup_email = $_POST['sup_email'];
    $sup_photo = $_FILES['sup_photo']['name'];
    $tmp_name = $_FILES['sup_photo']['tmp_name'];
   	$upload_path = 'img/supplier/';
    $upload_check = move_uploaded_file($tmp_name, $upload_path.$sup_photo);

    if ($upload_check == 0) {
        echo "<script>window.alert('Faild to load files');</script>";
    }else{
        $sql = "UPDATE  supplier SET sup_name = '$sup_name', sup_add = '$sup_add', sup_phone = '$sup_phone', sup_email = '$sup_email', sup_photo = '$sup_photo' WHERE id = $idd";

        $run = mysqli_query($con,$sql);
        if ($run) {
           echo "
			<script>
	           window.alert('Updated');
	           window.open('view_sup.php','_self');
	        </script>";
        }else{
            ?>
            <script>
               swal("Error!!","data update error","error");
            </script>
            <?php
        }
    }
}


?>