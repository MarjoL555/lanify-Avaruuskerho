<?php $this->layout('template', ['title' => 'Ehdota tapahtumaa 2026']) ?><?php

//Minulla oli isoja ongelmia saada tämä toimimaan. Lopulta päätin käyttää 
//tukiopetus tunnilla tehtyä lahjalista- materiaalia tämän pohjana, koska olin saanut sen toimimaan hyvin. 
//Tämä toiminnallisuus eroaa siksi muusta sivustosta ja tulevaisuudessa voisin 
//yrittää yhtenäistää tämän toiminnallisuuden muuhun sivuston kokonaisuuteen.


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
    $stmt = $pdo->prepare("SELECT id, nimi, toive FROM ehdotatapahtuma"); 
    $stmt->execute(); 
    $ehdotatoiveet = $stmt->fetchAll();

  } catch (PDOException $e) { 

    // Tietokannan käsittelyssä tapahtui virhe, 
    // tulostetaan virheilmoitus ja kuollaan pois. 
    echo $e->getMessage(); 
    die();

  } 

?>
<section id="ehdota">

<h1>Ehdota vuodelle 2026 Avaruuskerhon tapahtumaa</h1>

<p>Onko sinulla joku hyvä idea Avaruuskerhon tapahtumiin, johon haluaisit osallistua?
   Mitä haluaisit opetella seuraavana kesänä tähtitiede päivillä?
   Tai onko sinulla joku suosikki puhuja, jonka haluaisit kutsua pitämään esitelmää?</p>
<br>
<p>Sivun lopussa voit ehdottaa omaa ideaa tai tapahtuma toivetta ensi vuodelle.</p>
<br>

<div class="ehdotatoiveet">

<h2>Jo ehdotettuja toivoita:</h2>
<br>

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
      <div class="error"><?= $virhe ?></div>  
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
    </section>
  </body>
</html>
