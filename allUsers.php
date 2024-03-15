<!doctype html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <title>all Users</title>
    <!-- <script src="/js/createProducts.js"></script> -->
    <link rel="stylesheet" href="./css/admin_style.css">
    
</head>
<style>
    /* 
       :root {
    --dark: #1d1d1d;
    --grey-dark: #414141;
    --light: #fff;
    --mid: #ededed;
    --grey: #989898;
    --gray: #989898;
    --green: #28a92b;
    --green-dark: #4e9815;
    --green-light: #6fb936;
    --blue: #2c7ad2;
    --purple: #8d3dae;
    --red: #c82736;
    --orange: #e77614;
    accent-color: var(--green);
  }
  * {
    margin: 0;
    padding: 0;
}
    body {
    background-image:
    linear-gradient(to bottom, rgba(245, 246, 252, 0.718), rgba(94, 141, 112, 0.73)),
    url('images/back.jpg');
    background-size: cover;
    color: rgb(62, 62, 62);
    padding: 20px;
}
 
#add{
        text-decoration: none;
        color: #414141;
        font-weight: bold;
        font-size: 1.1rem;
    }
    #add:hover{
        color:#28a92b;
    }


.navbar-dark .navbar-brand {
color: #ffffff;
}
.navbar-dark .navbar-nav .nav-link {
color: #ffffff;
}

.navbar-brand {
    color: #ffffff;
    font-weight: bold;
}

.navbar-brand:hover {
    color: #28a92b;
}

.navbar-nav .nav-link {
    color: #ffffff;
    font-weight: bold;
}

.navbar-nav .nav-link:hover {
    color: #28a92b;
}

ul {
    list-style: none;
    display: flex;
    justify-content: space-between;
}

h3 {
    color: #1d1d1d;
    font-weight: bold;
    font-size: 3rem;
}
#allproduct{
    margin-top: 7rem;
    color: #414141;
    width:100%;
    text-align:center;
}
.card{
    margin:0.5rem;
    width: 18rem;
    border: 2px solid transparent;
    transition: border-color 0.4s ease;
    box-shadow: 2px 2px 3px #e0e5fec6; 
    background-image: linear-gradient(to bottom,transparent 85%,#28a92a70);
}
.card:hover{
    border-color: #98989883;
    cursor: pointer;
    background-image: linear-gradient(to bottom,#98989883 80%,transparent);
}
.card-img-top {
    width: 100%;
    height:20rem;
    margin:0.5rem 0 0 0 ;
}

#cardcontainer {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    
}
.list-group {
    width: 100%;
    margin: 0 1rem 0 0;
    box-shadow: 
        3px 3px 2px #e0e5fec6,
        -3px -3px 2px #e0e5fec6;
}

.list-group li {
    color: #414141;
    font-weight: bold;
    background-color: transparent;

}
.navbar {
    background-color: transparent !important;
    transition: background-color 0.4s ease;
  
  }
  .navbar-scrolled {
    background-color:#6fb936 !important;
  }
  .available {
    color: #28a92b;
    font-weight: bold;
}

.unavailable {
    color: red;
    font-weight: bold;
}
.btncontainer{
    display: flex;
    justify-content: space-evenly;
    align-items: baseline;
    margin:0.5rem 0 auto;
    height:2rem;   
} */


.btncontainer{
    display: flex;
    justify-content: space-evenly;
    align-items: baseline;
    margin:0.5rem 0 auto;
    height:2rem;   
}
.no-room,
.no-ext{
    color:red !important;
}
</style>

<body>
    <div class="container">
        <nav class="navbar main-nav navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
                <?php
                   include 'dbconnection.php';

                    $db = new db();

                    $conn = $db->get_connection();

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $result = $db->get_data('Users WHERE role = "admin"');

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo '<a class="navbar-brand nav-brand nav-name" href="#">' . $row["user_name"] . '</a>';
                        echo '<img src="' . $row["user_image"] . '" alt="img" width="60" height="60" />'
                        ;
                    } else {
                        echo "0 results";
                    }
                ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ul-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link nav-item-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-item-link" href="allProducts.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-item-link" href="allUsers.php">Users <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-item-link" href="#">Manual orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-item-link" href="indexx.php">Checks</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" id="allproduct">
            <div>
                <ul id="ulheader">
                    <li>
                        <h3 id="h3header">All Users</h3>
                    </li>
                    <a id="add" href="addUser.php" target="_blank" rel="noopener noreferrer">
                        <li>Add User</li>
                    </a>
                </ul>
            </div>
            <div class="container">
                
    <div class="row" id="cardcontainer">
        <?php

         $db = new db();
        $result = $db->get_data('Users WHERE role = "user"');


        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="card" id="containercard">';
                echo '<img src="' . $row["user_image"] . '" class="card-img-top imgcard" alt="User Image">';
                echo '<div class="card-body" id="containercard-body">';
                echo '<h5 class="card-title container-card-title">' . $row["user_name"] . '</h5>';
                echo '<ul class="list-group" id="containerlist-group">';
                echo '<li class="list-group-item containerlist-group-item">Email: ' . $row["user_email"] . '</li>';
                // echo '<li class="list-group-item containerlist-group-item">Role: ' . $row["role"] . '</li>';
                
                echo '<li class="list-group-item containerlist-group-item"' . ($row["room_number"] ? '' : 'no-room') . '">Room Number: ' . ($row["room_number"] ? $row["room_number"] : 'Not in Room') . '</li>';
                echo '<li class="list-group-item containerlist-group-item"' . ($row["ext_number"] ? '' : 'no-ext') . '">Ext Number: ' . ($row["ext_number"] ? $row["ext_number"] : 'Not have Ext Number') . '</li>'; echo '</ul>';
                
                echo '<div class="btncontainer">';
                echo '<form action="edit_user.php" method="post">';
                echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                echo '<button type="submit" class="btn btn-primary">Edit</button>';
                echo '</form>';
                echo '<form action="delete_user.php" method="post">';
                echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                echo '<button type="submit" class="btn btn-danger">Delete</button>';
                echo '</form>';
                echo '</div>'; // btncontainer
                echo '</div>'; // card-body
                echo '</div>'; // card

            }
        } else {
            echo '<p>No users found.</p>';
        }        
        ?>
    </div> <!-- End of row for user cards -->
</div> <!-- End of container -->

        </div> <!-- End of container for cards -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        <script>
            function scrollFunction() {
      if (
        document.body.scrollTop > 5 ||
        document.documentElement.scrollTop > 5
      ) {
        document.querySelector("nav").classList.add("navbar-scrolled");
      } else {
        document.querySelector("nav").classList.remove("navbar-scrolled");
      }
    }
    window.addEventListener("scroll", scrollFunction);

        </script>
</body>

</html>