<?php 
session_start();
if(isset($_SESSION['email'])){
    $id = $_SESSION['id'];
    include('dbcon.php');
    $invoice_no = $_GET['invoice_no'];
    $sql = "SELECT * FROM pos LEFT JOIN customer ON pos.customer_id = customer.cus_id WHERE invoice_no = $invoice_no";
    $exe = mysqli_query($con, $sql);

    // Check if there are results
    if (mysqli_num_rows($exe) > 0) {
        $data = mysqli_fetch_assoc($exe);  // Fetch the first row initially
    } else {
        // Handle case where no data is found
        $data = null;  // Initialize $data as null if no rows found
    }
} else {
    // Handle session not set
    $data = null;  // Initialize $data as null if session is not set
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            margin-top: 20px;
            background-color: #eee;
        }
        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-15">Invoice #<?php echo $invoice_no ?></h4>
                            <div class="mb-4">
                                <h2 class="mb-1 text-muted">Inventory.com</h2>
                            </div>
                            <div class="text-muted">
                                <p class="mb-1">3184 Spruce Drive Pittsburgh, PA 15201</p>
                                
                                <p><i class="uil uil-phone me-1"></i> 012-345-6789</p>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <h5 class="font-size-16 mb-3">Billed To:</h5>
                                    <?php if ($data): ?>
                                        <h5 class="font-size-15 mb-2"><?php echo $data['name'] ?></h5>
                                        <p class="mb-1"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="85d5f7e0f6f1eaebc8ece9e9e0f7c5e4f7e8fcf6f5fcabe6eae8"><?php echo $data['email'] ?></a></p>
                                        <p><?php echo $data['phone']; ?></p>
                                        Address:
                                        <p><?php echo $data['address']; ?></p>
                                    <?php else: ?>
                                        <p>No customer data found for this invoice.</p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="text-muted text-sm-end">
                                    <div>
                                        <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                        <p>#<?php echo $invoice_no ?></p>
                                    </div>
                                    <?php if ($data): ?>
                                        <div class="mt-4">
                                            <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                            <p><?php echo $data['datee']; ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="py-2">
                            <h5 class="font-size-15">Order Summary</h5>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th>Sell Price</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Total Have to Paid</th>
                                            <th>Paid Amount</th>
                                            <th>Due Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php 
                                            $index = 1; 
                                            $total_paid = 0;
                                            $total_due = 0;
                                            $ttotal_have_to_paid =0;
                                            mysqli_data_seek($exe, 0); // Reset pointer to the beginning
                                            while ($data = mysqli_fetch_assoc($exe)) { ?>
                                                <tr>
                                                    <td><?php echo $index++; ?></td>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14 mb-1"><?php echo $data['product_name']; ?></h5>
                                                            <p class="text-muted mb-0"><?php echo $data['product_code']; ?></p>
                                                        </div>
                                                    </td>
                                                    <td>$ <?php echo $data['sell_price']; ?></td>
                                                    <td><?php echo $data['product_category']; ?></td>
                                                    <td><?php echo $data['quantity']; ?></td>
                                                    <td><?php echo $data['total_have_to_paid']; ?></td>
                                                    <td>Taka <?php echo $data['paid_amount']; ?></td>
                                                    <td>Taka <?php echo $data['due_amount']; ?></td>
                                                </tr>
                                                
                                            <?php 
                                            $total_paid += $data['paid_amount'];
                                            $total_due += $data['due_amount'];
                                            $ttotal_have_to_paid += $data['total_have_to_paid']; 
                                        } ?>
                                            <br>
                                            <br>
                                            <tr>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total Summury</td>
                                                <td><?php echo $ttotal_have_to_paid; ?></td>
                                                <td><?php echo $total_paid; ?></td>
                                                <td><?php echo $total_due; ?></td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                                <div class="col-md-4">
                                     <input type="text" name="" style="height: 100px; width: 200px; margin-left: 5px;">
                            <p style="margin-left: 5px;">Authorised Signature</p>
                                </div>
                            
                            <div class="col-md-4 offset-4">
                                     <input type="text" name="" style="height: 100px; width: 200px; margin-left: 5px;">
                            <p style="margin-left: 5px;">Customer Signature</p>
                                </div>
                            </div>
                      </div>
                        <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i> Print</a>
                                    <a href="update_pos.php?invoice_no=<?php echo $invoice_no; ?>" class="btn btn-primary btn-sm">Edit</a>

                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
