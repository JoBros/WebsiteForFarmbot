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

<center>
Positionstabelle:

<table hspace="300" vspace="200" border='1' bordercolordark="#800000" bordercolorlight="#FF0000" bgcolor="grey">
<?php
//Connection Data
$host="192.168.100.49";
$username="me";
$password="Alzheimer";
$db_name="Farmbot";
$tbl_name="PflanzenPos";

$tbl_width="6";
$tbl_length="11";
$connection=mysqli_connect("$host","$username","$password","$db_name");
if (mysqli_connect_errno())
{
    echo "The application has failed to connect to the mysql database server: " .mysqli_connect_error();
}

$sql = "SELECT t.* FROM History t ORDER BY timest DESC";
    $result = $conn->query($sql);
    echo "<tr class='anzeigeStatus'><th class='anzeigeStatus'>X</th><th class='anzeigeStatus'>Y</th><th class='anzeigeStatus'>Doing</th><th class='anzeigeStatus'>Datum</th></tr>";

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "<tr class='anzeigeStatus'><td class='anzeigeStatus'>" . $row["x"] . "</td><td class='anzeigeStatus'>". $row["y"] . "</td><td class='anzeigeStatus'>" . $row["doing"] ."</td><td class='anzeigeStatus'>" . $row["timest"] . "</td></tr>";
      }
    } else {
      echo "Kein Wert verfügbar";
    }

for($i=1; $i<=$tbl_length; $i++)
{
    echo "<tr>";
    for($j=1; $j<=$tbl_width; $j++)
    {
      echo"<td> Inhalt $i $j</td>";
    }
    echo "</tr>";
}
mysqli_close($connection);
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
