<?php
include('ini/header.php');
include('dbcon.php');

// Updated SQL query to calculate total quantity for each code
$sql = "SELECT p.*, 
               s.sup_name AS sup_name, 
               c.cat_name AS cat_name, 
               (SELECT SUM(qty) FROM product WHERE code = p.code) AS total_qty 
        FROM product p
        LEFT JOIN supplier s ON p.sup_id = s.id
        LEFT JOIN category c ON p.cat_id = c.cat_id";
$run = mysqli_query($con, $sql);
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
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
                        <?php while ($data = mysqli_fetch_assoc($run)) { 
                            $individual_qty = $data['qty'];

                            $total_qty = $data['total_qty'];

                            $color_class = ($total_qty < 10) ? "text-danger font-weight-bold" : "text-success font-weight-bold";
                        ?>
                            <tr>
                                <td><?php echo $data['name']; ?></td>
                                <td><?php echo $data['code']; ?></td>
                                <td><?php echo $data['cat_name']; ?></td>
                                <td><?php echo $data['buy_price']; ?></td>
                                <td><?php echo $data['sell_price']; ?></td>
                                <td class="<?php echo $color_class; ?>"><?php echo $individual_qty; ?></td>
                                <td><?php echo $data['sup_name']; ?></td>
                                <td>
                                    <a href="update_stock.php?id=<?php echo $data['id']; ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                                    <a href="view_product.php?id=<?php echo $data['id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a><br><br>
                                    <a href="edit_product.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="delete_product.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></a>
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
