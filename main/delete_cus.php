<?php 
include('dbcon.php');
$idd = $_GET['id'];
$sql= "DELETE FROM customer WHERE cus_id=$idd";
$run = mysqli_query($con,$sql);
if ($run) {
	 echo "<script>
    		   window.alert('Deleted & Clicked Customer is deleted');
	           window.open('manage_customer.php','_self');
	        </script>";
}else{
	echo "error";
}
?>