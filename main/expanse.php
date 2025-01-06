<?php
include('ini/header.php');
$d = "SELECT * FROM ex_category";
include('dbcon.php');
$r = mysqli_query($con,$d);

$sql = "SELECT * FROM category"
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="add_expense_category.php" class="btn btn-success">Add Expense Category</a>
            <a href="expense_report.php" class="btn btn-success float-right">Expenses Report</a>
        </div>
        <div class="card-body">
            <form method="post" action="" enctype="multipart/form-data" class="container">
                <label class="form-group">Date:</label>
                <input type="date" name="expense_date" required class="form-control"><br>

                <label class="form-group">Expense Purpose:</label>
                <select class="form-control" name="expense_category" required>
                    <option value="">Select category</option>
                    <?php while ($ta = mysqli_fetch_assoc($r)) { ?>
                        <option value="<?php echo $ta['exc_id']; ?>"><?php echo $ta['e_cat_name']; ?></option>
                    <?php } ?>
                </select><br>

                <label class="form-group">Description:</label>
                <textarea name="description" class="form-control" rows="3"></textarea><br>

                <label class="form-group">Amount:</label>
                <input type="number" name="amount" required step="0.01" class="form-control"><br>

                <label class="form-group">Vendor Name:</label>
                <input type="text" name="vendor_name" class="form-control"><br>

                <label class="form-group">Attachment :</label>
                <input type="file" name="invoice_pic" class="form-control"><br>

                <input type="submit" name="submit" class="btn btn-success form-control">
            </form>
        </div>
    </div>
</div>



<?php 
if (isset($_POST['submit'])) {
    $expense_date = $_POST['expense_date'];
    $expense_category = $_POST['expense_category'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $vendor_name = $_POST['vendor_name'];

    $invoice_pic = $_FILES['invoice_pic']['name'];
    $tmp_name = $_FILES['invoice_pic']['tmp_name'];
    $upload_path = 'img/expenses/';
    $upload_check = move_uploaded_file($tmp_name, $upload_path.$invoice_pic);

     if ($upload_check == 0) {
        echo "<script>window.alert('Faild to load files');</script>";
    }else{

    	 $sql = "INSERT INTO expenses (expense_date, expense_category, description, amount, vendor_name,invoice_pic) 
            VALUES ('$expense_date', $expense_category, '$description', $amount, '$vendor_name','$invoice_pic')";
    	$run = mysqli_query($con, $sql);

    	if ($run) {
           ?>
            <script>
               swal("Success!!","data inserted","success");
            </script>
            <?php
        }else{
            ?>
            <script>
               swal("Error!!","data inserted","error");
            </script>
            <?php
        }
    }
}

 ?>