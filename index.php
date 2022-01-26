
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
  <a class="active" href="index.php">Status</a>
  <a href="bepflanzung.php">Bepflanzung</a>
  <a href="handbetrieb.php">Handbetrieb</a>
  <a href="kontakt.php">Kontakt</a>
  <a href="auskunft.php">Auskunft</a>
</div>



<div style="padding-left:16px">
  <p>Hier wird der aktuelle Sensorenwerte und die letzten Fahrbewegungen des Farmbots angezeigt. Das Fenster dient zur Anzeige für den Gärtner um Trends und aktuelle Bedürfnisse zu erkennen. </p>
  <h2>Wassersensorik </h2>

  <div style="min-width:30%; min-height: 30%" id="chart_div"></div>

  <p>Der aktuelle Bodenwasserwert liegt bei <Label id="bwW"></Label></p>

  <h2>Temperatursensorik</h2>

  <div style="min-width:30%; min-height: 30%" id="chart_div1"></div>

  <h2>Welche arbeiten wurden in der letzten Zeit gemacht?</h2>

  <div style="min-width:30%; min-height: 30%" id="chart_div2"></div>

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
    let data = google.visualization.arrayToDataTable([
      //    ["Datenreihe1" , "Feuchtigkeit [in %]?"],
      //      [1,0],
      //      [4,2],
      //      [2,1],
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

      $sql = "SELECT value, created_at FROM SensorDat t where sensor='WS_1' ORDER BY created_at desc limit 120";
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
        textPosition: 'none',
        title: "Zeit"
      },
      vAxis: {
        title: "Wert",
        minValue: 0
      }
    };
    // draw chart on load
    let chart = new google.visualization.LineChart(
      document.getElementById("chart_div")
    );
    chart.draw(data, options);

    data = google.visualization.arrayToDataTable([
      //    ["Datenreihe1" , "Feuchtigkeit [in %]?"],
      //      [1,0],
      //      [4,2],
      //      [2,1],
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

      $sql = "SELECT value, created_at FROM SensorDat t where sensor='TP_1' ORDER BY created_at desc limit 288";
      $result = $conn->query($sql);

      echo "['Datum', 'Temperatursensor'],";

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
    // draw chart on load
    chart = new google.visualization.LineChart(
      document.getElementById("chart_div1")
    );
    chart.draw(data, options);

    data = google.visualization.arrayToDataTable([
      //    ["Datenreihe1" , "Feuchtigkeit [in %]?"],
      //      [1,0],
      //      [4,2],
      //      [2,1],
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

      $sql = "SELECT value, created_at FROM SensorDat t where sensor='LF_1' ORDER BY created_at desc limit 288";
      $result = $conn->query($sql);

      echo "['Datum', 'Luftfeuchtesensor'],";

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


    // draw chart on load
    chart = new google.visualization.LineChart(
      document.getElementById("chart_div2")
    );
    chart.draw(data, options);

  }
  <?php
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

  $sql = "SELECT value FROM SensorDat t where sensor='WS_1' ORDER BY created_at desc limit 1";
  $result = $conn->query($sql);


  if ($result->num_rows > 0) {
    // output data of each row
    $datumszahl = $result->num_rows;
    while($row = $result->fetch_assoc()) {
      echo "document.getElementById('bwW').innerText = '". $row["value"] . "']";
    }
  } else {
    echo "Kein Wert verfügbar";
  }
  $conn->close();
  ?>
</script>
<script src="js/main.js"></script>

</body>

</html>
