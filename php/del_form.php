<?php
   if(!isset($_SESSION['logged']))                                   // jeśli nie istnieje zmienna zalogowany to
   {
      header('Location: index.php');                                 // przekieruj do index_zalog.php
      exit();                                                        // i zakończ
   }
?>
                           <!-- // formgularz usun_konto -->
<form method="POST">
   Podaj hasło: 
   <input type="pasword" name="haslo1" placeholder="Podaj hasło">
   Powtórz hasło: 
   <input type="pasword" name="haslo2" placeholder="Powtórz hasło">
   <label>
      Potwierdź usówanie konta: 
      <input type="checkbox" name="usun">
   </label>
   <input type="submit" value="Usówam konto" name="ptw_usun">
</form>
