<?php
include 'db_connection.php';

$orderID = $_POST['orderID'];

$sql = "UPDATE `Order` SET Status = 'Cancelled' WHERE OrderID = '$orderID'";

if ($conn->query($sql) === TRUE) {
    echo "Order cancelled successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

echo '<br><br><a href="index.html" style="display: inline-block; padding: 10px 20px; background-color: #007BFF; color: #FFFFFF; text-decoration: none; border-radius: 5px;">Back to Main Menu</a>';

$conn->close();
?>
