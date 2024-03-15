<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database class file
include 'dbconnection.php';

// Connect to the database
$db = new db();
$connection = $db->get_connection();

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $query = "SELECT o.id, o.order_date, o.total_price, o.order_status, od.quantity, p.product_name, p.product_image, od.product_id
        FROM orders o
        LEFT JOIN orderdetails od ON o.id = od.order_id
        LEFT JOIN products p ON od.product_id = p.id
        WHERE o.order_date BETWEEN ? AND ?";

        $statement = $connection->prepare($query);
        $statement->bind_param("ss", $start_date, $end_date);
        $statement->execute();
        $result = $statement->get_result();
        $orders = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $error_message = "Please provide both start and end dates.";
    }
} else {
    $query = "SELECT o.id, o.order_date, o.order_status, od.quantity, p.product_name, p.product_image, od.product_id
    FROM orders o
    LEFT JOIN orderdetails od ON o.id = od.order_id
    LEFT JOIN products p ON od.product_id = p.id";
    
    $result = $connection->query($query);
    $orders = $result->fetch_all(MYSQLI_ASSOC);
}

if (isset($_GET['cancel_order']) && isset($_GET['order_id'])) {
    $order_id = filter_var($_GET['order_id'], FILTER_SANITIZE_NUMBER_INT);
    $delete_order_query = "DELETE FROM orders WHERE id = ?";
    $delete_order_statement = $connection->prepare($delete_order_query);
    $delete_order_statement->bind_param('i', $order_id);

    if ($delete_order_statement->execute()) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Failed to cancel the order. Please try again.";
    }
}

// Close connection
$connection->close();
?>
