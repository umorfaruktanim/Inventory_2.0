<?php
include('ini/header.php');
include('dbcon.php');

$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

$sql = "SELECT 
            expenses.expense_date, 
            ex_category.e_cat_name, 
            expenses.description, 
            expenses.amount, 
            expenses.vendor_name, 
            expenses.invoice_pic 
        FROM expenses 
        LEFT JOIN ex_category ON expenses.expense_category = ex_category.exc_id";
if ($start_date && $end_date) {
    $sql .= " WHERE expenses.expense_date BETWEEN '$start_date' AND '$end_date'";
}
$run = mysqli_query($con, $sql);
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Expense Report</h6>
        </div>
        <div class="card-body">
            <!-- Date range filter form -->
            <form method="post" class="mb-4">
                <div class="form-row">
                    <div class="col">
                        <input type="date" name="start_date" class="form-control" value="<?php echo $start_date; ?>" required>
                    </div>
                    <div class="col">
                        <input type="date" name="end_date" class="form-control" value="<?php echo $end_date; ?>" required>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Expense Category</td>
                            <td>Description</td>
                            <td>Amount</td>
                            <td>Vendor Name</td>
                            <td>Attachments</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($data = mysqli_fetch_assoc($run)) { ?>
                            <tr>
                                <td><?php echo $data['expense_date']; ?></td>
                                <td><?php echo $data['e_cat_name']; ?></td>
                                <td><?php echo $data['description']; ?></td>
                                <td><?php echo $data['amount']; ?></td>
                                <td><?php echo $data['vendor_name']; ?></td>
                                <td>
                                     <a href="img/expenses/<?php echo $data['invoice_pic']; ?>" target="_blank" class="btn btn-info btn-sm">View</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Date</td>
                            <td>Expense Category</td>
                            <td>Description</td>
                            <td>Amount</td>
                            <td>Vendor Name</td>
                            <td>Attachments</td>
                        </tr>
                    </tfoot>
                </table>
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
