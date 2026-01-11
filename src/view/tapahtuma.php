<?php $this->layout('template', ['title' => $tapahtuma['nimi']]) ?>

<?php
  $start = new DateTime($tapahtuma['tap_alkaa']);
  $end = new DateTime($tapahtuma['tap_loppuu']);
?>

<section id="tapahtuma">
<h1><?=$tapahtuma['nimi']?></h1>
<div><?=$tapahtuma['kuvaus']?></div>
<br>
<div>Alkaa: <?=$start->format('j.n.Y')?> klo <?=$start->format('G.i')?></div>
<div>Päättyy: <?=$end->format('j.n.Y')?> klo <?=$end->format('G.i')?></div>
</section>

<?php
    if ($loggeduser) {
       if (!$ilmoittautuminen) {
         echo "<div class='flexarea'><a href='ilmoittaudu?id=$tapahtuma[idtapahtuma]' class='button'>ILMOITTAUDU</a></div>";    
    } else {
      echo "<div class='flexarea'>";
      echo "<div>Olet ilmoittautunut tapahtumaan!</div>";
      echo "<a href='peru?id=$tapahtuma[idtapahtuma]' class='button'>PERU ILMOITTAUTUMINEN</a>";
      echo "</div>";
    }
  }
?>