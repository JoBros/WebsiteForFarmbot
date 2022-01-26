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

<h2>Handbetriebsseite zum Farmbot</h2>
<p>Auf dieser Seite kann alles gefunden werden, was zum manuellen Steuern des Farmbots nötig ist. Auf dieser Seite ist es möglich das Gehäuse in X, Y, und Z Richtung zu bewegen. Auch die Gießbewegung und die Wässerungsfunktion kann hier genutzt werden. Ebenso kann der Workflow zum Sähen seine Einleitung finden. </p>
<center>
<table class="links">
  <tr>
    <td class="anzeigeStatus" style="visibility: hidden"></td>
    <td class="anzeigeStatus"><center><Button id="A" class="anzeigeStatus">x ></Button></center></td>
    <td class="anzeigeStatus" style="visibility: hidden"></td>
  </tr>
  <tr>
    <td class="anzeigeStatus"><center><Button id="W" class="anzeigeStatus">y <</Button></center></td>
    <td class="anzeigeStatus" style="visibility: hidden"></td>
    <td class="anzeigeStatus"><center><Button id="S" class="anzeigeStatus">y ></Button></center></td>
  </tr>
  <tr>
    <td class="anzeigeStatus" style="visibility: hidden"></td>
    <td class="anzeigeStatus"><center><Button id="D" class="anzeigeStatus">x <</Button></center></td>
    <td class="anzeigeStatus" style="visibility: hidden"></td>
  </tr>
  <tr>
    <td class="anzeigeStatus"><center><Button id="Q" class="anzeigeStatus">z <</Button></center></td>
    <td class="anzeigeStatus" style="visibility: hidden"></td>
    <td class="anzeigeStatus"><center><Button id="E" class="anzeigeStatus">z ></Button></center></td>
  </tr>
</table>
        <div class="rechts">
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
</center>
<script src="js/main.js"></script>
<script src="js/WebsocketControl.js"></script>
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
