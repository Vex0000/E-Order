<?php
include 'db_connection.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if (isset($_GET['orderID'])) {
    $orderID = intval($_GET['orderID']);  

    // Query to get the total amount for the order
    $sql = "SELECT TotalAmount FROM `Order` WHERE OrderID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the total amount from the result
        $row = $result->fetch_assoc();
        $response = [
            'success' => true,
            'totalAmount' => $row['TotalAmount']
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Order not found'
        ];
    }

    // Return the response as JSON
    echo json_encode($response);
}

$conn->close();
?>
