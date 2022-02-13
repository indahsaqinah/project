<?php
include_once("../../dbconnect.php");
session_start();

$useremail = $_SESSION['user_email'];
$user_name = $_SESSION['user_name'];
$user_phone = $_SESSION['user_phone'];

$sqlcart = "SELECT * FROM tbl_cart WHERE user_email = '$useremail'";
$stmt = $conn->prepare($sqlcart);
$stmt->execute();
$number_of_rows = $stmt->rowCount();
if ($number_of_rows > 0) {
    if (isset($_GET['submit'])) {
        if ($_GET['submit'] == "add") {
            $pauid = $_GET['pauid'];
            $qty = $_GET['qty'];
            $cartqty = $qty + 1;
            $updatecart = "UPDATE `tbl_cart` SET `cart_qty`= '$cartqty' WHERE user_email = '$useremail' AND pau_id = '$pauid'";
            $conn->exec($updatecart);
            echo "<script>alert('Cart updated')</script>";
        }
        if ($_POST['submit'] == "remove") {
            $pauid = $_GET['pauid'];
            $qty = $_GET['qty'];
            if ($qty == 1) {
                $updatecart = "DELETE FROM `tbl_cart` WHERE user_email = '$useremail' AND pau_id = '$pauid'";
                $conn->exec($updatecart);
                echo "<script>alert('Pau removed')</script>";
            } else {
                $cartqty = $qty - 1;
                $updatecart = "UPDATE `tbl_cart` SET `cart_qty`= '$cartqty' WHERE user_email = '$useremail' AND pau_id = '$pauid'";
                $conn->exec($updatecart);
                echo "<script>alert('Removed')</script>";
            }
        }
    }
} else {
    echo "<script>alert('No item in your cart')</script>";
    echo "<script> window.location.replace('mainpage.php')</script>";
}

$carttotal = 0;
$stmtqty = $conn->prepare("SELECT * FROM tbl_cart INNER JOIN tbl_pau ON tbl_cart.pau_id = tbl_pau.pau_id WHERE tbl_cart.user_email = '$useremail'");
$stmtqty->execute();
$resultqty = $stmtqty->setFetchMode(PDO::FETCH_ASSOC);
$rowsqty = $stmtqty->fetchAll();
foreach ($rowsqty as $carts) {
    $carttotal = $carts['cart_qty'] + $carttotal;
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<body>

    <!-- Sidebar-->
    <nav class="w3-sidebar w3-2019-creme-de-peche w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close</a>
        <!--Sidebar Title-->
        <div class="w3-container">
            <h3 class="w3-padding-64"><b>MY CART</b></h3>
        </div>

        <!--Navigation bar-->
        <div class="w3-bar-block">
            <a href="mainpage.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a>
            <a href="updateinfo.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Profile</a>
            <a href="mycart.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">My Cart</a>
            <a href="mypayment.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">My Payment</a>
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
            <h1 class="w3-xxlarge w3-2019-creme-de-peche w3-center w3-hover-text-black w3-sofia" style="text-shadow: 1px 1px 0 #444;"><b>My Cart</b></h1>

            <div class="w3-main w3-content w3-padding">
                <div class="w3-container w3-center">
                    <h3>Cart for <?php echo $user_name ?>.</h3>
                </div>
                <hr>
                <div class="w3-grid-template">
                    <?php

                    $total_payable = 0.00;
                    foreach ($rowsqty as $pau) {
                        $pauid = $pau['pau_id'];
                        $pau_name = $pau['pau_name'];
                        $pau_flav = $pau['pau_flav'];
                        $pau_code = $pau['pau_code'];
                        $pau_price = $pau['pau_price'];
                        $pau_qty = $pau['cart_qty'];
                        $pau_total = $pau_qty * $pau_price;
                        $total_payable = $pau_total + $total_payable;
                        echo "<div class='w3-center w3-padding-small w3-quarter' id='paucard_$pauid'><div class = 'w3-card w3-round-large'>
                        <div class='w3-padding-small'><a href='pau_details.php?pauid=$pauid'><img class='w3-container w3-image' 
                        src=../../res/pau/$pau_code.jpg onerror=this.onerror=null;this.src='../../res/imgbroken.png'></a></div>
                        <b>$pau_name</b><br>RM $pau_price/unit<br>
                        <input type='button' class='w3-button w3-red' id='button_id' value='-' onClick='removeCart($pauid,$pau_price);'>
                        <label id='qtyid_$pauid'>$pau_qty</label>
                        <input type='button' class='w3-button w3-green' id='button_id' value='+' onClick='addCart($pauid,$pau_price);'>
                        <br>
                        <b><label id='pauprid_$pauid'> Price: RM $pau_total</label></b><br></div></div>";
                    }
                    ?>
                </div>
                <?php
                echo "<div class='w3-container w3-padding w3-block w3-center'><p><b><label id='totalpaymentid'> Amount need to pay: RM $total_payable</label>
                </b></p><a href='payment.php?email=$useremail&amount=$total_payable' class='w3-button w3-round-large w3-red'> Pay Now </a> </div>";
                ?>

            </div>

            <footer class="w3-container w3-2019-creme-de-peche w3-center">
                <p>Powered by FROZEN CARTOON PAU</p>
            </footer>
        </div>
    </div>

    <script>
        function addCart(pauid, pau_price) {
            jQuery.ajax({
                type: "GET",
                url: "mycartajax.php",
                data: {
                    pauid: pauid,
                    submit: 'add',
                    pauprice: pau_price
                },
                cache: false,
                dataType: "json",
                success: function(response) {
                    var res = JSON.parse(JSON.stringify(response));
                    console.log(res.data.carttotal);
                    if (res.status = "success") {
                        var pauid = res.data.pauid;
                        document.getElementById("carttotalid").innerHTML = "Cart (" + res.data.carttotal + ")";
                        document.getElementById("qtyid_" + pauid).innerHTML = res.data.qty;
                        document.getElementById("pauprid_" + pauid).innerHTML = "Price: RM " + res.data.pauprice;
                        document.getElementById("totalpaymentid").innerHTML = "Total Amount Payable: RM " + res.data.totalpayable;
                    } else {
                        alert("Failed");
                    }
                }
            });
        }

        function removeCart(pauid, pau_price) {
            jQuery.ajax({
                type: "GET",
                url: "mycartajax.php",
                data: {
                    pauid: pauid,
                    submit: 'remove',
                    pauprice: pau_price
                },
                cache: false,
                dataType: "json",
                success: function(response) {
                    var res = JSON.parse(JSON.stringify(response));
                    if (res.status = "success") {
                        console.log(res.data.carttotal);
                        if (res.data.carttotal == null || res.data.carttotal == 0) {
                            alert("Cart empty");
                            window.location.replace("mainpage.php");
                        } else {
                            var pauid = res.data.pauid;
                            var upqty = res.data.qty;
                            document.getElementById("carttotalid").innerHTML = "Cart (" + res.data.carttotal + ")";
                            document.getElementById("qtyid_" + pauid).innerHTML = res.data.qty;
                            document.getElementById("pauprid_" + pauid).innerHTML = "Price: RM " + res.data.pauprice;
                            document.getElementById("totalpaymentid").innerHTML = "Total Amount Payable: RM " + res.data.totalpayable;
                            console.log(res.data.qty);
                            console.log(upqty);
                            if (upqty < 1 || upqty == 0) {
                                var element = document.getElementById("paucard_" + pauid);
                                element.parentNode.removeChild(element);
                            }
                        }

                    } else {
                        alert("Failed");
                    }
                }
            });
        }
    </script>
</body>

</html>
