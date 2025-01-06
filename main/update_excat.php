<?php 
$idd = $_GET['exc_id'];
include('ini/header.php');
include('dbcon.php');
$sql = "SELECT * FROM ex_category WHERE exc_id = $idd";
$run = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($run);
?>

<h1 class="text-center">Update Category :</h1>
        <div class="row">
            <div class="col-md-6 offset-3 card text-success" style="background: white; font-weight: bold;">
                <div class="card-body">
                    	<form method="post" action="" enctype="multipart/form-data" class="container">
                                <label class="form-group">Category Name :</label>
       							<input type="text" name="e_cat_name" required="" value="<?php echo $data['e_cat_name'] ?>" class="form-control"><br>
                               
                                <input type="submit" name="submit" class="btn btn-success form-control">
                            </form>
                    </div>
                </div>

            </div>


<?php
include('ini/footer.php');
 if ((isset($_POST['submit']))) {
	$e_cat_name = $_POST['e_cat_name'];

	$sql = "UPDATE ex_category SET e_cat_name = '$e_cat_name' WHERE exc_id = $idd";

	include('dbcon.php');
	$run = mysqli_query($con,$sql);
	if ($run) {
		echo "
			<script>
	           window.alert('Updated');
	           window.open('all_excategory.php','_self');
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