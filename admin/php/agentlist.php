<?php

include_once("../../dbconnect.php");
$sqlagents = "SELECT * FROM tbl_agent ORDER BY name ASC";

$results_per_page = 8;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];

    $page_first_result = ($pageno - 1) * $results_per_page;
} else {
    $pageno = 1;
    $page_first_result = ($pageno - 1) * $results_per_page;
}

$stmt = $conn->prepare($sqlagents);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);

$sqlagents = $sqlagents . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlagents);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<title>FROZEN CARTOON PAU</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2019.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2020.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="../../js/script.js"></script>

<style>
    @media screen and (max-width: 600px) {
        .w3-grid-template {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .w3-image {
            width: auto;
            height: auto;
            object-fit: fill;
        }

        body {
            margin: auto;
        }
    }

    /*For ipad/tablet*/
    @media screen and (min-width: 601px) {
        .w3-grid-template {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }

        .w3-image {
            width: auto;
            height: auto;
            object-fit: fill;
        }
    }

    /*For desktop*/
    @media screen and (min-width: 1000px) {
        .w3-grid-template {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        .w3-image {
            width: auto;
            height: auto;
            object-fit: fill;
        }
    }

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
            <h3 class="w3-padding-64"><b>AGENT LIST</b></h3>
        </div>

        <!--Navigation bar-->
        <div class="w3-bar-block">
            <button class="dropdown-btn w3-hover-white">Item<i class="fa fa-caret-down w3-hover-white"></i></button>
            <div class="dropdown-container" onclick="w3_close()">
                <a href="mainpage.php" class="w3-button w3-hover-white">Item List</a><br>
                <a href="newitem.php" class="w3-button w3-hover-white">Add Item</a>
            </div>
            <button class="dropdown-btn w3-hover-white">Agent<i class="fa fa-caret-down w3-hover-white"></i></button>
            <div class="dropdown-container" onclick="w3_close()">
                <a href="agentlist.php" class="w3-button w3-hover-white">Agent List</a><br>
                <a href="newagent.php" class="w3-button w3-hover-white">Add Agent</a>
            </div>
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
            <h1 class="w3-xxlarge w3-2019-creme-de-peche w3-center w3-hover-text-black w3-sofia" style="text-shadow: 1px 1px 0 #444;"><b>Agent List</b></h1>


            <!--Grid Content-->
            <div class="w3-grid-template">
                <?php
                foreach ($rows as $agents) {
                    $name = $agents['name'];
                    $email = $agents['email'];
                    $phone = $agents['phone'];
                    $address = $agents['address'];

                    echo "<div class='w3-center w3-padding'>";
                    echo "<div class='w3-card-4 w3-2020-rose-tan'>";
                    echo "<header class='w3-container w3-padding-16 w3-2020-rose-tan'";
                    echo "<h5><strong>$name</strong></h5>";
                    echo "</header>";
                    echo "<img class='w3-image' src=../../res/users/$phone.jpg" . " onerror=this.onerror=null;this.src='../../res/users/profile.png'" . " style='width:100%;height:250px'>";
                    echo "<div class='w3-container w3-left-align'><hr>";
                    echo "<p><i class='fa fa-phone' style='font-size:16px'></i>&nbsp&nbsp$phone<br>
                        <i class='fa fa-envelope-o' style='font-size:16px'></i>&nbsp&nbsp$email<br>
                        <i class='fa fa-home' style='font-size:16px'></i>&nbsp&nbsp$address</p><hr>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>

            <?php
            $num = 1;
            if ($pageno == 1) {
                $num = 1;
            } else if ($pageno == 2) {
                $num = ($num) + 8;
            } else {
                $num = $pageno * 8 - 7;
            }
            echo "<div class='row-pages w3-padding-32'>";
            echo "<center>";
            for ($page = 1; $page <= $number_of_page; $page++) {
                echo '<a href = "agentlist.php?pageno=' . $page . '" style="text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
            }
            echo " ( " . $pageno . " )";
            echo "</center>";
            echo "</div>";
            ?>

        </div>

        <!--Footer-->
        <footer class="w3-footer w3-container w3-center w3-2019-creme-de-peche">
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