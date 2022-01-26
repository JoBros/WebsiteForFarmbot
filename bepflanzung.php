<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">
  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <meta name="theme-color" content="#fafafa">
  <link href="css/main.css" rel="stylesheet">
  <!-- Text -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
<h1 style="background-color: #333; font-family: Arial, Helvetica, sans-serif; padding: 15px; margin: 0px; color: white">Farmbotsteuerung</h1>
<div class="topnav">
  <a href="index.php">Status</a>
  <a class="active" href="bepflanzung.php">Bepflanzung</a>
  <a href="handbetrieb.php">Handbetrieb</a>
  <a href="kontakt.php">Kontakt</a>
  <a href="auskunft.php">Auskunft</a>
</div>
<table hspace="300" vspace="200" border='1' bordercolordark="#800000" bordercolorlight="#FF0000" bgcolor="white">
<?php
//Connection Data
  $servername = "192.168.100.49";
  $username = "me";
  $password = "Alzheimer";
  $dbname = "Farmbot";
  $tbl_name="PflanzenPos";

  $tbl_width="6";
  $tbl_length="11";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  
?>
</table>
<script src="js/main.js"></script>

</body>

</html>


<?php
/**
 * Created by IntelliJ IDEA.
 * User: Christian
 * Date: 2022/01/23
 * Time: 19:46
 */
