<?php

if (isset($_POST["submit"])) {
    include_once("../../dbconnect.php");
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = sha1($_POST["password"]);
    $sqlregister = "INSERT INTO `tbl_user`(`user_name`, `user_email`, `user_phone`, `user_password`) VALUES('$name', '$email', '$phone', '$password')";

    try {
        $conn->exec($sqlregister);
        echo "<script>window.location.replace('login.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Registration failed')</script>";
        echo "<script>window.location.replace('signup.php')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2019.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../../js/script.js"></script>
    <title>Frozen Cartoon Pau - User Registration</title>
</head>

<body>
    <!-- Sidebar-->
    <nav class="w3-sidebar w3-2019-creme-de-peche w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close</a>
        <!--Sidebar Title-->
        <div class="w3-container">
            <h3 class="w3-padding-64"><b>FROZEN CARTOON PAU</b></h3>
        </div>

        <!--Navigation bar-->
        <div class="w3-bar-block">
            <a href="../../index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a>
            <a href="login.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Login</a>
            <a href="signup.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Sign Up</a>
        </div>
    </nav>

    <!-- Top menu on small screens -->
    <header class="w3-container w3-top w3-hide-large w3-2019-creme-de-peche w3-xlarge w3-padding">
        <a href="javascript:void(0)" class="w3-button w3-2019-creme-de-peche w3-margin-right" onclick="w3_open()">☰</a>
        <span>FROZEN CARTOON PAU</span>
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <div class="w3-main w3-2019-sweet-corn" style="margin-left:340px;margin-right:40px">

        <div class="w3-main w3-2019-sweet-corn">

            <div class="w3-header w3-display-container w3-2019-creme-de-peche w3-padding-8 w3-center">
                <img src="../../res/logo.png" alt="Trulli" width="280" height="180" class="responsive">
            </div>

            <div class="w3-container w3-padding-64 form-container">
                <div class="w3-card">
                    <div class="w3-container w3-2019-creme-de-peche w3-center">
                        <h3>Sign Up</h3>
                    </div>

                    <form class="w3-container w3-padding w3-white" name="registerForm" action="signup.php" method="post" enctype="multipart/form-data">
                        <p>
                            <label><b>Name</b></label>
                            <input class="w3-input w3-border w3-round" type="text" placeholder="Enter Name" name="name" id="idname" required>
                        </p>
                        <p>
                            <label><b>Email</b></label>
                            <input class="w3-input w3-border w3-round" type="email" placeholder="Enter Email" name="email" id="idemail" required>
                        </p>
                        <p>
                            <label><b>Password</b></label>
                            <input class="w3-input w3-border w3-border w3-round" placeholder="Enter Password" id="idpass" name="password" type="password" required></input>
                        </p>
                        <p>
                            <label><b>Phone No.</b></label>
                            <input class="w3-input w3-border w3-round" type="phone" placeholder="Enter Phone No" name="phone" id="idphone" required>
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
    </div>

</body>

</html>