
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
  <a href="VideoLog.php">Videolog</a>
  <a href="kontakt.php">Kontakt</a>
  <a href="auskunft.php">Auskunft</a>
</div>



<div style="padding-left:16px">
  <p>Hier wird der aktuelle Sensorenwerte und die letzten Fahrbewegungen des Farmbots angezeigt. Das Fenster dient zur Anzeige für den Gärtner um Trends und aktuelle Bedürfnisse zu erkennen. </p>

  <h2>Wassersensorik </h2>
<center>
  <div style="min-width:30%; min-height:30%; max-width: 90%" id="chart_div"></div>
  <p>Der aktuelle Bodenwasserwert liegt bei: <Label id="bwW" style="text-underline: #04AA6D; color: darkcyan"></Label> von 100 %.</p>
</center>

  <h2>Temperatursensorik</h2>
<center>
  <div style="min-width:30%; min-height: 30%; max-width: 90%" id="chart_div1"></div>
  <p>Der aktuelle Temperaturwert liegt bei: <Label id="bwT" style="text-underline: #04AA6D; color: darkcyan;"></Label> °C.</p>
</center>

  <h2>Luftfeuchtigkeitsverlauf</h2>
<center>
  <div style="min-width:30%; min-height: 30%;  max-width: 90%" id="chart_div2"></div>
  <p>Der aktuelle Luftfeuchtigkeitswert liegt bei: <Label id="bwL" style="text-underline: #04AA6D; color: darkcyan;"></Label> %.</p>
</center>

  <h2>Welche arbeiten wurden in der letzten Zeit gemacht?</h2>
  <center>
  <div class="anzeigeStatus">
  <table style="mso-cellspacing: 20px;" class="anzeigeStatus">
    <?php

    $servername = "localhost";
    $username = "me";
    $password = "Alzheimer";
    $dbname = "Farmbot";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
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
    $conn->close();
    ?>
  </table>
  </div>
  </center>

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
      $servername = "localhost";
      $username = "me";
      $password = "Alzheimer";
      $dbname = "Farmbot";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT value, created_at FROM SensorDat t where sensor='WS_1' ORDER BY created_at desc limit 120"; //limit 120
      $result = $conn->query($sql);

      echo "['Datum', 'WS_1'],";

      if ($result->num_rows > 0) {
        // output data of each row => Wassersensor
        $datumszahl = $result->num_rows;
        while($row = $result->fetch_assoc()) {
          $datumzeit=$row["created_at"];
          $dt = strtotime($datumzeit);
          $value = (int)0;
          if(((int)$row["value"]) > 830){
            $value = (int)0;
          }elseif(((int)$row["value"])  < 430){
            $value = (int)100;
          }else{
            $value = (1/400 * (830 - ((int)$row["value"]) ))*100; //Berechnung des Anzeigewerts für die Tabelle gemäß Messreihe in %
          }

          echo "[ " . $dt . " ," . (String)$value . "]";
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
        title: "Wert in %",
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
      $servername = "localhost";
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

      echo "['Datum', 'TS_1'],";

      if ($result->num_rows > 0) {
        // output data of each row
        $datumszahl = $result->num_rows;
        while($row = $result->fetch_assoc()) {
          $array[$i_zahl] = $row["value"];
          $i_zahl = $i_zahl + 1;
          if($i_zahl > 9){
            unset($array[$i_zahl-9]);
          }else{
            continue;
          }
          $ArrayObject = new ArrayObject($array);
          $array_copy = $ArrayObject->getArrayCopy();
          sort($array_copy, SORT_NUMERIC);
          //$min = min(array_keys($arr)); // hier koennte auch array_flip() statt array_keys() verwendet werden
          //var_dump($arr[$min + $x]);
          $wert = (int) $array_copy[4];
          $datumzeit=$row["created_at"];
          $dt = strtotime($datumzeit);
          if(!$wert.is_int()){
            continue;
          }
          if(0 < ($datumszahl) - 1 && $datumszahl != $result->num_rows){
            echo ",";
          }
          echo "[ " . $dt . " ," . $wert . "]";
          $datumszahl = $datumszahl -1;
        }
      } else {
        echo "0 results";
      }
      $conn->close();

      ?>
    ] );
    options = {

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
      $servername = "localhost";
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

      echo "['Datum', 'LS_1'],";

      if ($result->num_rows > 0) {
        // output data of each row
        $datumszahl = $result->num_rows;
        while($row = $result->fetch_assoc()) {
          $array[$i_zahl] = $row["value"];
          $i_zahl = $i_zahl + 1;
          if($i_zahl > 9){
            unset($array[$i_zahl-9]);
          }else{
            continue;
          }
          $ArrayObject = new ArrayObject($array);
          $array_copy = $ArrayObject->getArrayCopy();
          sort($array_copy, SORT_NUMERIC);
          //$min = min(array_keys($arr)); // hier koennte auch array_flip() statt array_keys() verwendet werden
          //var_dump($arr[$min + $x]);
          $wert = (int) $array_copy[4];
          $datumzeit=$row["created_at"];
          $dt = strtotime($datumzeit);
          if(!$wert.is_int()){
            continue;
          }
          if(0 < ($datumszahl) && $datumszahl != $result->num_rows){
            echo ",";
          }
          echo "[" . $dt . "," . $wert . "]";
          $datumszahl = $datumszahl -1;
        }
      } else {
        echo "0 results";
      }
      $conn->close();

      ?>
    ] );
    // create options object with titles, colors, etc.
    options = {

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
    chart = new google.visualization.LineChart(
      document.getElementById("chart_div2")
    );
    chart.draw(data, options);

  }
  <?php
  $servername = "localhost";
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
    //Hier findet die Umrechnung der Daten für die Wasseranzeige statt.
    $datumszahl = $result->num_rows;
    while($row = $result->fetch_assoc()) {
      $value = (int)0;
      if(((int)$row["value"]) > 830){
        $value = (int)0;
      }elseif(((int)$row["value"])  < 430){
        $value = (int)100;
      }else{
        $value = (1/400 * (830 - ((int)$row["value"])))*100; //Berechnung des Anzeigewertes für den Text gemäß Messreihe in %
      }
      echo "document.getElementById('bwW').innerText = '". ((String)$value) . "';";
    }
  } else {
    echo "Kein Wert verfügbar";
  }
  $conn->close();
  ?>
  <?php
  $servername = "localhost";
  $username = "me";
  $password = "Alzheimer";
  $dbname = "Farmbot";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT value FROM SensorDat t where sensor='LF_1' ORDER BY created_at desc limit 1";
  $result = $conn->query($sql);


  if ($result->num_rows > 0) {
    // output data of each row
    $datumszahl = $result->num_rows;
    while($row = $result->fetch_assoc()) {
      echo "document.getElementById('bwL').innerText = '". $row["value"] . "';";
    }
  } else {
    echo "Kein Wert verfügbar";
  }
  $conn->close();
  ?>
  <?php
  $servername = "localhost";
  $username = "me";
  $password = "Alzheimer";
  $dbname = "Farmbot";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT value FROM SensorDat t where sensor='TP_1' ORDER BY created_at desc limit 1";
  $result = $conn->query($sql);


  if ($result->num_rows > 0) {
    // output data of each row
    $datumszahl = $result->num_rows;
    while($row = $result->fetch_assoc()) {
      echo "document.getElementById('bwT').innerText = '". $row["value"] . "';";
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
