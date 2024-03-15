<?php
   include 'dbconnection.php';

$db = new db();

$conn = $db->get_connection();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $result = $db->get_data("Products WHERE id = $id");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row["product_name"];
        $product_price = $row["product_price"];
        ?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="./css/style.css"> -->
</head>

<body>
    <div id="maincontainer">
    <h2>Edit Product</h2>
    <form action="update_product.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="product_name">Product Name:</label><br>
        <input type="text" id="product_name" name="product_name" value="<?php echo $product_name; ?>"><br>
        <label for="product_price">Product Price:</label><br>
        <input type="text" id="product_price" name="product_price" value="<?php echo $product_price; ?>"><br>
        <label for="is_active">Active:</label>
        <input type="checkbox" id="is_active" name="is_active" value="0">
        <br>
        <label for="category">Category:</label><br>
    <select id="category" name="category">
        <?php
        $db = new db();
        $categories = $db->get_categories();
        while ($category = $categories->fetch_assoc()) {
            echo "<option value=\"{$category['id']}\">{$category['category_name']}</option>";
           
        }
        ?>
    </select><br>
        <label for="product_image">Product Image:</label><br>
        <input type="file" id="product_image" name="product_image"><br>
        <button type="submit">Update Product</button>
    </form>
    </div>
</body>

</html>
<?php
    } else {
        echo "Product not found.";
    }
}
?>