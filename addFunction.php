<?php
   include 'dbconnection.php';

$db = new db();

// Handle form submission for adding products
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['productName']) && isset($_POST['price']) && isset($_POST['category'])) {
        $productName = $db->get_connection()->real_escape_string($_POST['productName']);
        $price = $db->get_connection()->real_escape_string($_POST['price']);
        $category = $db->get_connection()->real_escape_string($_POST['category']);
        $productImage = $_FILES['productImage']['name'];

        // Directory for uploads
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            // Create the directory if it doesn't exist
            mkdir($targetDir, 0755, true);
        }

        // File upload path
        $targetFilePath = $targetDir . basename($productImage);

        // Move uploaded file to specified location
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFilePath)) {
            // Check if the product already exists in the database
            $result = $db->get_data("Products WHERE product_name = '$productName'");

            if ($result->num_rows > 0) {
                
                echo "exists";
            } else {
            
                $categoryIdQuery = $db->get_data("Categories WHERE category_name = '$category'");
                if ($categoryIdQuery->num_rows > 0) {
                    $categoryId = $categoryIdQuery->fetch_assoc()['id'];
                    $insertResult = $db->insert_data("Products", ["product_name", "product_image", "product_price", "category_id"], ["'$productName'", "'$targetFilePath'", "'$price'", "'$categoryId'"]);
                    if ($insertResult === TRUE) {
                        // Product added successfully
                        header("Location: addProductForm.php");
                    } else {
                        error_log("Error adding product: " . $db->get_connection()->error);
                        echo "An error occurred. Please try again later.";
                    }
                } else {
                    
                    echo "Category does not exist";
                }
            }
        } else {
            echo "Error uploading file";
        }
    } else {
        echo "Missing required parameters";
    }
}
?>
