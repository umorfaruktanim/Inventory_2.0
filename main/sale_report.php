<?php
include('ini/header.php');
include('dbcon.php');

// Initialize date variables
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

// Update SQL query based on date range
$sql = "SELECT * FROM pos LEFT JOIN customer ON pos.customer_id = customer.cus_id";
if ($start_date && $end_date) {
    $sql .= " WHERE pos.datee BETWEEN '$start_date' AND '$end_date'";
}
$run = mysqli_query($con, $sql);
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sales Report</h6>
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
                                            <td>Product Name</td>
                                            <td>Product Code</td>
                                            <td>Product Category</td>
                                            <td>Sell Price</td>
                                            <td>QTY</td>
                                            <td>Customer Name</td>
                                            <td>Invoice No</td>
                                            <td>Action</td>
                                            <td>Date</td>
                                        </tr>
                    </thead>
                     <tbody>
                                        <?php while ($data = mysqli_fetch_assoc($run)) { ?>
                                            <tr>
                                                <td><?php echo $data['product_name'] ?></td>
                                                <td><?php echo $data['product_code'] ?></td>
                                                <td><?php echo $data['product_category'] ?></td>
                                                <td><?php echo $data['sell_price'] ?></td>
                                                <td><?php echo $data['quantity'] ?></td>
                                                <td><?php echo $data['name'] ?></td>
                                                <td><?php echo $data['invoice_no'] ?></td>
                                                <td>
                                                 <a href="customer_invoice.php?invoice_no=<?php echo $data['invoice_no']; ?>" class="btn btn-info btn-sm">PDF</a>
                                                 <a href="update_pos.php?invoice_no=<?php echo $data['invoice_no']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                    
                                                </td>
                                                <td><?php echo $data['datee'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                    <tfoot>
                        <tr>
                            
                                            <td>Product Name</td>
                                            <td>Product Code</td>
                                            <td>Product Category</td>
                                            <td>Sell Price</td>
                                            <td>QTY</td>
                                            <td>Customer Name</td>
                                            <td>Invoice No</td>
                                            <td>Action</td>
                                            <td>Date</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include('ini/footer.php'); ?>

<!-- Include necessary DataTables scripts and initialize -->
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
