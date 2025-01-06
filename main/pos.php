<?php include('ini/header.php'); ?>

<?php 
include('dbcon.php');
$productQuery = "SELECT product.*, category.cat_name FROM product LEFT JOIN category ON product.cat_id = category.cat_id";
$productResult = $con->query($productQuery);

$customerQuery = "SELECT * FROM customer";
$customerResult = $con->query($customerQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>POS System</title>
    <style>
        /* Add your CSS styling here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
    <script>
        function addProduct(id, name, code, category, buyPrice, sellPrice) {
            const table = document.getElementById('posTable');
            const row = table.insertRow();
            row.innerHTML = `
                <td><input type="hidden" name="product_id[]" value="${id}" required>${name}</td>
                <td>${code}</td>
                <td>${category}</td>
                <td><input type="hidden" name="buy_price[]" value="${buyPrice}" required>${buyPrice}</td>
                <td><input type="hidden" name="sell_price[]" value="${sellPrice}" required>${sellPrice}</td>
                <td><input type="number" name="quantity[]" value="1" min="1" required></td>
                <td><input type="number" name="paid_amount[]" value="1" min="1" required></td>
                <td><input type="number" name="due_amount[]" value="0" min="0" required></td>
            `;
        }

        function calculateTotal() {
            const quantities = document.querySelectorAll('input[name="quantity[]"]');
            const sellPrices = document.querySelectorAll('input[name="sell_price[]"]');
            let totalHaveToPaid = 0;

            quantities.forEach((quantity, index) => {
                const sellPrice = sellPrices[index].value;
                totalHaveToPaid += quantity.value * sellPrice;
            });

            document.getElementById('total_have_to_paid').value = totalHaveToPaid.toFixed(2);
        }

        function validateForm() {
            const customerId = document.getElementById('customer_id').value;
            const invoiceNo = document.getElementById('invoice_no').value;
            const date = document.getElementById('date').value;

            if (!customerId) {
                alert("Please select a customer.");
                return false;
            }

            if (!invoiceNo) {
                alert("Please enter an invoice number.");
                return false;
            }

            if (!date) {
                alert("Please enter a date.");
                return false;
            }

            const productIds = document.querySelectorAll('input[name="product_id[]"]');
            if (productIds.length === 0) {
                alert("Please add at least one product.");
                return false;
            }

            calculateTotal();
            return true;
        }

        document.querySelector('form').addEventListener('submit', function(event) {
            const customerId = document.getElementById('customer_id').value;
            document.getElementById('customer_id_hidden').value = customerId;
        });
    </script>
</head>
<body>

<h1 class="text-center">POS System</h1>

<h2>Select Customer</h2>
<form action="process_pos.php" method="post" onsubmit="return validateForm()">
    <select required class="form-control" id="customer_id" name="customer_id">
        <option value="">Select Customer</option>
        <?php while ($customer = $customerResult->fetch_assoc()) { ?>
            <option value="<?php echo $customer['cus_id']; ?>"><?php echo $customer['name']; ?></option>
        <?php } ?>
    </select>
    <br>
    <br>
    <h2>Product List</h2>
    <table class="table table-bordered text-center" id="dataTable">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Category</th>
                <th>Available Qty</th>
                <th>Buy Price</th>
                <th>Sell Price</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $productResult->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['code']; ?></td>
                <td><?php echo $row['cat_name']; ?></td>
                <td><?php echo $row['qty']; ?></td>
                <td><?php echo $row['buy_price']; ?></td>
                <td><?php echo $row['sell_price']; ?></td>
                <td><img src="img/products/<?php echo $row['photo']; ?>" height="100" width="100"></td>
                <td><button class="btn btn-success" type="button" onclick="addProduct(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>', '<?php echo $row['code']; ?>', '<?php echo $row['cat_name']; ?>', <?php echo $row['buy_price']; ?>, <?php echo $row['sell_price']; ?>)">Add</button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <h2>POS Form</h2>
    <input type="hidden" name="customer_id_hidden" id="customer_id_hidden">
    <label for="invoice_no">Invoice Number</label>
    <input type="text" name="invoice_no" id="invoice_no" required="">
    <label for="date">Date</label>
    <input type="date" name="date" id="date" required><?php echo date('y-m-d'); ?>
    <table id="posTable">
        <tr>
            <th>Product Name</th>
            <th>Product Code</th>
            <th>Category</th>
            <th>Buy Price</th>
            <th>Sell Price</th>
            <th>Quantity</th>
            <th>Paid Amount</th>
            <th>Due Amount</th>
        </tr>
    </table>
    <input type="hidden" name="total_have_to_paid" id="total_have_to_paid">
    <br>
    <button type="submit" class="btn btn-success form-control">Submit</button>
</form>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        calculateTotal();
        const customerId = document.getElementById('customer_id').value;
        document.getElementById('customer_id_hidden').value = customerId;
    });
</script>

</body>
</html>

<?php include('ini/footer.php'); ?>
