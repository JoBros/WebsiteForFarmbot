// load current chart package
google.charts.load("current", {
  packages: ["corechart", "line"]
});
// set callback function when api loaded
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  // create data object with default value
  let data = google.visualization.arrayToDataTable([
    ["Datenreihe1" , "Feuchtigkeit [in %]?"],
    [1,0],
    [4,2],
    [2,1],

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
