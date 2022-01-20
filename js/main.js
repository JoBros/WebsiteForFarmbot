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
      $username = "ad";
      $password = "Alzheimer1!";
      $dbname = "Farmbot";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT sensor, value, created_at FROM SensorDat t ORDER BY created_at desc limit 288";
      $result = $conn->query($sql);

      echo "['Datum', 'Wert']"

      if ($result->num_rows > 0) {
        $datumzahl = 0;
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "['" . $datumszahl ."'," . $row[""] . "]"
          if($result->num_rows < ($datumszahl+1)){
            echo ",";
          }
          $datumzahl = $datumszahl +1;
        }
      } else {
        echo "0 results";
      }
      $conn->close();

    ?>
  ]);
  // create options object with titles, colors, etc.
  let options = {
    hAxis: {
      title: "Zeit"
    },
    vAxis: {
      title: "Wert"
    }
  };
  // draw chart on load
  let chart = new google.visualization.LineChart(
    document.getElementById("chart_div")
  );
  chart.draw(data, options);
}
