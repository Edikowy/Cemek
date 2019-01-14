<?php
   if(!isset($_SESSION['logged']))                           // jeśli nie istnieje zmienna zalogowany to
   {
      header('Location: index.php');                         // przekieruj do index_zalog.php
      exit();                                                // i zakończ
   }
?>
               <!-- // formgularz zmiana hasła -->
<form method="POST">
   Podaj hasło: <input type="pasword" name="haslo1" placeholder="Podaj hasło">
   Nowe hasło: <input type="pasword" name="new_haslo1" placeholder="Nowe hasło">
   Powtórz hasło: <input type="pasword" name="new_haslo2" placeholder="Powtórz hasło">
   <input type="submit" value="Zmiana hasła" name="ptw_haslo">
</form>
