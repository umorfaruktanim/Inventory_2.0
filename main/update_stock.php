<?php
include('ini/header.php');
$pid = $_GET['id'];
$d = "SELECT product.*, supplier.sup_name 
      FROM product 
      LEFT JOIN supplier ON product.sup_id = supplier.id 
      WHERE product.id='$pid'";

include('dbcon.php');
$r = mysqli_query($con, $d);
$s = "SELECT * FROM supplier";
$sr = mysqli_query($con, $s);
$data = mysqli_fetch_assoc($r);
?>

<h1 class="text-center">Update Product :</h1>
<div class="row">
    <div class="col-md-6 offset-3 card text-success" style="background: white; font-weight: bold;">
        <div class="card-body">
            <form method="post" action="" enctype="multipart/form-data" class="container" onsubmit="return validateForm()">
                <label class="form-group">Product Name :</label>
                <input type="text" disabled="" value="<?php echo $data['name'] ?>" class="form-control"><br>
                <label class="form-group">Product Code :</label>
                <input type="text" disabled="" value="<?php echo $data['code'] ?>" class="form-control"><br>
                <label class="form-group">Product Qty :</label>
                <input type="number" name="qty" id="qty" min="<?php echo $data['qty'] ?>" value="<?php echo $data['qty'] ?>" class="form-control" readonly onfocus="this.removeAttribute('readonly');"><br>
                <label class="form-group">Buying Price :</label>
                <input type="number" name="buy_price" required="" value="<?php echo $data['buy_price'] ?>" class="form-control"><br>
                <label class="form-group">Selling Price :</label>
                <input type="number" name="sell_price" step="0.01" class="form-control" value="<?php echo $data['sell_price'] ?>"><br>
                <label class="form-group">Paid Amount :</label>
                <input type="number" name="paid_ammount" class="form-control" placeholder="Paid Amount"><br>
                <label class="form-group">Supplier :</label>
                <select name="sup_id" class="form-control" required>
                    <option value="<?php echo $data['sup_id'] ?>"><?php echo $data['sup_name'] ?></option>
                    <?php while ($t = mysqli_fetch_assoc($sr)) { ?>
                        <option value="<?php echo $t['id'] ?>"><?php echo $t['sup_name'] ?></option>
                    <?php } ?>
                </select>
                <br><br>
                <input type="submit" name="submit" class="btn btn-success form-control">
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var initialQty = <?php echo $data['qty']; ?>;
        var updatedQty = document.getElementById('qty').value;

        if (parseInt(updatedQty) === initialQty) {
            alert('Please update the quantity.');
            return false;
        }
        return true;
    }
</script>

<?php
include('ini/footer.php');
include('dbcon.php');

$pid = $_GET['id'];
// Fetch the existing product details
$d = "SELECT * FROM product WHERE id='$pid'";
$r = mysqli_query($con, $d);
$data = mysqli_fetch_assoc($r);

if (isset($_POST['submit'])) {
    $new_qty = $_POST['qty'];
    $buy_price = $_POST['buy_price'];
    $sell_price = $_POST['sell_price'];
    $paid_ammount = $_POST['paid_ammount'];
    $sup_id = $_POST['sup_id'];

    $existing_qty = $data['qty'];
    $difference_qty = $new_qty - $existing_qty;
    $datee = date("Y-m-d");

    if ($difference_qty > 0) {
        // Check if a row with the same product code, buying price, selling price, and supplier ID exists
        $check_sql = "SELECT * FROM product WHERE code='{$data['code']}' AND buy_price='$buy_price' AND sell_price='$sell_price' AND sup_id='$sup_id'";
        $check_run = mysqli_query($con, $check_sql);

        if (mysqli_num_rows($check_run) > 0) {
            // If a matching row exists, update the quantity
            $existing_product = mysqli_fetch_assoc($check_run);
            $updated_qty = $existing_product['qty'] + $difference_qty;

            $update_sql = "UPDATE product SET qty='$updated_qty' WHERE id='{$existing_product['id']}'";
            $update_run = mysqli_query($con, $update_sql);

            if ($update_run) {
                // Create a new supplier invoice for the updated quantity
                $due_amount = ($buy_price * $difference_qty) - $paid_ammount;
                $sql_invoice = "INSERT INTO sup_invoice (product_id, product_name, supp_id, paid_amount, due_amount, qty, code, datee) 
                                VALUES ('{$existing_product['id']}', '{$data['name']}', '$sup_id', '$paid_ammount', '$due_amount', '$difference_qty', '{$data['code']}', '$datee')";
                $run_invoice = mysqli_query($con, $sql_invoice);

                if ($run_invoice) {
                    $last_invoice_id = mysqli_insert_id($con); // Get the newly created invoice ID
                    ?>
                    <script>
                        swal("Success!", "Quantity updated and invoice created successfully!", "success").then(function() {
                            window.location.href = 'supplier_invoice.php?invoice_id=<?php echo $last_invoice_id; ?>';
                        });
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        swal("Error!", "Failed to create supplier invoice!", "error");
                    </script>
                    <?php
                }
            } else {
                ?>
                <script>
                    swal("Error!", "Failed to update the existing product row!", "error");
                </script>
                <?php
            }
        } else {
            // If no matching row exists, insert a new row
            $sql_insert = "INSERT INTO product (name, code, photo, qty, buy_price, sell_price, sup_id, cat_id)
                           VALUES ('{$data['name']}', '{$data['code']}', '{$data['photo']}', '$difference_qty', '$buy_price', '$sell_price', '$sup_id', '{$data['cat_id']}')";
            $run_insert = mysqli_query($con, $sql_insert);

            if ($run_insert) {
                // Insert into the supplier invoice table
                $due_amount = ($buy_price * $difference_qty) - $paid_ammount;
                $sql_invoice = "INSERT INTO sup_invoice (product_id, product_name, supp_id, paid_amount, due_amount, qty, code, datee) 
                                VALUES ('$pid', '{$data['name']}', '$sup_id', '$paid_ammount', '$due_amount', '$difference_qty', '{$data['code']}', '$datee')";
                $run_invoice = mysqli_query($con, $sql_invoice);

                if ($run_invoice) {
                    $last_invoice_id = mysqli_insert_id($con);
                    ?>
                    <script>
                        swal("Success!", "Product updated, and excess quantity added as a new row!", "success").then(function() {
                            window.location.href = 'supplier_invoice.php?invoice_id=<?php echo $last_invoice_id; ?>';
                        });
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        swal("Oops!", "Failed to insert into supplier invoice table!", "error");
                    </script>
                    <?php
                }
            } else {
                ?>
                <script>
                    swal("Oops!", "Failed to insert new product row!", "error");
                </script>
                <?php
            }
        }
    } else {
        ?>
        <script>
            swal("Error!", "Updated quantity must be greater than the existing quantity.", "error");
        </script>
        <?php
    }
}
?>
