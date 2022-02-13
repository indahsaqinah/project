<?php
error_reporting(0);
include_once("../../dbconnect.php");
$email = $_GET['email'];
$amount = $_GET['amount'];

$data = array(
    'id' =>  $_GET['billplz']['id'],
    'paid_at' => $_GET['billplz']['paid_at'] ,
    'paid' => $_GET['billplz']['paid'],
    'x_signature' => $_GET['billplz']['x_signature']
);

$paidstatus = $_GET['billplz']['paid'];
if ($paidstatus=="true"){
    $paidstatus = "Success";
}else{
    $paidstatus = "Failed";
}
$receiptid = $_GET['billplz']['id'];
$signing = '';
foreach ($data as $key => $value) {
    $signing.= 'billplz'.$key . $value;
    if ($key === 'paid') {
        break;
    } else {
        $signing .= '|';
    }
}

$signed= hash_hmac('sha256', $signing, 'S-Pp4ytim5_E1jhto_icRj3g');

if ($signed === $data['x_signature']) {
   
    if ($paidstatus == "Success") {
        $sqlinsertpayment = "INSERT INTO `tbl_payment`(`payment_receipt`, `payment_email`, `payment_paid`) VALUES ('$receiptid','$email','$amount')";
        $sqlcart = "SELECT * FROM `tbl_cart` INNER JOIN tbl_pau ON tbl_cart.pau_id = tbl_pau.pau_id WHERE  tbl_cart.user_email = '$email'";
        $stmtcart= $conn->prepare($sqlcart);
        $stmtcart->execute();
        $number_of_rows = $stmtcart->rowCount();
        $rows = $stmtcart->fetchAll();
        if ($number_of_rows > 0)
        {
            foreach ($rows as $carts)
                {
                    $pauid = $carts['pau_id'];
                    $cartqty = (int)$carts['cart_qty'];
                    $pauprice = (double)$carts['pau_price'];
                    $totalprice = $pauprice * $cartqty;
                    $sqlinsertorders = "INSERT INTO `tbl_order`(`order_receiptid`, `order_pauid`, `order_custid`, `order_paid`, `order_qty`, `order_status`) VALUES ('$receiptid','$pauid','$email','$totalprice','$cartqty','$status')";
            
                    //$conn->exec($sqlinsertorders);
                    $stmt = $conn->prepare($sqlinsertorders);
                    $stmt->execute();
                }
        }
        $sqldeletecart = "DELETE FROM `tbl_cart` WHERE user_email = '$email'";
        
        try {
        $conn->exec($sqlinsertpayment);
        $stmt = $conn->prepare($sqldeletecart);
        $stmt->execute();
        date_default_timezone_set("Asia/Kuala_Lumpur");
   
        echo "<center><img src=../../res/logo.png onerror=this.onerror=null;this.src='../images/product/products.png' width='280' height='180'></center>";
         echo '<body><div><h2><center>Receipt</center>
     </h1>
     <table border=1 width=80% align=center>
     <tr><td>Receipt ID</td><td>'.$receiptid.'</td></tr><tr><td>Email </td>
     <td>'.$email. ' </td></tr><td>Amount Paid </td><td>RM '.$amount.'</td></tr>
     <tr><td>Payment Status </td><td>'.$paidstatus.'</td></tr>
     <tr><td>Date </td><td>'.date("d/m/Y").'</td></tr>
     <tr><td>Time </td><td>'.date("h:i a").'</td></tr>
     </table><br>';
     echo "<center><button><a href ='http://cartoonpaufrozen.42web.io/user/php/mypayment.php'>Home</a></button></center>";
            
            } catch (PDOException $e) {
            echo "<script>alert('Failed to pay')</script>";
            echo $e;
           }
    }
    else  
    {
        echo 'Payment Failed!';
    }
}

?>