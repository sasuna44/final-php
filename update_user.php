<?php
include 'dbconnection.php';

$db = new db();

$conn = $db->get_connection();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $user_name = $_POST["user_name"];
    $user_email = $_POST["user_email"];
    $room_number = $_POST["room_number"];
    $ext_number = $_POST["ext_number"];

    $room_number = empty($room_number) ? "NULL" : $room_number;
    $ext_number = empty($ext_number) ? "NULL" : $ext_number;

    if(isset($_FILES["user_image"]["name"]) && $_FILES["user_image"]["name"] !== '') {
        $target_file =  basename($_FILES["user_image"]["name"]);
        
        if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
            $update_result = $db->update_user_data($id, $user_name, $user_email, $room_number, $ext_number, $target_file);
            if ($update_result === TRUE) {
                echo "User updated successfully.";
            } else {
                echo "Error updating user: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        $update_result = $db->update_user_data($id, $user_name, $user_email, $room_number, $ext_number);
        if ($update_result === TRUE) {
            echo "User updated successfully.";
        } else {
            echo "Error updating user: " . $conn->error;
        }
    }
}

header("Location: allUsers.php");
?>
