<?php 
$idd = $_GET['id'];
include('ini/header.php');
include('dbcon.php');
$sql = "SELECT * FROM category WHERE cat_id = $idd";
$run = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($run);
?>

<h1 class="text-center">Update Category :</h1>
        <div class="row">
            <div class="col-md-6 offset-3 card text-success" style="background: white; font-weight: bold;">
                <div class="card-body">
                    	<form method="post" action="" enctype="multipart/form-data" class="container">
                                <label class="form-group">Category Name :</label>
       							<input type="text" name="cat_name" required="" value="<?php echo $data['cat_name'] ?>" class="form-control"><br>
                               
                                <input type="submit" name="submit" class="btn btn-success form-control">
                            </form>
                    </div>
                </div>

            </div>


<?php
include('ini/footer.php');
 if ((isset($_POST['submit']))) {
	$cat_name = $_POST['cat_name'];

	$sql = "UPDATE category SET cat_name = '$cat_name' WHERE cat_id = $id";

	include('dbcon.php');
	$run = mysqli_query($con,$sql);
	if ($run) {
		echo "
			<script>
	           window.alert('Updated');
	           window.open('all_category.php','_self');
	        </script>";
	        
	}else{
		?>
			<script>
	           swal("Error!!","someting wrong","error");
	        </script>
	        <?php
	}
} 

?>