<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db_connection.php';

$orderID = $_POST['orderID'];
$itemName = $_POST['itemName'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

if (empty($orderID)) {
    // Create a new order if no orderID is passed
    $sql_create_order = "INSERT INTO `Order` (Status, CreatedAt) VALUES ('Not Shipped', NOW())";
    $stmt_create_order = $conn->prepare($sql_create_order);

    if ($stmt_create_order === false) {
        die('Error in prepare (create order): ' . $conn->error);
    }

    if ($stmt_create_order->execute()) {
        $orderID = $stmt_create_order->insert_id; 
        echo "New order created! Your Order ID is: " . $orderID . "<br>";
    } else {
        echo "Error creating order: " . $stmt_create_order->error;
        exit();
    }

    $stmt_create_order->close();
}

// Check if the OrderID exists
$sql_check_order = "SELECT * FROM `Order` WHERE OrderID = ?";
$stmt_check_order = $conn->prepare($sql_check_order);

if ($stmt_check_order === false) {
    die('Error in prepare (check order): ' . $conn->error);
}

$stmt_check_order->bind_param("i", $orderID); 
$stmt_check_order->execute();
$result = $stmt_check_order->get_result();

if ($result->num_rows > 0) {
    // Fetch the current total amount of the order
    $order = $result->fetch_assoc();
    $currentTotalAmount = $order['TotalAmount']; // Existing total amount of the order
    
    $itemTotal = $quantity * $price;
    
    $newTotalAmount = $currentTotalAmount + $itemTotal;

    $sql_insert_item = "INSERT INTO `OrderItems` (OrderID, ItemName, Quantity, Price) VALUES (?, ?, ?, ?)";
    $stmt_insert_item = $conn->prepare($sql_insert_item);

    if ($stmt_insert_item === false) {
        die('Error in prepare (insert item): ' . $conn->error);
    }

    $stmt_insert_item->bind_param("isid", $orderID, $itemName, $quantity, $price);

    if ($stmt_insert_item->execute()) {
        $sql_update_total = "UPDATE `Order` SET TotalAmount = ? WHERE OrderID = ?";
        $stmt_update = $conn->prepare($sql_update_total);
        $stmt_update->bind_param("di", $newTotalAmount, $orderID);

        if ($stmt_update->execute()) {
            echo "Item added successfully to Order ID: " . $orderID . "<br>";
            echo "New total amount for the order: $" . number_format($newTotalAmount, 2);
        } else {
            echo "Error updating total amount: " . $stmt_update->error;
        }

        $stmt_update->close();
    } else {
        echo "Error adding item: " . $stmt_insert_item->error;
    }

    $stmt_insert_item->close();
} else {
    echo "Error: Order ID does not exist.";
}

$stmt_check_order->close();

echo '<br><br><a href="index.html" style="display: inline-block; padding: 10px 20px; background-color: #007BFF; color: #FFFFFF; text-decoration: none; border-radius: 5px;">Back to Main Menu</a>';

$conn->close();
?>
