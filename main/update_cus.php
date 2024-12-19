<?php 
$idd = $_GET['id'];
include('ini/header.php');
include('dbcon.php');
$sql = "SELECT * FROM customer WHERE cus_id = $idd";
$run = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($run);
?>

        <h1 class="text-center">Update Customer :</h1>
        <div class="row">
            <div class="col-md-6 offset-3 card text-success" style="background: white; font-weight: bold;">
                <div class="card-body">
                    	<form method="post" action="" enctype="multipart/form-data" class="container">
						    <label class="form-group">Customer Name :</label>
						    <input type="text" name="name" required="" value="<?php echo $data['name'] ?>" class="form-control"><br>
                            <label class="form-group">Customer Email :</label>
                            <input type="email" name="email" required="" value="<?php echo $data['email'] ?>" class="form-control"><br>
						    <label class="form-group">Customer Phone :</label>
                            <input type="text" name="phone" required="" value="<?php echo $data['phone'] ?>" class="form-control"><br>
                            <label class="form-group">Customer Address :</label>
						    <input type="text" name="address" required="" value="<?php echo $data['address'] ?>" class="form-control"><br>
                            <input type="submit" name="submit" class="btn btn-success form-control">

						</form>

                    </div>
                </div>

            </div>
                       

            

<?php
include('ini/footer.php');
include('dbcon.php');

 if ((isset($_POST['submit']))) {
	$name = $_POST['name'];
	$email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];


        $sql = "UPDATE  customer SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE cus_id = $idd";

        $run = mysqli_query($con,$sql);
        if ($run) {
          echo '<script>
            swal({
                title: "Success!",
                text: "Data updated successfully",
                icon: "success"
            }).then(function() {
                window.location = "manage_customer.php?";
            });
        </script>';
        }else{
            ?>
            <script>
               swal("oise na!!","data inserted","error");
            </script>
            <?php
        }
    }
?>