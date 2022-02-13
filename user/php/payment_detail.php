<?php
include_once("../../dbconnect.php");
session_start();
$useremail = $_SESSION['user_email'];
$user_name = $_SESSION['user_name'];
$user_phone = $_SESSION['user_phone'];


$receiptid = $_GET['receipt'];
$sqlquery = "SELECT * FROM tbl_order INNER JOIN tbl_pau ON tbl_order.order_pauid = tbl_pau.pau_id WHERE tbl_order.order_receiptid = '$receiptid'";
$stmt = $conn->prepare($sqlquery);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

function subString($str)
{
    if (strlen($str) > 15) {
        return $substr = substr($str, 0, 15) . '...';
    } else {
        return $str;
    }
}

?>


<!DOCTYPE html>
<html>
<title>Payment</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2019.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="../../js/script.js"></script>


<bodY>

    <!-- Sidebar-->
    <nav class="w3-sidebar w3-2019-creme-de-peche w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close</a>
        <!--Sidebar Title-->
        <div class="w3-container">
            <h3 class="w3-padding-64"><b>PAYMENT DETAILS</b></h3>
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
            <h1 class="w3-xxlarge w3-2019-creme-de-peche w3-center w3-hover-text-black w3-sofia" style="text-shadow: 1px 1px 0 #444;"><b>Payment Details</b></h1>

            <div class="w3-grid-template">

                <?php
                $totalpaid = 0.0;
                foreach ($rows as $details) {
                    $pauid = $details['pau_id'];
                    $pau_name = subString($details['pau_name']);
                    $pau_flav = $details['pau_flav'];
                    $order_qty = $details['order_qty'];
                    $order_paid = $details['order_paid'];
                    $order_status = $details['order_status'];
                    $pau_code = $details['pau_code'];
                    $totalpaid = ($order_paid * $order_qty) + $totalpaid;
                    $order_date = date_format(date_create($details['order_date']), 'd/m/y h:i A');
                    echo "<div class='w3-center w3-padding-small'><div class = 'w3-card w3-round-large'>
                    <div class='w3-padding-small'><a href='pau_details.php?pauid=$pauid'><img class='w3-container w3-image' 
                    src=../images/books/$pau_code.jpg onerror=this.onerror=null;this.src='../../res/imgbroken.png'></a></div>
                    <b>$pau_name</b><br>$pau_flav<br>RM $order_paid<br> $order_qty unit<br></div></div>";
                }

                $totalpaid = number_format($totalpaid, 2, '.', '');
                echo "</div><br><hr><div class='w3-container w3-left'><h4>Your Order</h4><p>Order ID: $receiptid<br>Name: $user_name <br>Phone: $user_phone<br>Total Paid: RM $totalpaid<br>Status: $order_status<br>Date Order: $order_date<p></div>";
                ?>
            </div>

            <footer class="w3-container w3-2019-creme-de-peche w3-center">
                <p>Powered by FROZEN CARTOON PAU</p>
            </footer>

        </div>
    </div>


</body>

</html>