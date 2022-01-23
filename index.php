
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

<div class="topnav">
  <a class="active" href="index.php">Status</a>
  <a href="bepflanzung.php">Bepflanzung</a>
  <a href="handbetrieb.php">Handbetrieb</a>
  <a href="kontakt.php">Kontakt</a>
  <a href="auskunft.php">Auskunft</a>
</div>



<div style="padding-left:16px">
  <h2>Top Navigation Example</h2>

  <div style="min-width:30%; min-height: 100%" id="chart_div"></div>



  <!-- Tabelle -->
  <table>
    <tr><th> Inhaltsüberschrift 1 </th> <th> Inhaltsüberschrift 4 </th></tr>
    <tr><td> Inhalt 2 </td> <td> Inhalt 5 </td></tr>
    <tr><td> Inhalt 3 </td> <td> Inhalt 6 </td></tr>
  </table>


</div>
<script>
  // load current chart package
  google.charts.load("current", {
    packages: ["corechart", "line"]
  });
  // set callback function when api loaded
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    // create data object with default value
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Country');
    data.addColumn('number', 'GDP');
    data.addRows([
      <?php
      //-> Read from Database
      $servername = "192.168.100.49";
      $username = "me";
      $password = "Alzheimer";
      $dbname = "Farmbot";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT value, created_at FROM SensorDat t where sensor='WS_1' ORDER BY created_at asc limit 80"; //Zu früheren Zeiten wollten wir hier mal 288 nehmen.
      $result = $conn->query($sql);

      echo "['Datum', 'Wassersensor'],";

      if ($result->num_rows > 0) {
        // output data of each row
        $datumszahl = $result->num_rows;
        while($row = $result->fetch_assoc()) {
          $datumzeit=$row["created_at"];
          $dt = strtotime($datumzeit);
          echo "[ " . $dt . " ," . $row["value"] . "]";
          if(0 < ($datumszahl) - 1){
            echo ",";
          }
          $datumszahl = $datumszahl -1;
        }
      } else {
        echo "0 results";
      }
      $conn->close();

      ?>
    ] );
    // create options object with titles, colors, etc.
    let options = {

      curveType: 'function',
      hAxis: {
        title: "Zeit"
      },
      vAxis: {
        title: "Wert"
      }
    };
    // draw chart on load
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
    //let chart = new google.visualization.LineChart(
    //  document.getElementById("chart_div")
    //);
    //chart.draw(data, options);
  }
</script>

<script src="js/main.js"></script>

</body>

</html>
