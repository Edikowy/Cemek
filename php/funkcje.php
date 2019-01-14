<?php

function WyswietlNaglowek()
{
  echo '<!DOCTYPE html><html lang="pl">'
    . "\n" . '<head><meta charset="utf-8" />'
    . "\n" . '<meta http-equiv="X-UA-Compatible" content="IE=edge">'
    . "\n" . '<meta name="viewport" content="width=device-width, initial-scale=1">'
    . "\n" . '<script src="js/main.js"></script>';
}

function WyswietlStyle($style)
{
  foreach ($style as $stylki) {
    echo '<link rel="stylesheet" type="text/css" media="screen" href="' . $stylki . '" />';
  }
}

function WyswietlTytul($tytul)
{
  echo '<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">';
  echo '<title>';
  echo $tytul;
  echo '</title>';
}

function WyswietlBody()
{
  echo '</head>'
    . "\n" . '<body>'
    . "\n" . '<div class="zero">'
    . "\n" . '<div class="jeden">';
}

function WyswietlDachLewy()
{
  echo '<header class="dach">';
  echo '<span class="lewy">';
  echo '<div id="zegar">';
  echo '<div id="data"></div>';
  echo '<div id="czas"></div>';
  echo '</div>';
  echo '</span>';
}

function WyswietlDachSrodek()
{
  echo '<span class="center">'
    . "\n" . '<em id="logo">Cemek</em>'
    . "\n" . '</span>';
}

function WyswietlDachPrawy()
{
  echo '<span class="prawy">';
  include "php/login_form.php";
  echo "&nbsp;";
  echo '</span>';
  echo '</header>';
}

function WyswietlLinki($linki)

{
  echo '<nav class="linki">';
  foreach ($linki as $nazwa => $url) {
    WyswietlLink(
      $nazwa,
      $url
    );
  }
  echo '</nav>';
}

function WyswietlLink($nazwa, $url)
{
   echo "<a href = \"" . $url . "\"><div class=\". $nazwa .\">";
   echo $nazwa;
   echo '</div></a>';
}

function WyswietlCentral()
{
   echo '<main class="central">';
   echo '</main>';
}

function WyswietlStopke()
{
   echo '<footer class="stopka">Cemek &copy;</footer>';
}

function WyswietlZamek()
{
   echo '</div>'
      . "\n" . '</div>'
      . "\n" . '</body>'
      . "\n" . '</html>';
}
