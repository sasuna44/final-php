<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <style>
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

        body {
            background-color: #111;
            font-family: "Signika Negative", sans-serif, Arial;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            color: white;
        }

        #smooth-wrapper {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #smooth-content {
            position: relative;
            overflow: visible;
            width: 100%;
            
            background-image:
                linear-gradient(rgba(255, 255, 255, .07) 2px, transparent 2px),
                linear-gradient(90deg, rgba(255, 255, 255, .07) 2px, transparent 2px),
                linear-gradient(rgba(255, 255, 255, .06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, .06) 1px, transparent 1px);
            background-size: 100px 100px, 100px 100px, 20px 20px, 20px 20px;
            background-position: -2px -2px, -2px -2px, -1px -1px, -1px -1px;
        }

        .navbar {
            background-color: transparent !important;
            
            transition: background-color 0.3s ease;
        }

        .navbar-scrolled {
            background-color: #6fb936 !important;
            
        }

        .checks {
            position: absolute;
            margin-top: 100px;
            width: 100%;
        }

        .checks h1 {
            font-size: 70px;
            cursor: pointer;
        }

        .navbar-dark .navbar-brand {
            color: #ffffff;
            /* Text color for navbar brand */
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #ffffff;
            /* Text color for navbar links */
        }

        form {
    max-width: 400px; 
    margin: auto;
    padding: 20px;

    border-radius: 10px;
}


        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        form input {
    background-color: transparent;
    width: 50%; 
    padding: 10px;
    border: 2px solid #ccc;
    border-radius: 5px;
    color: white;
}

        input[type="date"] {
            padding-top: 25px;
            padding-bottom: 25px;
        }

        input[type="date"]::placeholder {
            color: white;
        }

        input[type="date"]:focus {
            background-color: transparent;
            border: 2px solid #4e9815;
            outline: none;
        }

        .form-control:focus {
            outline: none;
        }

        button.btn {
            width: 25%;
            padding: 10px;
            border-radius: 5px;
            background-color: #6fb936;
            border: none;
            color: white;
        }

        button.btn:hover {
            background-color: #4e9815;
            color: white;
        }

        button.btn:active {
            background-color: #4e9815;
            outline: none;
            border-color: #ced4da;
        }


        .error {
            border: 2px solid red !important;
        }

        .error-message {
            color: red;
            display: none;
        }
    </style>
</head>

<body>
<?php

$errors=[];
if(isset($_GET['errors'])){
    $errors=json_decode($_GET['errors'],true);

}


?>
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
                                <a class="nav-link" href="allProducts.php">Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="allUsers.php">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Manual Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Checks</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container py-5">
    <form action="add.php" method="POST" enctype="multipart/form-data" id="registrationForm" class="py-5">
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Name</label>
            <input type="text" class="form-control" name="user_name" id="exampleInputName" aria-describedby="nameHelp">
            <small class="error-message">Invalid name (at least 8 characters)</small>
            <?php
            if (isset($errors['user_name'])) {
                echo $errors['user_name'];
            }
            ?>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" name="user_email" id="exampleInputEmail" aria-describedby="emailHelp">
            <small class="error-message">Invalid email address</small>
            <?php
            if (isset($errors['user_email'])) {
                echo $errors['user_email'];
            }
            ?>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword" class="form-label">Password</label>
            <input type="password" class="form-control" name="user_password" id="exampleInputPassword">
            <small class="error-message">Invalid password (at least 8 characters)</small>
            <?php
            if (isset($errors['user_password'])) {
                echo $errors['user_password'];
            }
            ?>
        </div>

        <div class="mb-3">
            <label for="exampleInputConfirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" id="exampleInputConfirmPassword">
            <small class="error-message">Passwords do not match</small>
        </div>

        <div class="mb-3">
            <label for="exampleInputRoomNo" class="form-label">Room Number</label>
            <input type="text" class="form-control" name="room_number" id="exampleInputRoomNo">
            <small class="error-message">Invalid room number (at least 3 characters)</small>
            <?php
            if (isset($errors['room_number'])) {
                echo $errors['room_number'];
            }
            ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputextnumber" class="form-label">Extension Number</label>
            <input type="text" class="form-control" name="ext_number" id="exampleInputextnumber">
            <small class="error-message">Invalid extension number (at least 3 characters)</small>
            <?php
            if (isset($errors['ext_number'])) {
                echo $errors['ext_number'];
            }
            ?>
        </div>

        <div class="mb-3">
    <label for="exampleInputProfilePicture" class="form-label">Upload Profile Picture</label>
    <input type="file" class="form-control" name="user_image" id="exampleInputProfilePicture">
    <small class="error-message">Please select an image.</small>
