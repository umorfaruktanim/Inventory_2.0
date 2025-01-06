<?php
include('ini/header.php');
include('dbcon.php');

$expense_id = $_GET['expense_id']; // Fetch expense ID from the URL
$sql = "SELECT * FROM expenses WHERE expense_id = '$expense_id'"; // Fetch data for that expense
$result = mysqli_query($con, $sql);
$expense = mysqli_fetch_assoc($result);

$d = "SELECT * FROM ex_category"; // Fetch expense categories
$r = mysqli_query($con, $d);
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
                <input type="date" name="expense_date" value="<?php echo $expense['expense_date']; ?>" required class="form-control"><br>

                <label class="form-group">Expense Purpose:</label>
                <select class="form-control" name="expense_category" required>
                    <option value="">Select category</option>
                    <?php while ($ta = mysqli_fetch_assoc($r)) { ?>
                        <option value="<?php echo $ta['exc_id']; ?>" <?php echo ($ta['exc_id'] == $expense['expense_category']) ? 'selected' : ''; ?>>
                            <?php echo $ta['e_cat_name']; ?>
                        </option>
                    <?php } ?>
                </select><br>

                <label class="form-group">Description:</label>
                <textarea name="description" class="form-control" rows="3"><?php echo $expense['description']; ?></textarea><br>

                <label class="form-group">Amount:</label>
                <input type="number" name="amount" value="<?php echo $expense['amount']; ?>" required step="0.01" class="form-control"><br>

                <label class="form-group">Vendor Name:</label>
                <input type="text" name="vendor_name" value="<?php echo $expense['vendor_name']; ?>" class="form-control"><br>

                <label class="form-group">Attachment:</label>
                <input type="file" name="invoice_pic" required="" class="form-control"><br>

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

    // Handle file upload (attachment)
    if ($_FILES['invoice_pic']['name']) {
        $invoice_pic = $_FILES['invoice_pic']['name'];
        $target_dir = "img/expenses/"; // Directory to save the file
        $target_file = $target_dir . basename($invoice_pic);
        move_uploaded_file($_FILES['invoice_pic']['tmp_name'], $target_file);
    } else {
        $invoice_pic = $expense['invoice_pic']; // Keep existing picture if no new file is uploaded
    }

    // Update the expense record in the database
    $update_sql = "UPDATE expenses SET 
                        expense_date = '$expense_date',
                        expense_category = '$expense_category',
                        description = '$description',
                        amount = '$amount',
                        vendor_name = '$vendor_name',
                        invoice_pic = '$invoice_pic'
                    WHERE expense_id = '$expense_id'";

$run = mysqli_query($con, $update_sql);

    	if ($run) {
        echo '<script>
                swal("Updated", "Your Information is updated", "success")
                .then((value) => {
                    window.location.href = "expense_report.php?id=' . $expense_id . '";
                });
              </script>';
    } else {
        echo '<script>swal("Error","Data update error","error");</script>';
    }

 	}


 ?>