<?php
session_start();

if (isset($_POST["submit"])) {
    include_once("../dbconnect.php");
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $sqlregister = "INSERT INTO `tbl_agent`(`name`, `email`, `phone`, `address`) VALUES('$name', '$email', '$phone', '$address')";

    try {
        $conn->exec($sqlregister);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            uploadImage($phone);
        }
        echo "<script>window.location.replace('registersuccessful.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Registration failed')</script>";
        echo "<script>window.location.replace('newagent.php')</script>";
    }
}

function uploadImage($id)
{
    $target_dir = "../res/users/";
    $target_file = $target_dir . $id . ".jpg";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

?>

<!DOCTYPE html>
<html lang="en">
<title>FROZEN CARTOON PAU</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2019.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="../js/script.js"></script>

<style>
    /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
    .dropdown-container {
        display: none;
        padding-left: 16px;
    }

    /* Optional: Style the caret down icon */
    .fa-caret-down {
        float: right;
        padding-right: 150px;
    }

    .dropdown-btn {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        display: block;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        outline: none;
    }
</style>

<body>

    <!-- Sidebar-->
    <nav class="w3-sidebar w3-2019-creme-de-peche w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close</a>
        <!--Sidebar Title-->
        <div class="w3-container">
            <h3 class="w3-padding-64"><b>MAIN PAGE</b></h3>
        </div>

        <!--Navigation bar-->
        <div class="w3-bar-block">
            <a href="../index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a>
    </nav>

    <!-- Top menu on small screens -->
    <header class="w3-container w3-top w3-hide-large w3-2019-creme-de-peche w3-xlarge w3-padding">
        <a href="javascript:void(0)" class="w3-button w3-2019-creme-de-peche w3-margin-right" onclick="w3_open()">☰</a>
        <span>FROZEN CARTOON PAU</span>
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main w3-2019-sweet-corn" style="margin-left:340px;margin-right:40px">

        <!-- Header -->
        <div class="w3-container w3-center" style="margin-top:45px" id="showcase">
            <img src="../res/logo.png" alt="Trulli" width="420" height="320" class="responsive">
        </div>

        <div class="w3-container w3-padding-64 form-container">
            <div class="w3-card">
                <div class="w3-container w3-2019-creme-de-peche w3-center">
                    <h3>New Agent Registration</h3>
                </div>

                <form class="w3-container w3-padding w3-white" name="registerForm" action="newagent.php" method="post" enctype="multipart/form-data">
                    <p>
                    <div class="w3-container w3-border w3-center w3-padding">
                        <img class="w3-image w3-round" src="../res/users/profile.png" style="width:100%; max-width:200px"><br>
                        <input class="w3-margin" type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
                    </div>
                    </p>
                    <p>
                        <label><b>Name</b></label>
                        <input class="w3-input w3-border w3-round" type="text" placeholder="Enter Name" name="name" id="idname" required>
                    </p>
                    <p>
                        <label><b>Email</b></label>
                        <input class="w3-input w3-border w3-round" type="email" placeholder="Enter Email" name="email" id="idemail" required>
                    </p>
                    <p>
                        <label><b>Phone No.</b></label>
                        <input class="w3-input w3-border w3-round" type="phone" placeholder="Enter Phone No" name="phone" id="idphone" required>
                    </p>
                    <p>
                        <label><b>Address</b></label>
                        <textarea class="w3-input w3-border w3-border w3-round" placeholder="Enter Adress" id="idaddress" name="address" required></textarea>
                    </p>

                    <div class="row">
                        <input class="w3-input w3-border w3-block w3-2019-creme-de-peche w3-round" type="submit" name="submit" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="w3-container w3-2019-creme-de-peche w3-center">
        <p>Powered by FROZEN CARTOON PAU</p>
    </footer>

    <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>

</body>

</html>