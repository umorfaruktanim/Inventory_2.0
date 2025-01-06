<?php
include('ini/header.php');
include('dbcon.php');
$sql = "SELECT * FROM supplier";
$run = mysqli_query($con,$sql);
?>
	<div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Supplier</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
                                            <td>Supplier Name</td>
                                            <td>Supplier Address</td>
                                            <td>Supplier Phone</td>
                                            <td>Supplier Email</td>
                                            <td>Supplier Address</td>
											<td>Supplier Photo</td>
											<td>Action</td>
										</tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td>Supplier Name</td>
                                            <td>Supplier Address</td>
                                            <td>Supplier Phone</td>
                                            <td>Supplier Email</td>
                                            <td>Supplier Address</td>
                                            <td>Supplier Photo</td>
                                            <td>Action</td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while ($data = mysqli_fetch_assoc($run)) { ?>
								            <tr>
                                                <td><?php echo $data['sup_name'] ?></td>
                                                <td><?php echo $data['sup_add'] ?></td>
                                                <td><?php echo $data['sup_phone'] ?></td>
                                                <td><?php echo $data['sup_email'] ?></td>
                                                <td><?php echo $data['sup_add'] ?></td>
                                                 <td><img src="img/supplier/<?php echo $data['sup_photo'] ?>" height="100" width="100"></td>
								                <td>
								                	<a href="update_sup.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

								                	<a href="delete_sup.php?id=<?php echo $data['id']?>" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></a>
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


