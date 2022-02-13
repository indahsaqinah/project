<?php

session_start();

$useremail = $_SESSION['user_email'];
$user_name = $_SESSION['user_name'];
$user_phone = $_SESSION['user_phone'];

// if (isset($_GET['user_email'])) {
//     include_once("../../dbconnect.php");
//     $useremail = $_GET['user_email'];
//     $sqluser = "SELECT * FROM tbl_user WHERE user_email = '$useremail'";
//     $stmt = $conn->query($sqluser);
//     $stmt->execute();
//     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
//     $rows = $stmt->fetchAll();
//     foreach ($rows as $user) {
//         $user_name = $user["user_name"];
//         $user_phone = $user["user_phone"];
//     }
// }

if (isset($_POST["submit"])) {
    include_once("../../dbconnect.php");
    $user_name = $_POST["user_name"];
    $user_phone = $_POST["user_phone"];
    $sqlupdate = "UPDATE `tbl_user` SET user_name = '$user_name', user_phone = '$user_phone' WHERE user_email = '$useremail'";

    $stmt = $conn->query($sqlupdate);
    $stmt->execute();
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
            <h3 class="w3-padding-64"><b>UPDATE PROFILE</b></h3>
        </div>

        <!--Navigation bar-->
        <div class="w3-bar-block">
            <a href="mainpage.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a>
            <a href="updateinfo.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Profile</a>
            <a href="mycart.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">My Cart</a>
            <a href="mypayment.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">My Payment</a>
            <a href="../../main/index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Logout</a>
        </div>
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
            <img src="../../res/logo.png" alt="Trulli" width="420" height="320" class="responsive">
        </div>

        <div class="w3-container w3-padding-64 form-container">
            <div class="w3-card">
                <div class="w3-container w3-2019-creme-de-peche w3-center">
                    <h3><strong>Update User Profile</strong></h3>
                </div>

                <form class="w3-container w3-padding w3-white" name="registerForm" action="updateinfo.php" method="post" enctype="multipart/form-data">
                    <p>
                        <label><b>Name</b></label>
                        <input class="w3-input w3-border w3-round" type="text" placeholder="Enter Name" name="user_name" id="idname" required value="<?php echo $user_name; ?>" required>
                    </p>
                    <p>
                        <label><b>Phone No.</b></label>
                        <input class="w3-input w3-border w3-round" type="phone" placeholder="Enter Phone No" name="user_phone" id="idphone" value="<?php echo $user_phone; ?>" required>
                    </p>

                    <div class="row">
                        <input class="w3-input w3-border w3-block w3-2019-creme-de-peche w3-round" type="submit" name="submit" value="Update">
                    </div>
                </form>
            </div>
        </div>

        <footer class="w3-container w3-2019-creme-de-peche w3-center">
            <p>Powered by FROZEN CARTOON PAU</p>
        </footer>
    </div>
</body>

</html>
