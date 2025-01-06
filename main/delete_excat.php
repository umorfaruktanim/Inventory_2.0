<?php 
include('dbcon.php');
$idd = $_GET['exc_id'];
$sql= "DELETE FROM ex_category WHERE exc_id=$idd";
$run = mysqli_query($con,$sql);
if ($run) {
	 echo "<script>
    		   window.alert('Deleted & Clicked category is deleted');
	           window.open('all_excategory.php','_self');
	        </script>";
}else{
	echo "error";
}
?>