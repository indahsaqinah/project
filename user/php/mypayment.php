<?php
include_once("../../dbconnect.php");
session_start();

$useremail = $_SESSION['user_email'];
$user_name = $_SESSION['user_name'];
$user_phone = $_SESSION['user_phone'];

$sqlpayment = "SELECT * FROM tbl_payment WHERE payment_email = '$useremail' ORDER BY payment_date DESC";
$stmt = $conn->prepare($sqlpayment);
$stmt->execute();
$number_of_rows = $stmt->rowCount();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();


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


<body onload="loadCookies()">

    <!-- Sidebar-->
    <nav class="w3-sidebar w3-2019-creme-de-peche w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close</a>
        <!--Sidebar Title-->
        <div class="w3-container">
            <h3 class="w3-padding-64"><b>PAYMENT</b></h3>
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
            <h1 class="w3-xxlarge w3-2019-creme-de-peche w3-center w3-hover-text-black w3-sofia" style="text-shadow: 1px 1px 0 #444;"><b>Payment</b></h1>

            <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
                <div class="w3-grid-template">
                    <?php
                    $totalpaid = 0.0;
                    $count = 0;
                    foreach ($rows as $payments) {
                        $paymentid = $payments['payment_id'];
                        $paymentreceipt = $payments['payment_receipt'];
                        $paymentpaid = number_format($payments['payment_paid'], 2, '.', '');
                        $totalpaid = $paymentpaid + $totalpaid;
                        $count++;
                        $paymentdate = date_format(date_create($payments['payment_date']), "d/m/Y h:i A");
                        
                        echo "<div class='w3-left w3-padding-small'><div class = 'w3-card w3-round-large w3-padding'>
                        <div class='w3-container w3-center w3-padding-small'><b>Receipt ID: $paymentreceipt</b></div><br>
                        Book ordered: $count<br>Paid: RM $paymentpaid<br>Date: $paymentdate<br>
                        <div class='w3-button w3-blue w3-round w3-block'><a style='text-decoration: none;' href='payment_details.php?receipt=$paymentreceipt'>Details</a></div>
                        </div></div>";
                    }
                    $totalpaid = number_format($totalpaid, 2, '.', '');
                    $totalpaid = number_format($totalpaid, 2, '.', '');
                    echo "</div><br><hr><div class='w3-container w3-left'><h4>Your Orders</h4><p>Name: $user_name <br>Phone: $user_phone<br>Total Paid: RM $totalpaid<p></div>";
                    ?>
                </div>
            </div>

            <footer class="w3-container w3-2019-creme-de-peche w3-center">
                <p>Powered by FROZEN CARTOON PAU</p>
            </footer>

            <div id="id01" class="w3-modal">
                <div class="w3-modal-content" style="width:50%">
                    <header class="w3-container w3-blue">
                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                        <h4>Email to reset password</h4>
                    </header>
                    <div class="w3-container w3-padding">
                        <form action="login.php" method="post">
                            <label><b>Email</b></label>
                            <input class="w3-input w3-border w3-round" name="email" type="email" id="idemail" required>
                            <p>
                                <button class="w3-btn w3-round w3-blue" name="reset">Submit</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
