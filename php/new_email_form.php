<?php
   if(!isset($_SESSION['logged']))                   // jeśli nie istnieje zmienna zalogowany to
   {
      header('Location: index.php');                 // przekieruj do index_zalog.php
      exit();                                        // i zakończ
   }
?>
             <!-- // formgularz nowy adres email -->
<form method="POST">
   <?= 'Obecny adres email: '.$_SESSION['email'].' '.$_SESSION['user'];;?>
   Podaj hasło: <input type="pasword" name="haslo_email" placeholder="Podaj hasło">
   Podaj nowy email: <input type="text" name="new_email" placeholder="Podaj nowy adres email">
   <input type="submit" value="Zmień adres email" name="ptw_email">
</form>
