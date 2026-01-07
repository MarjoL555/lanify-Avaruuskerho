<?php $this->layout('template', ['title' => 'Ehdota']) ?>

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
<br>

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

</section>