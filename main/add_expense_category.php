<?php 
include('ini/header.php');
?>

                    <!-- Content Row -->
                    <h2 class="text-center">Add Expense Category :</h2>
                    <div class="row">
                        <div class="col-md-6 offset-3 card text-success" style="background: white; font-weight: bolder;">
                            <div class="card-body">
                                <a href="all_excategory.php" class="btn btn-success btn-sm" style="float: right;">All Category</a>
                            	<form method="post" action="">
                                    <label class="form-group">Category Name :</label>
                            		<input type="text" name="e_cat_name" required="" class="form-control">
                            		<br>
                            		<input type="submit" name="submit" class="btn btn-success form-control">
                            	</form>
                             </div>
                        </div>
                    </div>
                       

           

<?php
include('ini/footer.php');
 if ((isset($_POST['submit']))) {
	$e_cat_name = $_POST['e_cat_name'];

	$sql = "INSERT INTO ex_category (e_cat_name) VALUES ('$e_cat_name')";
	include('dbcon.php');
	$run = mysqli_query($con,$sql);
	if ($run) {
		?>
			<script>
	           swal("Success!!","data inserted","success");
	        </script>
	        <?php
	}else{
		?>
			<script>
	           swal("Error!!","someting wrong","error");
	        </script>
	        <?php
	}
} 

?>