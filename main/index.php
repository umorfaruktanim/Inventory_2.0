<?php
include('ini/header.php');
include('dbcon.php');

// Query for overall total sale amount and gross profit
$sql = "SELECT 
            SUM(pos.total_have_to_paid) AS total_sale, 
            SUM(pos.total_have_to_paid - (pos.buy_price * pos.quantity)) AS gross_profit
        FROM pos";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$total_sale = $row['total_sale'] ?? 0;
$gross_profit = $row['gross_profit'] ?? 0;

// Query for total expenses
$expense_query = "SELECT SUM(amount) AS total_expenses FROM expenses";
$expense_result = mysqli_query($con, $expense_query);
$expense_row = mysqli_fetch_assoc($expense_result);

$total_expenses = $expense_row['total_expenses'] ?? 0;
$net_profit = $gross_profit - $total_expenses;

// Query for total product shortage (qty < 10)

// Query for total customer due amount
$customer_due_query = "SELECT SUM(due_amount) AS total_customer_due FROM pos WHERE due_amount > 0";
$customer_due_result = mysqli_query($con, $customer_due_query);
$customer_due_row = mysqli_fetch_assoc($customer_due_result);
$total_customer_due = $customer_due_row['total_customer_due'] ?? 0;

// Query for total supplier due amount
$supplier_due_query = "SELECT SUM(due_amount) AS total_supplier_due FROM sup_invoice WHERE due_amount > 0";
$supplier_due_result = mysqli_query($con, $supplier_due_query);
$supplier_due_row = mysqli_fetch_assoc($supplier_due_result);
$total_supplier_due = $supplier_due_row['total_supplier_due'] ?? 0;
?>

<div class="container-fluid">
    <!-- Row for Info Boxes -->
    <div class="row">
        <!-- Total Sales -->
        <div class="col-md-3">
            <div class="card shadow border-left-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-primary">Total Sale</h6>
                            <h4 class="mb-0"><?php echo '$' . number_format($total_sale, 2); ?></h4>
                        </div>
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                    <small class="text-muted">Overall revenue generated</small>
                </div>
            </div>
        </div>
        <!-- Gross Profit -->
        <div class="col-md-3">
            <div class="card shadow border-left-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-success">Gross Profit</h6>
                            <h4 class="mb-0"><?php echo '$' . number_format($gross_profit, 2); ?></h4>
                        </div>
                        <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                    </div>
                    <small class="text-muted">Profit before expenses</small>
                </div>
            </div>
        </div>
        <!-- Expenses -->
        <div class="col-md-3">
            <div class="card shadow border-left-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-warning">Total Expenses</h6>
                            <h4 class="mb-0"><?php echo '$' . number_format($total_expenses, 2); ?></h4>
                        </div>
                        <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                    </div>
                    <small class="text-muted">Overall operational costs</small>
                </div>
            </div>
        </div>
        <!-- Net Profit -->
        <div class="col-md-3">
            <div class="card shadow border-left-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-info">Net Profit</h6>
                            <h4 class="mb-0"><?php echo '$' . number_format($net_profit, 2); ?></h4>
                        </div>
                        <i class="fas fa-coins fa-2x text-gray-300"></i>
                    </div>
                    <small class="text-muted">Profit after expenses</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Row for Customer and Supplier Details -->
    <div class="row mt-4">
        
        <!-- Customer Due -->
        <div class="col-md-4">
            <div class="card shadow border-left-secondary">
                <div class="card-body">
                    <h6 class="text-secondary">Customer Due</h6>
                    <h4 class="mb-0"><?php echo '$' . number_format($total_customer_due, 2); ?></h4>
                    <small class="text-muted">Outstanding customer payments</small>
                </div>
            </div>
        </div>
        <!-- Supplier Due -->
        <div class="col-md-4">
            <div class="card shadow border-left-dark">
                <div class="card-body">
                    <h6 class="text-dark">Supplier Due</h6>
                    <h4 class="mb-0"><?php echo '$' . number_format($total_supplier_due, 2); ?></h4>
                    <small class="text-muted">Outstanding supplier payments</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bar Chart for Financial Overview -->
    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Financial Overview</h6>
        </div>
        <div class="card-body">
            <canvas id="financialChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Get data from PHP
    const totalSale = <?php echo $total_sale; ?>;
    const grossProfit = <?php echo $gross_profit; ?>;
    const totalExpenses = <?php echo $total_expenses; ?>;
    const netProfit = <?php echo $net_profit; ?>;

    // Initialize the chart
    const ctx = document.getElementById('financialChart').getContext('2d');
    const financialChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total Sale', 'Gross Profit', 'Expenses', 'Net Profit'],
            datasets: [{
                label: 'Amount ($)',
                data: [totalSale, grossProfit, totalExpenses, netProfit],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.6)', // Total Sale
                    'rgba(54, 162, 235, 0.6)', // Gross Profit
                    'rgba(255, 206, 86, 0.6)', // Expenses
                    'rgba(153, 102, 255, 0.6)' // Net Profit
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toFixed(2);
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            const value = tooltipItem.raw;
                            return `$${value.toFixed(2)}`;
                        }
                    }
                }
            }
        }
    });
</script>

<?php include('ini/footer.php'); ?>
