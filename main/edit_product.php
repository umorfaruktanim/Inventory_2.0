<?php
include('ini/header.php');
include('dbcon.php');

$idd = $_GET['id'];
$sql = "SELECT product.*, supplier.sup_name AS sup_name, category.cat_name FROM product 
        LEFT JOIN supplier ON product.sup_id = supplier.id 
        LEFT JOIN category ON product.cat_id = category.cat_id WHERE product.id = '$idd'";
$run = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($run);

$d = "SELECT * FROM category";
$r = mysqli_query($con, $d);
?>

<h1 class="text-center">Add Products :</h1>
<div class="row">
    <div class="col-md-6 offset-3 card text-success" style="background: white; font-weight: bold;">
        <div class="card-body">
            <form method="post" action="" enctype="multipart/form-data" class="container">
                <label class="form-group">Product Name :</label>
                <input type="text" name="name" required="" value="<?php echo $data['name'] ?>" class="form-control"><br>
                <label class="form-group">Product Code :</label>
                <input type="text" name="code" required="" value="<?php echo $data['code'] ?>" class="form-control"><br>
                
                <label class="form-group">Product Photo :</label>
                <input type="file" name="photo" class="form-control"><br>
                
                <label class="form-group">Select Category :</label>
                <select name="cat_id" class="form-control" required>
                    <option value="<?php echo $data['cat_id'] ?>"><?php echo $data['cat_name']; ?></option>
                    <?php while ($ta = mysqli_fetch_assoc($r)) { ?>
                        <option value="<?php echo $ta['cat_id'] ?>"><?php echo $ta['cat_name'] ?></option>
                    <?php } ?>
                </select>
                <br><br>
                <input type="submit" name="submit" class="btn btn-success form-control">
            </form>
        </div>
    </div>
</div>

<?php
include('ini/footer.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $code = $_POST['code'];
    $cat_id = $_POST['cat_id'];
    $photo = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $upload_path = 'img/products/';
    $upload_check = move_uploaded_file($tmp_name, $upload_path . $photo);

    if ($upload_check) {
        // Check if the code is changed
        if ($code != $data['code']) {
            // Check if the new code already exists
            $check_code_sql = "SELECT * FROM product WHERE code = '$code'";
            $check_code_result = mysqli_query($con, $check_code_sql);

            if (mysqli_num_rows($check_code_result) > 0) {
                ?>
                <script>
                    swal("Error!", "Product Code already exists!", "error");
                </script>
                <?php
                exit();
            }
        }

        $sql = "UPDATE product SET name = '$name', code = '$code', cat_id = '$cat_id', photo = '$photo' WHERE id = '$idd'";
        $run = mysqli_query($con, $sql);

        if ($run) {
            echo '<script>
            swal({
                title: "Success!",
                text: "Data updated successfully",
                icon: "success"
            }).then(function() {
                window.location = "view_product.php?id=' . $idd . '";
            });
        </script>';
        } else {
            ?>
            <script>
                swal("Oops!", "Failed to update product!", "error");
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            swal("Failed!", "Failed to upload the photo!", "error");
        </script>
        <?php
    }
}
?>
