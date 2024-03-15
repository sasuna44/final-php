<?php
include 'dbconnection.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_name = validate_data($_POST['user_name']);
    $user_email = validate_data($_POST['user_email']);
    $user_password = validate_data($_POST['user_password']);
    $room_number = validate_data($_POST['room_number']);
    $ext_number = validate_data($_POST['ext_number']);

    // Validate other fields if needed

    // Check if the email already exists in the database
    if (emailExists($user_email)) {
        $errors['user_email'] = "Email already exists. Please use a different email address.";
    }

    // Check if a file was uploaded
    if (!empty($_FILES['user_image']['name'])) {
        $user_image = $_FILES["user_image"]["name"];
        $upload_directory = "images/"; // Specify the desired directory
        $upload_path = $upload_directory . basename($user_image);
        if (!move_uploaded_file($_FILES["user_image"]["tmp_name"], $upload_path)) {
            $errors['file_upload'] = "Failed to upload file.";
        }
    } else {
        $errors['user_image'] = "Please upload an image.";
    }
    if (empty($errors)) {
        $db = new db();

        // Insert room data into "Rooms" table
        $db->insert_data_user(
            "Rooms",
            ["room_number", "ext_number"],
            ["'$room_number'", "'$ext_number'"]
        );

        // Get the inserted room's ID
        $room_id = $db->get_last_insert_id($db->get_connection());

        // Insert user data into "Users" table
        $db->insert_data_user(
            "Users",
            ["user_name", "user_email", "user_password", "user_image", "room_number", "ext_number"],
            ["'$user_name'", "'$user_email'", "'$user_password'", "'$user_image'", "'$room_number'", "'$ext_number'"]
        );

        // Fetching user data after insertion
        $result = $db->get_user_data('Users', "user_email = '$user_email'");
        $user_data = $result->fetch_assoc();

        // Starting session and setting session variables
        session_start();
        $_SESSION['id'] = $user_data['id'];
        $_SESSION['user_email'] = $user_data['user_email'];

        // Redirecting user to dashboard or any other page after successful registration
        header("Location: addUser.php");
        exit;
    }
}

function emailExists($email)
{
    $db = new db();
    $result = $db->get_user_data('Users', "user_email = '$email'");
    return $result->num_rows > 0;
}

function validate_data($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
