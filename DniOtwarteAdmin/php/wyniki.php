<?php
$server = "localhost";
$username = "root";
$password = "";
$baza = "dni_otwarte";
$tabela = "wyniki";
$wynikiNick = [];
$wynikiWynik = [];

$sql = new mysqli($server, $username, $password);
$sql->query("CREATE DATABASE IF NOT EXISTS $baza;");
$sql = new mysqli($server, $username, $password, $baza);
$sql->query("CREATE TABLE IF NOT EXISTS $tabela(id int AUTO_INCREMENT PRIMARY KEY, dane varchar(40), nick varchar(20), szkola varchar(40), miasto varchar(20), wynik int);");

$wyniki = $sql->query("SELECT nick, wynik FROM $tabela ORDER BY wynik DESC");
while ($info = $wyniki->fetch_assoc()) {
  $wynikiNick[] = $info["nick"];
  $wynikiWynik[] = $info["wynik"];
}

$sql->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/wyniki.css" />

  <title>Wyniki</title>
</head>

<body>
  <ul>
    <li><a href="../index.html"> POWRÓT NA STRONĘ GŁÓWNĄ</a></li>
  </ul>
  <div class="tabela-wynikow">
    <div class="nickHeader">
      <div class="nick">
        <h1>PSEUDONIM</h1>
        <div class="nick-table">
          <table id="table1">
            <?php
            foreach ($wynikiNick as $i) {
              print "<tr>" . "<td class='nicktr'>" . $i . "</td>" . "</tr>";
            }
            ?>
          </table>
        </div>
      </div>
    </div>

    <div class="scoreHeader">
      <div class="score">
        <h1>WYNIK</h1>
        <div class="score-table">

          <table id="table2">
            <?php
            foreach ($wynikiWynik as $i) {
              print "<tr>" . "<td class  ='scoretr'>" . $i . "</td>" . "</tr>";
            }
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="your-score">
    <h1>Twoj wynik to:</h1>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../scripts/wyniki.js"></script>
</body>

</html>