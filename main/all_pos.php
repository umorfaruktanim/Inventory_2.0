<?php
include('ini/header.php');
include('dbcon.php');
$sql = "SELECT * FROM pos LEFT JOIN customer ON pos.customer_id = customer.cus_id";
$run = mysqli_query($con,$sql);
?>
	<div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Category</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%">
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
										</tr>
                                    </thead>
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
										</tr>
                                    </tfoot>
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
								        	</tr>
								        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


<?php include('ini/footer.php'); ?>


