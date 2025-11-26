<!DOCTYPE html>
<html lang="fi">
  <head>
    <title>lanify - <?=$this->e($title)?></title>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/styles.css" rel="stylesheet">
  </head>
  <body>
    <header>
        <h1><a href="<?=BASEURL?>">Avaruuskerho</a></h1>
        <div class="profile">
          <?php
            if (isset($_SESSION['user'])) {
             echo "<div>$_SESSION[user]</div>";
             echo "<div><a href='logout'>Kirjaudu ulos</a></div>";
             if (isset($_SESSION['admin']) && $_SESSION['admin']) {
              echo "<div><a href='admin'>Ylläpitosivut</a></div>";  
              }
            } else {
             echo "<div><a href='kirjaudu'>Kirjaudu</a></div>";
            }
          ?>
        </div>
    </header>

        <nav>
          <ul>
            <li><a href="../kerhosivu">Kerhosivu</a></li>
            <li><a href="../kerhosivu/tapahtumat">Tapahtumat</a></li>
            <li><a href="../kerhosivu/kuvagalleria">Kuvagalleria</a></li>
            <li><a href="../kerhosivu/yhteystiedot">Yhteystiedot</a></li>
          </ul>
        </nav>

    <section>
      <?=$this->section('content')?>
    </section>
    <footer>
      <hr>
      <div>Avaruuskerho by Marjo</div>
      <p>Kuvat unsplash.com.</p>
    </footer>
  </body>
</html>