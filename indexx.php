
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styleIndex.css">
    <!-- <script src="./js/script.js"></script> -->
    <style>
#section1 ,#section2 ,#section3 {
  height: 800px;
  margin-top: 50px;
  width: 1400px;
  display: flex;
  align-items: start;
  flex-direction: column;
  justify-content: space-around;
}

#section1 ,#section2 ,#section3 {
  height: 200px;
  margin-top: 50px;
  width: 1400px;
  display: flex;
  align-items: start;
  flex-direction: column;
  justify-content: space-around;
}

#section1 p,
#section2 p,
#section3 p {
  text-align: center;
  /* background-color: red; */
  color: white;
  margin: 0; /* Reset margin */
  padding: 10px; 
  width:600px;
}

.form-select {
  width: 20%;
  display: block;
  border: 2px solid #ccc;
  border-radius: 5px;
  background-color: transparent;
  color: white;
  margin-bottom: 20px; /* Corrected typo */
  padding-top:10px;
  padding-bottom:10px;
}

.form-select option {
  padding-top:20px;
  padding:20px;
  color:black;
  font-size:17px
}
.items{
  display:flex;
  flex-direction:row;
  align-items: center;
  justify-content: space-between;
  width: 1400px;
}
/* Add this CSS to your existing styles */
.card {
  width: 300px; /* Adjust the width as needed */
  margin: 20px; /* Add some margin for spacing */
  border: 1px solid #ccc; /* Add a border for visual separation */
  border-radius: 5px; /* Add rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}
.card-body {
  padding: 20px;
}
.card img{
  height: 200px !important;
}
.card-img-top {
  width: 100%;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}
.list-group-item{
  
  color: black ;
  background-color:#6fb936 ;
}
.imgs {
  display: flex;
  flex-direction: row;
  justify-content: center;
  position: relative;
  display: inline-block;
}

.card {
  width: 300px;
  height: 400px;
  margin: 0 10px; 
  position: relative;
  overflow: hidden;
  border-radius: 20px; 
}

.card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.behind {
  position: absolute;
  top: 0;
  left: 58%;
  transform: translateX(-50%);
  z-index: -1;
  transform: rotate(30%);
}
.behind img{
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); 
  filter: blur(2px);
}
.frist {
  box-shadow: 10px 0px 20px 10px rgba(10, 1, 1, 0.873); 
  position: relative;
  z-index: 1; 
}

        </style>
</head>

<body>
    <div id="smooth-wrapper container">
        <div id="smooth-content">
            <!--  -->
            <nav class="navbar navbar-expand-lg  navbar-dark fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="#">Your name</a>
                    <img src="" alt="img" />
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="orders.php">manual orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">checks</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!--  -->
            <div class="checks container">
                <div class="des">
                    <h1>checks</h1> <a href="#section2" class="section2">orders</a>
                    <a href="#section1">users</a>
                </div>
                <div class="datecheck">
                    <form method="GET">
                        <div class="form-group">
                            <label for="fromDate">From:</label>
                            <input type="date" class="form-control" id="fromDate" name="fromDate" placeholder="Select start date">
                        </div>
                        <div class="form-group">
                            <label for="toDate">To:</label>
                            <input type="date" class="form-control" id="toDate" name="toDate" placeholder="Select end date">
                        </div>

                        <?php
                        include 'dbconnection.php'; // Include the database class file
                        $db = new db();
                        // Create an instance of the database class
                        $result = $db->get_connection()->query("SELECT * FROM users WHERE role = 'user'");

                        // Check if there are any users
                        if ($result->num_rows > 0) {
                            // Start the select dropdown menu
                            echo '<select class="form-select" aria-label="Default select example" name="userId">';
                            echo '<option selected disabled>Choose user</option>';

                            // Fetch each user's data and create an option tag for their name
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['user_name'] . '</option>';
                            }

                            // Close the select dropdown menu
                            echo '</select>';
                        } else {
                            echo 'No users found.';
                        }
                        ?>
                        <button type="submit" class="btn ">Submit</button>
                    </form>
                    <!--  -->
                    <div class="imgs">
                        <div class="card frist">
                            <img src="./img/coffe.jpg" alt="Image 1">
                        </div>
                        <div class="card behind">
                            <img src="./img/coffe.jpg" alt="Image 2">
                        </div>
                    </div>
                    <!--  -->
                </div>
                <section class="main" id="section1">
    <h2>Users</h2>
    <?php
    // Check if fromDate and toDate are set in the $_GET array
    if (isset($_GET['fromDate']) && isset($_GET['toDate'])) {
        // Retrieve start date and end date from the form
        $fromDate = $_GET['fromDate'];
        $toDate = $_GET['toDate'];
        
        // Create an instance of the database class
        $db = new db();
        
        // Initialize the user condition
        $userCondition = "";
        
        // Check if userId is set
        if (isset($_GET['userId'])) {
            $userId = $_GET['userId'];
            // Construct the user condition
            $userCondition = "AND u.id = $userId";
        }
        
        // Construct the SQL query to fetch the sum of total prices for all orders within the specified date range
        if (!empty($fromDate) && !empty($toDate)) {
            // Construct the SQL query to fetch the sum of total prices
       // Construct the SQL query to fetch the sum of total prices for users who are not admins
$query = "SELECT u.user_name, SUM(od.quantity * p.product_price) AS total_price 
FROM users u 
INNER JOIN orders o ON u.id = o.user_id
INNER JOIN orderdetails od ON o.id = od.order_id
INNER JOIN products p ON od.product_id = p.id
WHERE o.order_date BETWEEN '$fromDate' AND '$toDate'
AND u.role != 'admin'  -- Exclude admin users
$userCondition
GROUP BY u.user_name";

            
            // Execute the query
            $result = $db->get_connection()->query($query);
        
            // Process the result...
        } else {
            echo "Please select valid start and end dates.";
        }
        
        
        // Display the user's name and total price
        if ($result->num_rows > 0) {
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr><th>User Name</th><th>Total Price</th></tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["user_name"] . '</td>';
                echo '<td>' . $row["total_price"] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No order details found within the specified time period.</p>';
        }
    } else {
        echo '<p >Please select start date and end date.</p>';
    }
    ?>
</section>
<!-- section 2 -->
<section id="section2" style="overflow: scroll;">
<h2>Orders</h2>
<?php
if (isset($_GET['fromDate']) && isset($_GET['toDate'])) {
    $fromDate = $_GET['fromDate'];
    $toDate = $_GET['toDate'];
    
    $db = new db();
    $query = "SELECT o.id AS order_id, o.order_date, od.product_id, p.product_name, od.quantity, (od.quantity * p.product_price) AS total_price
              FROM orders o 
              INNER JOIN orderdetails od ON o.id = od.order_id
              INNER JOIN products p ON od.product_id = p.id
              WHERE o.order_date BETWEEN '$fromDate' AND '$toDate'";

    if (!empty($userId)) {
        $query .= " AND o.user_id = $userId";
    }

    $result = $db->get_connection()->query($query);

    if ($result->num_rows > 0) {
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr><th>Order ID</th><th>Order Date</th><th>Product Name</th><th>Quantity</th><th>Total Price</th></tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['order_id'] . '</td>'; 
            echo '<td>' . $row['order_date'] . '</td>'; 
            echo '<td>' . $row['product_name'] . '</td>'; 
            echo '<td>' . $row['quantity'] . '</td>'; 
            echo '<td>' . $row['total_price'] . '</td>'; 
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No orders found for the selected user within the specified time period.</p>';
    }
} else {
    echo '<p>Please select start and end dates.</p>';
}
?>
</section>

<!-- section 3 -->
<section id="section3">
<h2>orders details</h2>
<div class="items">
    <?php
    // Check if fromDate, toDate, and userId are set in the $_GET array
    if (isset($_GET['fromDate']) && isset($_GET['toDate']) && isset($_GET['userId'])) {
        // Retrieve start date, end date, and user ID from the form
        $fromDate = $_GET['fromDate'];
        $toDate = $_GET['toDate'];
        $userId = $_GET['userId'];
        
        // Create an instance of the database class
        $db = new db();
        
        // Construct the SQL query to fetch product details and order quantity for the specified user and date range
// Construct the SQL query to fetch product details and order quantity for the specified user and date range
$query = "SELECT p.product_image, p.product_name, p.product_price, od.quantity 
          FROM orderdetails od
          INNER JOIN products p ON od.product_id = p.id
          INNER JOIN orders o ON od.order_id = o.id
          WHERE o.order_date BETWEEN '$fromDate' AND '$toDate' AND o.user_id = $userId";


        // Execute the query
        $result = $db->get_connection()->query($query);

        // Display the order details
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<img src="' . $row["product_image"] . '" class="card-img-top" alt="Product Image">';
                echo '<div class="card-body">';
                echo '<ul class="list-group">';
                echo '<li class="list-group-item">Name: ' . $row["product_name"] . '</li>';
                echo '<li class="list-group-item">Price: $' . $row["product_price"] . '</li>';
                echo '<li class="list-group-item">Quantity: ' . $row["quantity"] . '</li>';
                echo '</ul>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No order details found.</p>';
        }
    } else {
        echo '<p>Please select start date, end date, and user ID.</p>';
    }
    ?>
    </div>
</section> 

        </div>
    </div>
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span>&copy; 2024 Your Company</span>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    window.onload = function () {
        $(document).ready(function () {
            $("a").on('click', function (event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function () {
                        window.location.hash = hash;
                    });
                }
            });
        });

        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                document.querySelector("nav").classList.add("navbar-scrolled");
            } else {
                document.querySelector("nav").classList.remove("navbar-scrolled");
            }
        }
    }

   
</script>



</body>

</html>