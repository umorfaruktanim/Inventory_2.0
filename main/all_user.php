<?php
include('ini/header.php');
include('dbcon.php');
$sql = "SELECT * FROM user WHERE status = 1";
$run = mysqli_query($con,$sql);
?>
	<div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
                            <a href="u_request.php" style="float: right;" class="btn btn-primary">Pending User's Request</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
											<td>Name</td>
											<td>Email</td>
											<td>Phone</td>
											<td>Father Name</td>
											<td>Care of</td>
											<td>Village/Street</td>
											<td>Division</td>
											<td>District</td>
											<td>Post Office</td>
											<td>Image</td>
											<td>NID Image</td>
											<td>Approval Status</td>
											<td style="width: 500px;">Action</td>
										</tr>
                                    </thead>
                                    <tfoot>
                                       <tr>
											<td>Name</td>
											<td>Email</td>
											<td>Phone</td>
											<td>Father Name</td>
											<td>Care of</td>
											<td>Village/Street</td>
											<td>Division</td>
											<td>District</td>
											<td>Post Office</td>
											<td>Image</td>
											<td>NID Image</td>
											<td>Approval Status</td>
											<td style="width: 500px;">Action</td>
										</tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while ($data = mysqli_fetch_assoc($run)) { ?>
								            <tr>
								                <td><?php echo $data['s_name'] ?></td>
								                <td><?php echo $data['email'] ?></td>
								                <td><?php echo $data['phone'] ?></td>
								                <td><?php echo $data['f_name'] ?></td>
								                <td><?php echo $data['per_careof'] ?></td>
								                <td><?php echo $data['per_village'] ?></td>
								                <td><?php echo $data['pdivi'] ?></td>
								                <td><?php echo $data['pdist'] ?></td>
								                <td><?php echo $data['p_posto'] ?></td>
								                <td><img src="../user_img/<?php echo $data['image'] ?>" height="100" width="100"></td>
								                <td><img src="../user_img/nid/<?php echo $data['nid'] ?>" height="100" width="100"></td>
								                <td><?php if($data['status'] == 0){ ?><button class="btn btn-warning">Pending</button><?php }else{ ?><button class="btn btn-success">Approved</button><?php } ?></td>
								                <td style="width: 400px;">
								                	<a href="view_user.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm mt-1" style="font-size: 20px;"><i class="fa fa-eye"></i></a><br>
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


