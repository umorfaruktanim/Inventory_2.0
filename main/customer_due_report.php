<?php
include('ini/header.php');
include('dbcon.php');

// Get selected customer ID from the form submission
$selected_customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';

// Calculate the total due amount
$sql_due = "SELECT SUM(due_amount) AS total_due FROM pos";
if (!empty($selected_customer_id)) {
    $sql_due .= " WHERE customer_id = '$selected_customer_id' AND due_amount > 0";
} else {
    $sql_due .= " WHERE due_amount > 0";
}
$run_due = mysqli_query($con, $sql_due);
$total_due = mysqli_fetch_assoc($run_due)['total_due'];

// Fetch customer details along with due amount where due amount is greater than 0
$sql = "SELECT customer.*, pos.due_amount, pos.invoice_no FROM customer 
        LEFT JOIN pos ON customer.cus_id = pos.customer_id
        WHERE pos.due_amount > 0";
if (!empty($selected_customer_id)) {
    $sql .= " AND customer.cus_id = '$selected_customer_id'";
}
$run = mysqli_query($con, $sql);

// Fetch all customers for the select dropdown
$sql_customers = "SELECT * FROM customer";
$run_customers = mysqli_query($con, $sql_customers);
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
        </div>
        <div class="card-body">
            <!-- Customer filter form -->
            <form method="POST" action="">
                <div class="form-group">
                    <label for="customer_id">Select Customer:</label>
                    <select name="customer_id" id="customer_id" class="form-control">
                        <option value="">All Customers</option>
                        <?php while ($customer = mysqli_fetch_assoc($run_customers)) { ?>
                            <option value="<?php echo $customer['cus_id']; ?>" <?php if ($selected_customer_id == $customer['cus_id']) echo 'selected'; ?>>
                                <?php echo $customer['name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <div class="table-responsive mt-3">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Due Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Due Amount</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php while ($data = mysqli_fetch_assoc($run)) { ?>
                            <tr>
                                <td><?php echo $data['name']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td><?php echo $data['phone']; ?></td>
                                <td><?php echo number_format($data['due_amount'], 2); ?></td>
                                <td>
                                    <a href="customer_invoice.php?invoice_no=<?php echo $data['invoice_no']; ?>" class="btn btn-success btn-sm">PDF</a>
                                    <a href="update_pos.php?invoice_no=<?php echo $data['invoice_no']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="alert alert-info mt-3">
                    <strong>Total Due Amount: </strong> <span class="text-danger font-weight-bold">$<?php echo number_format($total_due, 2); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('ini/footer.php'); ?>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'print'
            ]
        });
    });
</script>
