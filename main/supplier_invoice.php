<?php 
session_start();

if(isset($_SESSION['email'])) {
    $id = $_SESSION['id'];
    include('dbcon.php');
    
    if(isset($_GET['invoice_id'])) {
        $invoice_id = $_GET['invoice_id'];
        
        // Fetch invoice data
        $sql = "SELECT sup_invoice.invoice_id AS invoice_id, sup_invoice.product_name, product.code, sup_invoice.paid_amount, sup_invoice.due_amount, sup_invoice.qty, supplier.sup_name, supplier.sup_email, supplier.sup_phone, sup_invoice.datee
                FROM sup_invoice
                LEFT JOIN product ON sup_invoice.product_id = product.id
                LEFT JOIN supplier ON sup_invoice.supp_id = supplier.id 
                WHERE sup_invoice.invoice_id = $invoice_id";
        
        $exe = mysqli_query($con, $sql);

        // Fetch the first row
        $data = mysqli_fetch_assoc($exe);
    } else {
        // No invoice_id provided
        $data = null;
    }
} else {
    // Session not set
    $data = null;
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
                            <h4 class="float-end font-size-15">Invoice #<?php echo $invoice_id ?></h4>
                            <div class="mb-4">
                                <h2 class="mb-1 text-muted">Tanim.com</h2>
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
                                        <h5 class="font-size-15 mb-2"><?php echo $data['sup_name'] ?></h5>
                                        <p class="mb-1"><?php echo isset($data['sup_email']) ? $data['sup_email'] : ''; ?></p>
                                        <p><?php echo isset($data['sup_phone']) ? $data['sup_phone'] : ''; ?></p>
                                    <?php else: ?>
                                        <p>No customer data found for this invoice.</p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="text-muted text-sm-end">
                                    <div>
                                        <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                        <p>#<?php echo $invoice_id ?></p>
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
                                            <th>Item</th>
                                            <th>Product Code</th>
                                            <th>Quantity</th>
                                            <th>Paid Amount</th>
                                            <th>Due Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($data): ?>
                                            <tr>
                                                <td><?php echo $data['product_name'] ?></td>
                                                <td><?php echo $data['code'] ?></td>
                                                <td><?php echo $data['qty']; ?></td>
                                                <td>$ <?php echo $data['paid_amount']; ?></td>
                                                <td>$ <?php echo $data['due_amount']; ?></td>
                                            </tr>
                                        <?php endif; ?>
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
		                    <p style="margin-left: 5px;">Supplier Signature</p>
		                    	</div>
		                    </div>
              		  </div>
						<div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i> Print</a>
                                    <a href="update_sup_inv.php?invoice_id=<?php echo $data['invoice_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
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
