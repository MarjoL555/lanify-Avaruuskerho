<?php $this->layout('template', ['title' => 'Ehdota tapahtumaa 2026']) ?>


<section id="ehdota">

<h1>Ehdota vuoden 2026 tapahtumaa</h1>
<p>Onko sinulla joku hyvä idea Avaruuskerhon tapahtumiin, johon haluaisit osallistua?
   Mitä haluaisit opetella seuraavana kesänä tähtitiede päivillä?
   Tai onko sinulla joku suosikki puhuja, jonka haluaisit kutsua pitämään esitelmää?</p>
<br>
<p>Tällä lomakkeella voit ehdottaa omaa ideaa tai tapahtuma toivetta ensi vuodelle.</p>
<br>
<h3> TODO: Tee toiminnallisuus, jolla voi ehdottaa omaa ideaa ja 
    nähdä kaikki muut ehdotetut tapahtumat. 
    Tee MariaDB taulukko ja sille lyhyesti esimerkki sisältö.
    Rakenna tyylillisesti hyvä ja muutenkin toimiva sivusto</h3>
<br>
<p>Kesken. Ei sisältöä vielä, ideoi jotain??</p>

    
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