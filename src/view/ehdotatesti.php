<?php $this->layout('template', ['title' => 'Ehdota testailua']) ?><?php
  // Haetaan tietokantayhteyden tiedot ympäristömuuttujista.
  $db_database = $_SERVER["DB_DATABASE"];
  $db_username = $_SERVER["DB_USERNAME"];
  $db_password = $_SERVER["DB_PASSWORD"];

  // Alustetaan PDO-yhteyden asetukset.
  $dsn = "mysql:host=localhost;dbname=$db_database;charset=utf8mb4"; 
  $options = [ 
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::ATTR_EMULATE_PREPARES   => false, 
  ]; 
   
  try { 

    // Avataan tietokantayhteys. 
    $pdo = new PDO($dsn, $db_username, $db_password, $options);

    // Tarkistetaan onko lomaketta täytetty.
    if (isset($_POST['laheta']) && !empty($_POST['laheta'])) {
      
        // Noudetaan tiedot.
        $nimi = $_POST['nimi'];
        $toive = $_POST['toive'];

        // Tarkistetaan, että pakolliset ovat määritelty.
        if (!empty($nimi) && !empty($toive)) {

          // Lisätään rivi tietokantaan;
          $stmt = $pdo->prepare("INSERT INTO ehdotatapahtuma (nimi, toive) VALUES (?,?)"); 
          $stmt->execute([$nimi, $toive]);

          // Tyhjennetään lomakkeen kentät.
          $nimi = "";
          $toive = "";

        } else {

          // Pakollisia kenttiä ei oltu määritelty. 
          $virhe = "Syötä vähintään nimi ja tapahtuma ehdotus.";

        }
    }

    // Tarkistetaan, ollaanko poistamassa riviä. (Nyt rivien poistaminen on suljettu.)
    if (isset($_GET['poista'])) {

      // Noudetaan poistettavan ehdotuksen id.
      $id = $_GET['poista'];

      // Poistetaan ehdotus.
      $stmt = $pdo->prepare("DELETE FROM ehdotatapahtuma WHERE id = ?"); 
      $stmt->execute([$id]);
    }

    // Haetaan ehdotukset.
    $stmt = $pdo->prepare("SELECT id, nimi, toive 
                           FROM   ehdotatapahtuma"); 
    $stmt->execute(); 
    $ehdotatoiveet = $stmt->fetchAll();

  } catch (PDOException $e) { 

    // Tietokannan käsittelyssä tapahtui virhe, 
    // tulostetaan virheilmoitus ja kuollaan pois. 
    echo $e->getMessage(); 
    die();

  } 

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <title>Ehdota tapahtumaa</title>
  </head>
  <body>
    <h1>Ehdota vuodelle 2026 Avaruuskerhon tapahtumaa</h1>

    <div class="ehdotatoiveet">

<?php
    foreach ($ehdotatoiveet as $ehdotatapahtuma) {
      
      echo "      <div class='ehdotatoive'>", PHP_EOL;
      echo "      <div class='ehdotatoive-nimi'>$ehdotatapahtuma[nimi]</div>", PHP_EOL;
      echo "      <div class='ehdotatoive-toive'>$ehdotatapahtuma[toive]</div>", PHP_EOL;    
      // Tämä nappi pois päältä, että muiden toiveita ei voi verkkosivulta poistella.
      // Napin voi laittaa päälle, jos tulevaisuudessa sitä tarvitaan sivustolla.
      // echo "      <div class='ehdotatoive-poista'><a href='?poista=$ehdotatapahtuma[id]'>🗑️</a></div>", PHP_EOL;   
      echo "      </div>", PHP_EOL;
    }
?>
    </div>
    
    <div class="ehdotalomake">    
      <div class="virheteksti"><?= $virhe ?></div>  
      <form action="" method="POST">
        <div>
          <label for="nimi">Nimi:</label>
          <input type="text" name="nimi" id="nimi" value="<?= $nimi ?>">
        </div>
        <div>
          <label for="toive">Tapahtuma toive tai ehdotus:</label>
          <input type="text" name="toive" id="toive" value="<?= $toive ?>">
        </div>
       
        <div>        
          <input type="submit" name="laheta" value="LISÄÄ EHDOTUS">
        </div>             
      </form>      
    </div>
  </body>
</html>
