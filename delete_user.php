<?php
   include 'dbconnection.php';

$db = new db();
$conn = $db->get_connection();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $result = $db->del_data('Users', $id);
    if ($result === TRUE) {
        echo "User deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

header("Location: allUsers.php");
exit;
?>