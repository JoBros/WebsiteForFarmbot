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
  <a href="bepflanzung.php">Bepflanzung</a>
  <a class="active" href="handbetrieb.php">Handbetrieb</a>
  <a href="kontakt.php">Kontakt</a>
  <a href="auskunft.php">Auskunft</a>
</div>
<center>
<table style="background-color: #cccccc; clear: both">
  <tr>
    <th><br></th>
    <th>
      <Button id="A">x ></Button>
    </th>
    <th><br></th>
  </tr>
  <tr>
    <td>
      <Button id="W">y <</Button>
    </td>
    <td><br></td>
    <td>
      <Button id="S">y ></Button>
    </td>
  </tr>
  <tr>
    <td><br></td>
    <td>
      <Button id="D">x <</Button>
    </td>
    <td><br></td>
  </tr>
  <tr>
    <td>
      <Button id="Q">z <</Button>
    </td>
    <td><br></td>
    <td>
      <Button id="E">z ></Button>
    </td>
  </tr>
</table>
</center>
<div id="handcontrol" style="width: auto; margin: 2%; padding: 2%; background-color: whitesmoke; min-width: 38em; ">
  <div style="margin-right: 10%; margin-top: 1%; padding-top: 1%; float: right; border: 1px black; clear: revert; ">
    <table style="align-items: center; align-content: center; background-color: lightgrey">


      <tr>
        <th>
          <div style="background-color: lightgrey; height: auto; margin-top: 1em; width: 100%;">
            <Button id="wasserbtn" style="background-color: dodgerblue; color: white; height: 4em; width: 6em;">
              Wasser
            </Button>
            <input id="_waternumber" style="height: 3em; width: 6em;" type="number" disabled="true"/><Label style="height: 4em; width: 6em;">%
              Wasser</Label>
            <br>
            <Button id="hakbtn" style="height: 4em; width: 6em;">Harke</Button>
            <input disabled="true" style="height: 3em; width: 6em;"/><Label style="height: 3em; width: 6em;" hidden="true">Harken
              ausgeführt!</Label>
            <br>
            <Button id="saatbtn" style="height: 4em; width: 6em;">Saat</Button>
            <input id="frucht" style="height: 3em; width: 6em;"/><Label style="height: 3em; width: 6em;" hidden="true">Saat
              ausgeführt!</Label>
          </div>
        </th>
      </tr>

      <tr>
        <th>
          <ol id="plantdat" style="clear:both; background-color: lightgrey">
          </ol>
        </th>
      </tr>
      <tr>
        <th>
          <div style="width: 100%; height: auto; background-color: #b3d4fc; clear: both;">
            <table style="padding: 0.5em">
              <tr>
                <td><Label style="padding: 0.5em">Sorte:</Label></td>
                <td><Label id="pflanzeeins" style="padding: 0.5em; min-width: fit-content"></Label></td>
              </tr>
              <tr>
                <td><Label style="padding: 0.5em">Bodenbeschaffenheit:</Label></td>
                <td><Label id="pflanzezwei" style="padding: 0.5em"></Label></td>
              </tr>
              <tr>
                <td><Label style="padding: 0.5em">Wachstumsdauer min/max:</Label></td>
                <td><Label id="pflanzedrei" style="padding: 0.5em"></Label></td>
              </tr>
              <tr>
                <td><Label style="padding: 0.5em">Aussaatzeitpunkt von/bis</Label></td>
                <td><Label id="pflanzevier" style="padding: 0.5em"></Label></td>
              </tr>
            </table>
          </div>
      </tr>
    </table>

  </div>

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
?>
