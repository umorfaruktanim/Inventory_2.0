<?php
include('ini/header.php');
include('dbcon.php');
$sql = "SELECT product.*, supplier.sup_name AS sup_name, category.cat_name FROM product 
        LEFT JOIN supplier ON product.sup_id = supplier.id 
        LEFT JOIN category ON product.cat_id = category.cat_id";
$run = mysqli_query($con, $sql);
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
                            <td>Buying Price</td>
                            <td>Selling Price</td>
                            <td>QTY</td>
                            <td>Supplier Name</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>Product Name</td>
                            <td>Product Code</td>
                            <td>Product Category</td>
                            <td>Buying Price</td>
                            <td>Selling Price</td>
                            <td>QTY</td>
                            <td>Supplier Name</td>
                            <td>Action</td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php while ($data = mysqli_fetch_assoc($run)) { ?>
                            <tr>
                                <td><?php echo $data['name'] ?></td>
                                <td><?php echo $data['code'] ?></td>
                                <td><?php echo $data['cat_name'] ?></td>
                                <td><?php echo $data['buy_price'] ?></td>
                                <td><?php echo $data['sell_price'] ?></td>
                                <?php if($data['qty'] < 10) { ?>
                                	<td class="text-danger font-weight-bold"><?php echo $data['qty'] ?></td>
                                <?php }else{ ?>
                                <td><?php echo $data['qty'] ?></td>
                            <?php } ?>
                                <td><?php echo $data['sup_name'] ?></td>
                                <td>
                                    <a href="update_stock.php?id=<?php echo $data['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                                    <a href="view_product.php?id=<?php echo $data['id'] ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a><br><br>
                                    <a href="edit_product.php?id=<?php echo $data['id'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="delete_product.php?id=<?php echo $data['id'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></a>
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
