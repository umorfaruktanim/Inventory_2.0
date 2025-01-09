<?php
include('ini/header.php');
include('dbcon.php');

// Initialize date variables
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

// Query for total sale amount and gross profit
$sql = "SELECT 
            SUM(pos.total_have_to_paid) AS total_sale, 
            SUM(pos.total_have_to_paid - (pos.buy_price * pos.quantity)) AS gross_profit
        FROM pos 
        LEFT JOIN customer ON pos.customer_id = customer.cus_id";

if ($start_date && $end_date) {
    $sql .= " WHERE pos.datee BETWEEN '$start_date' AND '$end_date'";
}

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

// Calculate total expenses
if ($start_date && $end_date) {
    $expense_query = "SELECT SUM(amount) AS total_expenses FROM expenses WHERE expense_date BETWEEN '$start_date' AND '$end_date'";
} else {
    $expense_query = "SELECT SUM(amount) AS total_expenses FROM expenses";
}

$expense_result = mysqli_query($con, $expense_query);
$expense_row = mysqli_fetch_assoc($expense_result);

// Calculate net profit
$total_sale = $row['total_sale'] ?? 0;
$gross_profit = $row['gross_profit'] ?? 0;
$total_expenses = $expense_row['total_expenses'] ?? 0;
$net_profit = $gross_profit - $total_expenses;
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profit Report</h6>
        </div>
        <div class="card-body">
            <!-- Date range filter form -->
            <form method="post" class="mb-4">
                <div class="form-row">
                    <div class="col">
                        <input type="date" name="start_date" class="form-control" value="<?php echo $start_date; ?>">
                    </div>
                    <div class="col">
                        <input type="date" name="end_date" class="form-control" value="<?php echo $end_date; ?>">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <!-- Display total sale amount, gross profit, total expenses, and net profit -->
            <div class="row mb-4">
                <div class="col">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Sale Amount</h5>
                            <p class="card-text"><?php echo '$' . number_format($total_sale, 2); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Gross Profit</h5>
                            <p class="card-text"><?php echo '$' . number_format($gross_profit, 2); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Expenses</h5>
                            <p class="card-text"><?php echo '$' . number_format($total_expenses, 2); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Net Profit</h5>
                            <p class="card-text"><?php echo '$' . number_format($net_profit, 2); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('ini/footer.php'); ?>
