<?php
include('dbcon.php'); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $invoice_no = $_POST['invoice_no'];
    $date = $_POST['date'];
    $product_ids = $_POST['product_id'];
    $quantities = $_POST['quantity'];
    $paid_amounts = $_POST['paid_amount'];
    $due_amounts = $_POST['due_amount'];

    // Initialize total have to paid
    $total_have_to_paid = 0;

    // Check if customer_id exists in the customer table
    $sql_check_customer = "SELECT 1 FROM customer WHERE cus_id = ?";
    $stmt_check_customer = $con->prepare($sql_check_customer);
    $stmt_check_customer->bind_param("i", $customer_id);
    $stmt_check_customer->execute();
    $stmt_check_customer->store_result();

    if ($stmt_check_customer->num_rows > 0) {
        $stmt_check_customer->close();

        // Check if invoice_no already exists in the pos table
        $sql_check_invoice = "SELECT 1 FROM pos WHERE invoice_no = ?";
        $stmt_check_invoice = $con->prepare($sql_check_invoice);
        $stmt_check_invoice->bind_param("s", $invoice_no);
        $stmt_check_invoice->execute();
        $stmt_check_invoice->store_result();

        if ($stmt_check_invoice->num_rows > 0) {
            $stmt_check_invoice->close();
            echo "<script>
                   window.alert('Error: Invoice number already exists.');
                   window.open('pos.php','_self');
                </script>";
        } else {
            $stmt_check_invoice->close();

            // Prepare the SQL statement for inserting into the pos table
            $stmt_insert_pos = $con->prepare("INSERT INTO pos (product_id, product_name, product_code, product_category, buy_price, sell_price, quantity, customer_id, paid_amount, due_amount, datee, invoice_no, total_have_to_paid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            // Prepare the SQL statement for updating the product table
            $stmt_update_product = $con->prepare("UPDATE product SET qty = ? WHERE id = ?");

            $allProductsAvailable = true; // Flag to check if all products have sufficient quantity

            foreach ($product_ids as $index => $product_id) {
                $quantity = $quantities[$index];
                $paid_amount = $paid_amounts[$index];
                $due_amount = $due_amounts[$index];

                // Fetch product details from the product table
                $sql_product = "SELECT product.*, category.cat_name FROM product LEFT JOIN category ON product.cat_id = category.cat_id WHERE product.id = ?";
                $stmt_product = $con->prepare($sql_product);
                $stmt_product->bind_param("i", $product_id);
                $stmt_product->execute();
                $result_product = $stmt_product->get_result();
                $row_product = $result_product->fetch_assoc();
                $stmt_product->close();

                $product_name = $row_product['name'];
                $product_code = $row_product['code'];
                $product_category = $row_product['cat_name'];
                $buy_price = $row_product['buy_price'];
                $sell_price = $row_product['sell_price'];
                $available_qty = $row_product['qty'];

                if ($quantity > $available_qty) {
                    $allProductsAvailable = false;
                    echo "<script>
                           window.alert('Error: Insufficient quantity for product {$product_name}. Available quantity: {$available_qty}');
                           window.open('pos.php','_self');
                        </script>";
                    break; // Exit the loop if any product has insufficient quantity
                }

                // Calculate total have to paid for this product
                $total_product_paid = $quantity * $sell_price;

                // Bind parameters and execute the insert statement
                $stmt_insert_pos->bind_param("isssiiiidissd", $product_id, $product_name, $product_code, $product_category, $buy_price, $sell_price, $quantity, $customer_id, $paid_amount, $due_amount, $date, $invoice_no, $total_product_paid);
                $stmt_insert_pos->execute();

                // Update the quantity in the product table
                $new_qty = $available_qty - $quantity;
                $stmt_update_product->bind_param("ii", $new_qty, $product_id);
                $stmt_update_product->execute();

                // Accumulate total have to paid for all products
                $total_have_to_paid += $total_product_paid;
            }

            // Close the statements
            $stmt_insert_pos->close();
            $stmt_update_product->close();
        }

        // Close the database connection
        $con->close();

        if ($allProductsAvailable) {
            echo "<script>
                   window.alert('Sale done');
                   window.open('all_pos.php','_self');
                </script>";
        }
    } else {
        $stmt_check_customer->close();
        echo "Invalid customer ID.";
    }
} else {
    echo "Invalid request method.";
}
?>