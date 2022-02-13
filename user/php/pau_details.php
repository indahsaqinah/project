<?php


include_once("../../dbconnect.php");
session_start();

$useremail = $_SESSION['user_email'];
$user_name = $_SESSION['user_name'];
$user_phone = $_SESSION['user_phone'];

$pauid = $_GET['pauid'];
$sqlquery = "SELECT * FROM tbl_pau WHERE pau_id = $pauid";
$stmt = $conn->prepare($sqlquery);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

$carttotal = 0;


if (isset($_POST['submit'])) {

    include_once("../../dbconnect.php");
    if ($_POST['submit'] == "cart") {
        $pauid = $_POST['pauid'];
        $cartqty = $_POST['quantity'];
        $stmt = $conn->prepare("SELECT * FROM tbl_cart WHERE user_email = '$useremail' AND pau_id = '$pauid'");
        $stmt->execute();
        $number_of_rows = $stmt->rowCount();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();
        if ($number_of_rows > 0) {
            foreach ($rows as $carts) {
                $pauqty = $carts['cart_qty'];
            }
            $cartqty = $cartqty + $_POST['quantity'];
            $updatecart = "UPDATE `tbl_cart` SET `cart_qty`= '$cartqty' WHERE user_email = '$useremail' AND pau_id = '$pauid'";
            $conn->exec($updatecart);
            echo "<script>alert('Cart updated')</script>";
            echo "<script> window.location.replace('mainpage.php')</script>";
        } else {
            $addcart = "INSERT INTO `tbl_cart`(`user_email`, `pau_id`, `cart_qty`) VALUES ('$useremail','$pauid','$cartqty')";
            try {
                $conn->exec($addcart);
                echo "<script>alert('Success')</script>";
                echo "<script> window.location.replace('mainpage.php')</script>";
            } catch (PDOException $e) {
                echo "<script>alert('Failed')</script>";
            }
        }
    }
} 

$stmtqty = $conn->prepare("SELECT * FROM tbl_cart WHERE user_email = '$useremail'");
$stmtqty->execute();
$resultqty = $stmtqty->setFetchMode(PDO::FETCH_ASSOC);
$rowsqty = $stmtqty->fetchAll();
foreach ($rowsqty as $carts) {
    $carttotal = $carts['cart_qty'] + $carttotal;
}
?>


<!DOCTYPE html>
<html>
<title>Order Details</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2019.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="../../js/script.js"></script>


<body>

    <!-- Sidebar-->
    <nav class="w3-sidebar w3-2019-creme-de-peche w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close</a>
        <!--Sidebar Title-->
        <div class="w3-container">
            <h3 class="w3-padding-64"><b>ORDER DETAILS</b></h3>
        </div>

        <!--Navigation bar-->
        <div class="w3-bar-block">
            <a href="mainpage.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a>
            <a href="updateinfo.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Profile</a>
            <a href="mycart.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">My Cart</a>
            <a href="../../index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Logout</a>
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
    <div class="w3-main w3-2019-sweet-corn w3-center" style="margin-left:340px;margin-right:40px">

        <!-- Header -->
        <div class="w3-container w3-center" style="margin-top:45px" id="showcase">
            <img src="../../res/logo.png" alt="Trulli" width="420" height="320" class="responsive">
        </div>

        <div class="w3-row-padding w3-padding-16 w3-center">
            <h1 class="w3-xxlarge w3-2019-creme-de-peche w3-center w3-hover-text-black w3-sofia" style="text-shadow: 1px 1px 0 #444;"><b>Order Details</b></h1>

            <div class="w3-row w3-card">
                <div class="w3-center">
                    <img class="w3-image w3-margin w3-center w3-round-xxlarge" style="height:100%;width:100%;max-width:220px;max-height:250px" src="../../res/pau/<?php
                                                                                                                                                                    foreach ($rows as $pau) {
                                                                                                                                                                        $pau_code = $pau['pau_code'];

                                                                                                                                                                        echo "$pau_code";
                                                                                                                                                                    } ?>.jpg">
                </div>
                <div class="w3-container">
                    <?php

                    $cart = "cart";
                    foreach ($rows as $pau) {
                        $pau_id = $pau['pau_id'];
                        $pau_name = $pau['pau_name'];
                        $pau_flav = $pau['pau_flav'];
                        $pau_price = $pau['pau_price'];
                    }

                    echo "<h3 class='w3-center'><b>$pau_name</h3></b>
                    <p style='font-size:130%;'>Flavour<br><strong>  $pau_flav</strong><br><p>
                    <p style='font-size:160%;'>RM $pau_price</p>
                    <label for='quantity'>Quantity:</label>
                    <form method='post' action='pau_details.php?pauid=$pauid&submit=$cart' name='form'>
                        <input type='hidden' name='pauid' value='$pauid'>
                        <input type='number'class='w3-round-large w3-border-bottom w3-border-red' id='quantity' name='quantity' min='1'>
                        <p>
                            <button class='w3-btn w3-red w3-round-large' name='submit' value='cart'>Add to Cart</button>
                        <p>
                    </form>
                    <br>";
                    ?>
                </div>
            </div>
        </div>

        <footer class="w3-container w3-2019-creme-de-peche w3-center">
            <p>Powered by FROZEN CARTOON PAU</p>
        </footer>

    </div>
</body>

</html>