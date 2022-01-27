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
<h2>Pflanzenpositionen </h2>
<p>In der angezeigten Tabelle sind die vorhandenen Pflanzen und deren Platz auf dem Beet aufgeführt.</p>

<center>
<table width="60%" height="40%">
<?php
//Connection Data
  $servername = "192.168.100.49";
  $username = "me";
  $password = "Alzheimer";
  $dbname = "Farmbot";
  $tbl_name="PflanzenPos";

  $tbl_width=11;
  $tbl_length=6;

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  //Lade Daten
  $sql = "SELECT * FROM PflanzenPos";
  //$sql = "SELECT t.* FROM PflanzenPos t";
      $result = $conn->query($sql);
      //Gebe Daten Tabellarisch aus.
      for($i=0; $i<=$tbl_length; $i++) {
        echo "<tr class='anzeigeStatus2'>";



        for($j=0; $j<=$tbl_width; $j++) {
          if($i==0  && $j == 0){
             echo "<th class='anzeigeStatus2'> Y-\X- Richtung</th>";
          }
          else if($i==0){
             echo "<th class='anzeigeStatus2'>$j</th>";
          }
          else if($j == 0){
             echo "<th class='anzeigeStatus2'>$i</th>";
          } else{
            echo"<td id='$j.$i' class='anzeigeStatus2'> <img src='seamless-dirt-texture.svg' width='50px' height='50px'></td>";
          }
        }
          echo "</tr>";
      }
      if ($result->num_rows > 0) {
        // output data of each row
        echo "<script>";
        while ($row = $result->fetch_assoc()) {
          if( strcmp($row["bez"], "Radieschen") == 0) {
            echo "document.getElementById('" . $row["x"] . "." . $row["y"] . "').innerHTML = '<img src=\"architetto-ravanello.svg\" width=\"50px\" height=\"50px\">';";
          }
        } echo "</script>";
      } else {
        echo "Kein Wert verfügbar";
      }


    $conn->close();
?>
</table>
</center>

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
