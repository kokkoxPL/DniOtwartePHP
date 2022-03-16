<?php
function odp($ans) {
  if($ans == "1") {
    return 1;
  }
    return 0;
}

$server = "localhost";
$username = "root";
$password = "";
$baza = "dni_otwarte";
$tabela = "uczniowie";
$cookie = "Cookies";
$wynikiNick = [];
$wynikiWynik = [];
$wyn;
$sql = new mysqli($server, $username, $password);
$sql->query("CREATE DATABASE IF NOT EXISTS $baza;");
$sql = new mysqli($server, $username, $password, $baza);
$sql->query("CREATE TABLE IF NOT EXISTS $tabela(id int AUTO_INCREMENT PRIMARY KEY, dane varchar(20), nick varchar(20), szkola varchar(40), miasto varchar(20), wynik int);");


if($_SERVER["REQUEST_METHOD"] == "POST") {
  $dane = $_POST["dane"];
  $nick = $_POST["nick"];
  $szkola = $_POST["szkola"];
  $miasto = $_POST["miasto"];
  $wynik = 0;
  for ($i = 1; $i <= 10; $i++) {
    if (isset($_POST["answer".$i])) {
      $wynik += odp($_POST["answer".$i]);
    };
  };


  $sql->query("INSERT INTO $tabela(dane, nick, szkola, miasto, wynik) VALUES('$dane', '$nick', '$szkola', '$miasto', '$wynik');");

  setcookie($cookie , $sql->insert_id, time() + (3600), "/");

  unset($_POST);
  header("Location: ".$_SERVER['PHP_SELF']);
}

$wyniki = $sql->query("SELECT nick, wynik FROM $tabela ORDER BY wynik DESC");
while($info = $wyniki->fetch_assoc()) {
  $wynikiNick[] = $info["nick"];
  $wynikiWynik[] = $info["wynik"];
}
/*$a = $_COOKIE['$cookie']

$wyniki2 = $sql->query("SELECT wynik FROM $tabela WHERE id = 2");
while($info2 = $wyniki2->fetch_assoc()) {
  $wyn[] = $info2["wynik"];
}*/
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
            print "<tr>". "<td class='nicktr'>" . $i ."</td>". "</tr>";
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
                print "<tr>". "<td class  ='scoretr'>" . $i ."</td>". "</tr>";
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