<?php
include 'dbconnection.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'deliver' button was clicked
    if (isset($_POST["deliver"])) {
        // Get the order ID from the form submission
        $order_id = $_POST["order_id"];

       $db = new db();
        $connection = $db->get_connection();

        // Perform the SQL query to update the order status to 'Delivered'
        $update_query = "UPDATE orders SET order_status = 'out for delivery' WHERE id = $order_id";

        // Execute the query
        if ($connection->query($update_query) === TRUE) {
            // Close the database connection
            $connection->close();
            // Redirect back to the same page
            header("Location: orders.php");
            exit();
        } else {
            echo "Error updating record: " . $connection->error;
        }
    } elseif (isset($_POST["done"])) { // Check if the 'done' button was clicked
        // Get the order ID from the form submission
        $order_id = $_POST["order_id"];

        // Connect to the database
        $db = new db();
        $connection = $db->get_connection();

        // Perform the SQL query to update the order status to 'Done'
        $update_query = "UPDATE orders SET order_status = 'Done' WHERE id = $order_id";

        // Execute the query
        if ($connection->query($update_query) === TRUE) {
            // Close the database connection
            $connection->close();
            // Redirect back to the same page
            header("Location: orders.php");
            exit();
        } else {
            echo "Error updating record: " . $connection->error;
        }
    }
}
?>