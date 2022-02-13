<?php
include_once("../../dbconnect.php");
session_start();

if (isset($_SESSION['sessionid'])) {
    $useremail = $_SESSION['user_email'];
}else{
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    return;
}

if (isset($_GET['submit'])) {
    $pauid = $_GET['pauid'];
    $pauprice = $_GET['pauprice'];
    $sqlqty = "SELECT * FROM tbl_cart WHERE user_email = '$useremail' AND pau_id = '$pauid'";
    $stmtsqlqty = $conn->prepare($sqlqty);
    $stmtsqlqty->execute();
    $resultsqlqty = $stmtsqlqty->setFetchMode(PDO::FETCH_ASSOC);
    $rowsqlqty = $stmtsqlqty->fetchAll();
    $paucurqty = 0;
    foreach ($rowsqlqty as $pau) {
        $paucurqty = $pau['cart_qty'] + $paucurqty;
    }
    if ($_GET['submit'] == "add"){
        $cartqty = $paucurqty + 1 ;
        $updatecart = "UPDATE `tbl_cart` SET cart_qty= '$cartqty' WHERE user_email = '$useremail' AND pau_id = '$pauid'";
        $conn->exec($updatecart);
    }
    if ($_GET['submit'] == "remove"){
        if ($paucurqty == 1){
            $updatecart = "DELETE FROM `tbl_cart` WHERE user_email = '$useremail' AND pau_id = '$pauid'";
            $conn->exec($updatecart);
        }else{
            $cartqty = $paucurqty - 1 ;
            $updatecart = "UPDATE `tbl_cart` SET cart_qty = '$cartqty' WHERE user_email = '$useremail' AND pau_id = '$pauid'";
            $conn->exec($updatecart);    
        }
    }
}


$stmtqty = $conn->prepare("SELECT * FROM tbl_cart INNER JOIN tbl_pau ON tbl_cart.pau_id = tbl_pau.pau_id WHERE tbl_cart.user_email = '$useremail'");
$stmtqty->execute();
$rowsqty = $stmtqty->fetchAll();
$totalpayable = 0;
foreach ($rowsqty as $carts) {
   $carttotal = $carts['cart_qty'];
   $paupr = $carts['pau_price'] * $carts['cart_qty'];
   $totalpayable = $totalpayable + $paupr;
}

$mycart = array();
$mycart['carttotal'] =$carttotal;
$mycart['pauid'] =$pauid;
$mycart['qty'] =$cartqty;
$mycart['pauprice'] = bcdiv($cartqty * $pauprice,1,2);
$mycart['totalpayable'] = bcdiv($totalpayable,1,2);


$response = array('status' => 'success', 'data' => $mycart);
sendJsonResponse($response);


function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>