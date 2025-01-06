<?php 
$idd = $_GET['id'];
include('ini/header.php');
include('dbcon.php');
$sql = "SELECT product.*, supplier.sup_name AS sup_name, category.cat_name FROM product 
        LEFT JOIN supplier ON product.sup_id = supplier.id 
        LEFT JOIN category ON product.cat_id = category.cat_id WHERE product.id = '$idd'";
$run = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($run);
?>
 <h1 class="text-center">View Products :</h1>
<div class="row mb-5 mt-2">
            <div class="col-md-6 offset-3 card text-success" style="background: white; font-weight: bold;">
                <div class="card-body">
                	<table class="table table-hover table-striped" width="50%">
						<tr>
							<td class="font-weight-bold" style="width: 150px;">Product Name :</td>
							
							<td style="width: 400px;"><?php echo $data['name'] ?></td>
						</tr>
						<tr>
							<td class="font-weight-bold" style="width: 150px;">Product Code :</td>
							
							<td style="width: 400px;"><?php echo $data['code'] ?></td>
						</tr>
						<tr>
							<td class="font-weight-bold" style="width: 150px;">Product Qty :</td>
							
							<td style="width: 400px;"><?php echo $data['qty'] ?></td>
						</tr>
						<tr>
							    <td class="font-weight-bold" style="width: 150px;">Buying Price :</td>
							    
							   <td style="width: 400px;"><?php echo $data['buy_price'] ?></td>
						</tr>
						<tr>
							    <td class="font-weight-bold" style="width: 150px;">Buying Price :</td>
							    
							   <td style="width: 400px;"><?php echo $data['sell_price'] ?></td>
						</tr>
						</tr>
						<tr>
							    <td class="font-weight-bold" style="width: 150px;">Supplier :</td>
							    
							   <td style="width: 400px;"><?php echo $data['sup_name'] ?></td>
						</tr>
						<tr>
							    <td class="font-weight-bold" style="width: 150px;">Category :</td>
							    
							   <td style="width: 400px;"><?php echo $data['cat_name'] ?></td>
						</tr>
						
						<tr>
							<td style="height: 130px;"><img src="img/products/<?php echo $data['photo'] ?>" style="height: 140px; width: 150px; border-radius: 20%;"></td>
						</tr>
					</table>
                </div>

            </div>
            <div class="col-md-6 offset-3 mt-4">
            	<a href="edit_product.php?id=<?php echo $data['id'] ?>" class="btn btn-primary btn-lg form-control"><i class="fa fa-edit"></i></a>
            </div>
             
</div>

<?php include('ini/footer.php'); ?>