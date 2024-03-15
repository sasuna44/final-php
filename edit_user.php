<?php
   include 'dbconnection.php';

$db = new db();

$conn = $db->get_connection();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $result = $db->get_data("Users WHERE id = $id");

    if ($result->num_rows > 0) {
    
        $row = $result->fetch_assoc();
        $user_name = $row["user_name"];
        $user_email = $row["user_email"];
        $role = $row["role"];
        $room_number = $row["room_number"];
        $ext_number = $row["ext_number"];
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="./css/style.css"> -->

</head>

<body>
    <h2>Edit User</h2>
    <form action="update_user.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label for="user_name">User Name:</label><br>
    <input type="text" id="user_name" name="user_name" value="<?php echo $user_name; ?>"><br>
    <label for="user_email">Email:</label><br>
    <input type="email" id="user_email" name="user_email" value="<?php echo $user_email; ?>"><br>
    <label for="room_number">Room Number:</label><br>
    <input type="text" id="room_number" name="room_number" value="<?php echo $room_number; ?>"><br>
    <label for="ext_number">Extension Number:</label><br>
    <input type="text" id="ext_number" name="ext_number" value="<?php echo $ext_number; ?>"><br>
    <label for="user_image">Image:</label><br>
    <input type="file" id="user_image" name="user_image"><br>
    <button type="submit">Update User</button>
</form>


</body>

</html>
<?php
    } else {
        echo "User not found.";
    }
}
?>

