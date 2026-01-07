<?php

  require_once HELPERS_DIR . 'DB.php';
  

  function lisääEhdotatapahtumat($nimi, $toive) {
     DB::run('INSERT INTO ehdotatapahtuma (nimi, toive) VALUES (?,?);',[$nimi, $toive]);
     return DB::lastInsertId();
    }

  function haeEhdotaTapahtuma($id) {
    return DB::run('SELECT * FROM ehdotatapahtuma WHERE idehdotatapahtuma = ?;',[$id])->fetchAll();
  }
  

?>