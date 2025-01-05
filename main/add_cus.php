<?php
include('ini/header.php');
?>


        <h1 class="text-center">Add Customer :</h1>
        <div class="row">
            <div class="col-md-6 offset-3 card text-success" style="background: white; font-weight: bold;">
                <div class="card-body">
                    	<form method="post" action="" enctype="multipart/form-data" class="container">
						    <label class="form-group">Customer Name :</label>
						    <input type="text" name="name" required="" placeholder="Customer Name" class="form-control"><br>
                            <label class="form-group">Customer Email :</label>
                            <input type="email" name="email" required="" class="form-control"><br>
						    <label class="form-group">Customer Phone :</label>
						    <input type="text" name="phone" required="" placeholder="Customer Phone" class="form-control"><br>
                            <label class="form-group">Customer Address :</label>
                            <input type="text" name="address" required="" placeholder="Customer Address" class="form-control"><br>
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


        $sql = "INSERT INTO customer(name, email, phone,address) VALUES('$name','$email', '$phone','$address')";
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
               swal("oise na!!","data inserted","error");
            </script>
            <?php
        }
    }
?>