</div>

        <button type="submit" class="btn btn-primary">Save</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.getElementById("registrationForm").addEventListener("submit", function (event) {
        // event.preventDefault(); // Commented out to allow normal form submission
        validateRegistrationForm();
    });

    document.getElementById("registrationForm").addEventListener("reset", function (event) {
        clearFormFields();
    });

    function validateRegistrationForm() {
        var nameInput = document.getElementById("exampleInputName");
        var emailInput = document.getElementById("exampleInputEmail");
        var passwordInput = document.getElementById("exampleInputPassword");
        var confirmPasswordInput = document.getElementById("exampleInputConfirmPassword");
        var roomNoInput = document.getElementById("exampleInputRoomNo");
        var extNumberInput = document.getElementById("exampleInputextnumber");
        var imageInput = document.getElementById("exampleInputProfilePicture");

        var name = nameInput.value;
        var email = emailInput.value;
        var password = passwordInput.value;
        var confirmPassword = confirmPasswordInput.value;
        var roomNo = roomNoInput.value;
        var extNumber = extNumberInput.value;
        var image = imageInput.value;

        var nameValid = validateName(name);
        var emailValid = validateEmail(email);
        var passwordValid = validatePassword(password);
        var confirmPasswordValid = validateConfirmPassword(password, confirmPassword);
        var roomNoValid = validateRoomNumber(roomNo);
        var extNumberValid = validateExtNumber(extNumber);
        var imageValid = validateImage(image);

        if (nameValid && emailValid && passwordValid && confirmPasswordValid && roomNoValid && extNumberValid) {
        } else {
            event.preventDefault();
        }
    }

    function validateName(name) {
        var nameRegex = /^[a-zA-Z][a-zA-Z]*$/;
        var nameError = document.querySelector("#exampleInputName + .error-message");

        if (nameRegex.test(name)) {
            nameError.style.display = "none";
            return true;
        } else {
            nameError.style.display = "block";
            return false;
        }
    }

    function validateEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var emailError = document.querySelector("#exampleInputEmail + .error-message");

        if (emailRegex.test(email)) {
            emailError.style.display = "none";
            return true;
        } else {
            emailError.style.display = "block";
            return false;
        }
    }

    function validatePassword(password) {
        var passwordRegex = /^.{8,}$/;
        var passwordError = document.querySelector("#exampleInputPassword + .error-message");

        if (passwordRegex.test(password)) {
            passwordError.style.display = "none";
            return true;
        } else {
            passwordError.style.display = "block";
            return false;
        }
    }

    function validateConfirmPassword(password, confirmPassword) {
        var confirmPasswordError = document.querySelector("#exampleInputConfirmPassword + .error-message");

        if (password === confirmPassword) {
            confirmPasswordError.style.display = "none";
            return true;
        } else {
            confirmPasswordError.style.display = "block";
            return false;
        }
    }
    function validateRoomNumber(roomNo) {
    var roomNoRegex = /^\d{1,3}$/;  
    var roomNoError = document.querySelector("#exampleInputRoomNo + .error-message");

    if (roomNoRegex.test(roomNo)) {
        roomNoError.style.display = "none";
        return true;
    } else {
        roomNoError.style.display = "block";
        return false;
    }
}

function validateExtNumber(extNumber) {
    var extNumberRegex = /^\d{1,3}$/;  
    var extNumberError = document.querySelector("#exampleInputextnumber + .error-message");

    if (extNumberRegex.test(extNumber)) {
        extNumberError.style.display = "none";
        return true;
    } else {
        extNumberError.style.display = "block";
        return false;
    }
}


    function validateImage(image) {
        var imageInput = document.getElementById("exampleInputProfilePicture");
        var imageError = document.querySelector("#exampleInputProfilePicture + .error-message");

        if (imageInput.files.length > 0) {
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            var fileSizeLimit = 5 * 1024 * 1024; // 5MB

            var file = imageInput.files[0];
            var fileName = file.name;
            var fileSize = file.size;

            if (!allowedExtensions.exec(fileName)) {
                imageError.style.display = "block";
                imageError.textContent = "Invalid file type. Allowed file types are .jpg, .jpeg, .png, and .gif.";
                returnfalse;
            } else if (fileSize > fileSizeLimit) {
                imageError.style.display = "block";
                imageError.textContent = "File size exceeds the limit of 5MB.";
                return false;
            } else {
                imageError.style.display = "none";
                return true;
            }
        } else {
            imageError.style.display = "block";
            imageError.textContent = "Please select an image.";
            return false;
        }
    }

    function clearFormFields() {
        var nameInput = document.getElementById("exampleInputName");
        var emailInput = document.getElementById("exampleInputEmail");
        var passwordInput = document.getElementById("exampleInputPassword");
        var confirmPasswordInput = document.getElementById("exampleInputConfirmPassword");
        var roomNoInput = document.getElementById("exampleInputRoomNo");
        var extNumberInput = document.getElementById("exampleInputextnumber");
        var imageInput = document.getElementById("exampleInputProfilePicture");

        nameInput.value = "";
        emailInput.value = "";
        passwordInput.value = "";
        confirmPasswordInput.value = "";
        roomNoInput.value = "";
        extNumberInput.value = "";
        imageInput.value = "";

        var errorMessages = document.querySelectorAll(".error-message");
        errorMessages.forEach(function (errorMessage) {
            errorMessage.style.display = "none";
        });
    }
</script>
   
</body>

</html> 
