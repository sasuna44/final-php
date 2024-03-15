<?php
include 'get_order_details.php'; // Include the file to get order details

// include 'db.php'; // Include the database class file

$db = new db();
$connection = $db->get_connection(); // Get MySQLi connection from db class

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Your custom CSS -->
    <link rel="stylesheet" href="css.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Your Name</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                
                <li class="nav-item">
                    <a class="nav-link" href="chec.php">my orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="my-orders">
    <section class="main-padding">
        <div class="container">
            <h1>My Orders</h1>
            <form id="order-form" action="" method="post">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="start_date">Date from:</label>
                            <input type="date" class="form-control start"  id="start_date" name="start_date" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="end_date">Date to:</label>
                            <input type="date" class="form-control end" id="end_date" name="end_date" />
                            <?php if(isset($error_message)) echo "<p class='text-danger'>$error_message</p>"; ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <input type="submit" name="submit" value="Check" class="p-2 m-2" />
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="main-padding">
        <div class="container">
            <div class="admin-orders">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Order Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'functions.php'; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Display product images -->
    <section class="main-padding">
        <div class="container product-images">
            <?php
            if (isset($orders) && is_array($orders)) {
                $displayed_products = array();
                $products_in_row = 0;

                foreach ($orders as $order) {
                    if (!in_array($order['product_id'], $displayed_products)) {
                        $displayed_products[] = $order['product_id'];

                        if ($products_in_row == 4) {
                            echo "</div><div class='product-images'>";
                            $products_in_row = 0;
                        }

                        echo "<div class='product-image'>";
                        echo "<img src='" . $order['product_image'] . "' alt='" . $order['product_name'] . "' class='product-thumbnail'>";
                        echo "<p>" . $order['product_name'] . "</p>";
                        echo "</div>";

                        $products_in_row++;
                    }
                }
            }
            ?>
        </div>
    </section>

    <!-- Display total amount -->
    <section class="main-padding">
        <div class="container">
            <?php
            $total_price_query = "SELECT od.order_id, SUM(p.product_price * od.quantity) AS total_price 
                                  FROM orderdetails od 
                                  JOIN products p ON od.product_id = p.id 
                                  GROUP BY od.order_id";

            $total_price_result = $connection->query($total_price_query);
            $total_amount = 0;

            if ($total_price_result) {
                while ($total_price_row = $total_price_result->fetch_assoc()) {
                    if ($total_price_row['total_price'] !== null) {
                        $total_amount += $total_price_row['total_price'];
                    }
                }
            }
            ?>
            <div class="total-price"> 
                <h3>Total Amount</h3>
                <h3>EGP <span><?php echo $total_amount; ?></span></h3>
            </div>
        </div>
    </section>
</main>

<footer class="footer">
    <div class="container text-center">
        <span>&copy; 2024 Your Company</span>
    </div>
</footer>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

<!-- Order Details Modals -->
<?php if(isset($orders) && is_array($orders)): ?>
    <?php foreach ($orders as $order): ?>
        <!-- Order Details Modal -->
        <div class="modal fade" id="orderDetailsModal<?php echo $order['id']; ?>" tabindex="-1" aria-labelledby="orderDetailsModalLabel<?php echo $order['id']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderDetailsModalLabel<?php echo $order['id']; ?>">Order Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Query to get order details related to this order
                                $query_order_details = "SELECT orderdetails.quantity, products.product_name, products.product_price, products.product_image
                                                        FROM orderdetails
                                                        INNER JOIN products ON orderdetails.product_id = products.id
                                                        WHERE orderdetails.order_id = ?";
                                $statement_order_details = $connection->prepare($query_order_details);
                                $statement_order_details->bind_param('i', $order['id']);
                                $statement_order_details->execute();
                                $result_order_details = $statement_order_details->get_result();

                                while ($detail = $result_order_details->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $detail['product_name']; ?></td>
                                        <td><?php echo $detail['quantity']; ?></td>
                                        <td><?php echo $detail['product_price']; ?></td>
                                        <td><img src="<?php echo $detail['product_image']; ?>" alt="<?php echo $detail['product_name']; ?>" style="max-width: 100px;"></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Cancel Confirmation Modals -->
<?php foreach ($orders as $order): ?>
    <div id="cancelConfirmationModal<?php echo $order['id']; ?>" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cancel Order Confirmation</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel this order?</p>
                </div>
                <div class="modal-footer">
                    <!-- Link to cancel the order with the appropriate order_id -->
                    <a href="?cancel_order=true&order_id=<?php echo $order['id']; ?>" class="btn btn-danger">Yes, Cancel Order</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Keep Order</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>



<script>
    $(document).ready(function() {
        // Function to handle the click event of "View Details" link
        $('.view-details-btn').on('click', function() {
            // Extract the order ID from the data attribute
            var orderId = $(this).data('order-id');
            // Form the modal ID using the order ID
            var modalId = "#orderDetailsModal" + orderId;
            // Show the modal with the corresponding ID
            $(modalId).modal('show');
        });

        // Function to handle the click event of "Cancel Order" link
        $('.cancel-order-btn').on('click', function() {
            var orderId = $(this).data('order-id');
            var modalId = "#cancelConfirmationModal" + orderId;
            $(modalId).modal('show');
        });

        // Function to handle the scroll event for the navbar
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                document.querySelector(".navbar").classList.add("navbar-scrolled");
            } else {
                document.querySelector(".navbar").classList.remove("navbar-scrolled");
            }
        }
    });
</script>



</body>
</html>
