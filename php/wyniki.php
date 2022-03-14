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
//$wynik = odp($_POST["answer1"]) + odp($_POST["answer2"]) + odp($_POST["answer3"]) + odp($_POST["answer4"]) + odp($_POST["answer5"]) + odp($_POST["answer6"]) + odp($_POST["answer7"]) + odp($_POST["answer8"]) + odp($_POST["answer9"]) + odp($_POST["answer10"]);


$sql = new mysqli($server, $username, $password);
$sql->query("CREATE DATABASE IF NOT EXISTS $baza;");
$sql = new mysqli($server, $username, $password, $baza);
$sql->query("CREATE TABLE IF NOT EXISTS $tabela(id int AUTO_INCREMENT PRIMARY KEY, dane varchar(20), nick varchar(20), szkola varchar(40), miasto varchar(20), wynik int);");
$sql->query("INSERT INTO $tabela(dane, nick, szkola, miasto, wynik) VALUES('$dane', '$nick', '$szkola', '$miasto', '$wynik');");

$wyniki = $sql->query("SELECT id, dane, nick, szkola, miasto, wynik FROM $tabela ORDER BY wynik DESC");

$wynikiNick = [];
$wynikiWynik = [];
$wynikiID = [];

while($miejsce = $wyniki->fetch_assoc()) {
  $wynikiNick[] = $miejsce["nick"];
  $wynikiWynik[] = $miejsce["wynik"];
  $wynikiID[] = $miejsce["id"];
  /*print "dane: " . $miejsce["dane"] .  " nick: " . $miejsce["nick"] . " szkoła: " . $miejsce["szkola"] 
  . " miejscowość: " . $miejsce["miasto"] . " wynik: " . $miejsce["wynik"] . "<br>";*/
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
              <?php 
              foreach($wynikiNick as $i) {
                print $i .  "<br>" . "<br>";
              }
              ?>
          </div>
    </div>
    </div>

    <div class="scoreHeader">
      <div class="score">
      <h1>WYNIK</h1>
        <div class="score-table">
            <?php 
              foreach($wynikiWynik as $i) {
              print $i .  "<br>" . "<br>";
              }
              ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>