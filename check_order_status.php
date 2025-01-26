<?php
include 'db_connection.php';

if (isset($_GET['orderID']) && is_numeric($_GET['orderID'])) {
    $orderID = intval($_GET['orderID']); 

    $sql = "SELECT o.Status, i.ItemName, i.Quantity, o.TotalAmount, o.CreatedAt 
            FROM `Order` o 
            LEFT JOIN `OrderItems` i ON o.OrderID = i.OrderID
            WHERE o.OrderID = $orderID";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $orderFound = false;
        // Fetch and display order details
        while ($row = $result->fetch_assoc()) {
            if (!$orderFound) {
                echo "Order Status: " . htmlspecialchars($row['Status']) . "<br>";
                echo "Total Amount: $" . number_format($row['TotalAmount'], 2) . "<br>";
                echo "Created At: " . htmlspecialchars($row['CreatedAt']) . "<br><br>";
                $orderFound = true;
            }

            echo "Item: " . htmlspecialchars($row['ItemName']) . "<br>";
            echo "Quantity: " . $row['Quantity'] . "<br><br>";
        }
    } else {
        echo "No order found with ID: $orderID";
    }
} else {
    echo "Invalid or missing order ID.";
}

echo '<br><br><a href="index.html" style="display: inline-block; padding: 10px 20px; background-color: #007BFF; color: #FFFFFF; text-decoration: none; border-radius: 5px;">Back to Main Menu</a>';

$conn->close();
?>
