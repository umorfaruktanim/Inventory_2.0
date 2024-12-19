<?php
include('ini/header.php');
include('dbcon.php');
$sql = "SELECT * FROM customer";
$run = mysqli_query($con,$sql);
?>
	<div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Customer</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>Customer Email</td>
                                            <td>Customer Phone</td>
                                            <td>Customer Address</td>
                                            <td>Action</td>
										</tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>Customer Email</td>
                                            <td>Customer Phone</td>
                                            <td>Action</td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while ($data = mysqli_fetch_assoc($run)) { ?>
								            <tr>
                                                <td><?php echo $data['name'] ?></td>
                                                <td><?php echo $data['email'] ?></td>
                                                <td><?php echo $data['phone'] ?></td>
                                                <td><?php echo $data['address'] ?></td>
								                <td>
								                	<a href="update_cus.php?id=<?php echo $data['cus_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

								                	<a href="delete_cus.php?id=<?php echo $data['cus_id']?>" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></a>
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


