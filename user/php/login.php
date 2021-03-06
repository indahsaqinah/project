<?php
include '../../dbconnect.php';

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $pass = sha1($_POST["password"]);
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE user_email = '$email' AND user_password = '$pass'");
    $stmt->execute();
    $number_of_rows = $stmt->rowCount();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();
    if ($number_of_rows  > 0) {
        foreach ($rows as $user) {
            $user_name = $user['user_name'];
            $user_phone = $user['user_phone'];
        }
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["user_email"] = $email;
        $_SESSION["user_name"] = $user_name;
        $_SESSION["user_phone"] = $user_phone;
        echo "<script>alert('Login Success');</script>";
        echo "<script> window.location.replace('mainpage.php')</script>";
    } else {
        echo "<script>alert('Login Failed');</script>";
        echo "<script> window.location.replace('login.php')</script>";
    }
}

?>

<DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2019.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="../../js/script.js"></script>
        <title>Frozen Cartoon Pau - Login</title>
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
            <a href="javascript:void(0)" class="w3-button w3-2019-creme-de-peche w3-margin-right" onclick="w3_open()">???</a>
            <span>FROZEN CARTOON PAU</span>
        </header>

        <!-- Overlay effect when opening sidebar on small screens -->
        <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

        <div class="w3-main w3-2019-sweet-corn" style="margin-left:340px;margin-right:40px">

            <div class="w3-header w3-display-container w3-2019-creme-de-peche w3-padding-8 w3-center">
                <img src="../../res/logo.png" alt="Trulli" width="280" height="180" class="responsive">
            </div>

            <div class="w3-container w3-padding-64 form-container">
                <div class="w3-card-4 w3-round">
                    <div class="w3-container w3-2019-creme-de-peche">
                        <h2 class="w3-center"><strong>User Login</strong></h2>
                    </div>

                    <form name="loginForm" id="loginForm" class="w3-container w3-white" action="login.php" method="post">
                        <p>
                            <label class="w3-text-black"><b>Email</b></label>
                            <input class="w3-input w3-border w3-round" name="email" type="email" id="idemail" required>
                        </p>
                        <p>
                            <label class="w3-text-black"><b>Password</b></label>
                            <input class="w3-input w3-border w3-round" name="password" type="password" id="idpass" required>
                        </p>
                        <p>
                            <input class="w3-check" type="checkbox" id="idremember" name="remember" onclick="rememberMe()">
                            <label>Remember Me</label>
                        </p>
                        <p>
                            <button class="w3-btn w3-round w3-2019-creme-de-peche w3-block" name="submit">Login</button>
                        </p>
                    </form>
                </div>
            </div>


            <footer class="w3-container w3-2019-creme-de-peche w3-center">
                <p>Powered by FROZEN CARTOON PAU</p>
            </footer>
        </div>

    </body>

    </html>