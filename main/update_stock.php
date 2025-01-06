<?php
include('ini/header.php');
$pid = $_GET['id'];
$d = "SELECT * FROM product WHERE id='$pid'";
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
                    <option value="">Select Supplier</option>
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

if (isset($_POST['submit'])) {
    $qty = $_POST['qty'];
    $buy_price = $_POST['buy_price'];
    $sell_price = $_POST['sell_price'];
    $paid_ammount = $_POST['paid_ammount'];
    $sup_id = $_POST['sup_id'];

    // Calculate the excess quantity
    $initial_qty = $data['qty'];
    $updated_qty = $_POST['qty'];
    $excess_qty = $updated_qty - $initial_qty;
    $datee = date("Y-m-d");

    // Update the product table
    $sql = "UPDATE product SET qty = '$updated_qty', buy_price = '$buy_price', sell_price = '$sell_price', sup_id = '$sup_id' WHERE id = '$pid'";
    $run = mysqli_query($con, $sql);

    if ($run) {
        if ($excess_qty > 0) {
            // Insert into sup_invoice table
            $due_amount = ($buy_price * $excess_qty) - $paid_ammount;
            $sql_invoice = "INSERT INTO sup_invoice (product_id, product_name, supp_id, paid_amount, due_amount, qty, code, datee) 
                            VALUES ('$pid', '{$data['name']}', '$sup_id', '$paid_ammount', '$due_amount', '$excess_qty', '{$data['code']}', '$datee')";
            $run_invoice = mysqli_query($con, $sql_invoice);

            if ($run_invoice) {
                $last_invoice_id = mysqli_insert_id($con);
                ?>
                <script>
                    swal("Success!", "Product updated and excess quantity added to invoice!", "success").then(function() {
                        window.location.href = 'supplier_invoice.php?invoice_id=' + <?php echo $last_invoice_id; ?>;
                    });
                </script>
                <?php
            } else {
                ?>
                <script>
                    swal("Oops!", "Failed to insert into sup_invoice table!", "error");
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                swal("Success!", "Product updated successfully!", "success").then(function() {
                    window.location.href = 'supplier_invoice.php';
                });
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            swal("Oops!", "Failed to update product!", "error");
        </script>
        <?php
    }
}
?>
