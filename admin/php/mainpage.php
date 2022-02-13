<?php
session_start();

include_once("../../dbconnect.php");
$sqlpau = "SELECT * FROM tbl_pau ORDER BY pau_name ASC";

$results_per_page = 6;
if (isset($_GET['pageno'])) {
  $pageno = (int)$_GET['pageno'];

  $page_first_result = ($pageno - 1) * $results_per_page;
} else {
  $pageno = 1;
  $page_first_result = ($pageno - 1) * $results_per_page;
}

$stmt = $conn->prepare($sqlpau);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);

$sqlpau = $sqlpau . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlpau);
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="../../js/script.js"></script>

<style>
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
</style>

<body>

  <!-- Sidebar-->
  <nav class="w3-sidebar w3-2019-creme-de-peche w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close</a>
    <!--Sidebar Title-->
    <div class="w3-container">
      <h3 class="w3-padding-64"><b>MAIN PAGE</b></h3>
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
      <h1 class="w3-xxlarge w3-2019-creme-de-peche w3-center w3-hover-text-black w3-sofia" style="text-shadow: 1px 1px 0 #444;"><b>Menu</b></h1>

      <div class="w3-grid-template">
        <?php
        foreach ($rows as $pau) {
          $pauid = $pau['pau_id'];
          $pau_name = ($pau['pau_name']);
          $pau_flav = $pau['pau_flav'];
          $pau_code = $pau['pau_code'];
          $pau_price = $pau['pau_price'];

          echo "<div class='w3-center w3-padding-small w3-third'><div class = 'w3-card w3-round-large'>
                    <div class='w3-padding-small'><a href='pau_details.php?pauid=$pauid'><img class='w3-container w3-image' 
                    src=../../res/pau/$pau_code.jpg onerror=this.onerror=null;this.src='../../res/imgbroken.png'></a></div>
                    <b>$pau_name</b><br>$pau_flav<br>RM $pau_price<br>
                    </div></div>";
        }
        ?>
      </div>

      <?php
      $num = 1;
      if ($pageno == 1) {
        $num = 1;
      } else if ($pageno == 2) {
        $num = ($num) + $results_per_page;
      } else {
        $num = $pageno * $results_per_page - 5;
      }
      echo "<div class='w3-container w3-row'>";
      echo "<center>";
      for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "mainpage.php?pageno=' . $page . '" style=
        "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
      }
      echo " ( " . $pageno . " )";
      echo "</center>";
      echo "</div>";
      ?>

      <footer class="w3-container w3-2019-creme-de-peche w3-center">
        <p>Powered by FROZEN CARTOON PAU</p>
      </footer>
    </div>
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