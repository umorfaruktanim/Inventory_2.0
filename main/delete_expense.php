<?php 
include('dbcon.php');
$idd = $_GET['expense_id'];
$sql= "DELETE FROM expenses WHERE expense_id=$idd";
$run = mysqli_query($con,$sql);
if ($run) {
	 echo "<script>
    		   window.alert('Deleted & Clicked item is deleted');
	           window.open('expense_report.php','_self');
	        </script>";
}else{
	echo "error";
}
?>