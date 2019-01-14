<?php
require_once('funkcje.php');
class Strona
{
   // zmienne klasowe

   public $tytul = "Cemek - index";
   public $style = array(
      'css/main.css',
      'css/style.css',
      'css/zero.css'
   );

   public $linki = array(
      'k60' => 'linkalfa.php',
      'k120' => 'linkbeta.php',
      'k180' => 'linkgamma.php',
      'k240' => 'linkdelta.php',
      'k300' => 'linkypsylon.php'
   );

   // główny element budujący stronę

   public function Wyswietl()
   {
      WyswietlNaglowek();
      WyswietlStyle($this->style);
      WyswietlTytul($this->tytul);
      WyswietlBody();
      WyswietlDachLewy();
      WyswietlDachSrodek();
      WyswietlDachPrawy();
      WyswietlLinki($this->linki);
      WyswietlCentral();
      WyswietlStopke();
      WyswietlZamek();
   }


}

?>
