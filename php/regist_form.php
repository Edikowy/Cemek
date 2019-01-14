<?php
if (isset($_POST['email'])) {
   $all_OK = true;
                              //Sprawdź poprawność nickname'a
   $nick = $_POST['nick'];

   if ((strlen($nick) < 3) || (strlen($nick) > 20)) {
      $all_OK = false;
      $_SESSION['err_nick'] = "Nick musi posiadać od 3 do 20 znaków!";
   }
   if (ctype_alnum($nick) == false) {
      $all_OK = false;
      $_SESSION['err_nick'] = "Nick musi składać się z znaków alfanumerycznych";
   }
                              // Sprawdź poprawność adresu email
   $email = $_POST['email'];
   $email_B = filter_var($email, FILTER_SANITIZE_EMAIL);

   if ((filter_var($email_B, FILTER_VALIDATE_EMAIL) == false) || ($email_B != $email)) {
      $all_OK = false;
      $_SESSION['err_email'] = "Podaj poprawny adres e-mail!";
   }
                              // sprawdzanie poprawności hasła
   $password_1 = $_POST['password_1'];
   $password_2 = $_POST['password_2'];

   if ((strlen($password_1) < 6) || (strlen($password_1) > 20)) {
      $all_OK = false;
      $_SESSION['err_password'] = "Hasło musi składać się od 6 do 20 znaków.";
   }
   if ($password_1 != $password_2) {
      $all_OK = false;
      $_SESSION['err_password'] = "Hasła nie są identyczne.";
   }
   $password_hash = password_hash($password_1, PASSWORD_DEFAULT);
                              // akceptacja regulaminu
   if (!isset($_POST['regul'])) {
      $all_OK = false;
      $_SESSION['err_regul'] = "Zaakceptuj regulamin.";
   }
                                                       // capchata

                                                      // capchata

                                 // zapamiętaj dane z formularza
   $_SESSION['form_nick'] = $nick;
   $_SESSION['form_email'] = $email;
   $_SESSION['form_password_1'] = $password_1;
   $_SESSION['form_password_2'] = $password_2;
   if (isset($_POST['regul'])) $_SESSION['form_regul'] = true;

   require_once "connect_db.php";
   mysqli_report(MYSQLI_REPORT_STRICT);

   try {
      $conn = new mysqli($host, $db_user, $db_password, $db_name);
      if ($conn->connect_errno != 0) {
         throw new Exception(mysqli_connect_errno());
      } else {
                                 // sprawdzenie email w bd
         $res = $conn->query("SELECT id FROM uzytkownicy WHERE email='$email'");

         if (!$res) throw new Exception($conn->error);

         $howManyMails = $res->num_rows;
         if ($howManyMails > 0) {
            $all_OK = false;
            $_SESSION['err_email'] = "Istnieje już konto przypisane do tego adresu e-mail!";
         }
                                 // sprawdzenie nicka w bd
         $res = $conn->query("SELECT id FROM uzytkownicy WHERE user='$nick'");

         if (!$res) throw new Exception($conn->error);

         $howManyNicks = $res->num_rows;
         if ($howManyNicks > 0) {
            $all_OK = false;
            $_SESSION['err_nick'] = "Istnieje już gracz o takim nicku! Wybierz inny.";
         }

         if ($all_OK == true) {
            if ($conn->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$password_hash', '$email')")) {
               $_SESSION['regist_OK'] = true;
               header('Location: ../welcome.php');
            } else {
               throw new Exception($conn->error);
            }

         }

         $conn->close();
      }
   } catch (Exception $e) {
      echo 'baza danych niedostępna';

   }

}
?>


                        <!-- // register form -->
<form method="POST">                               
   <label>
		<input type="text" name="nick" placeholder="Nick-name" style="width:150px; height:18px"
			value="<?php if (isset($_SESSION['form_nick'])) {
            echo $_SESSION['form_nick'];
            unset($_SESSION['form_nick']);
         } ?>" /> Twój login
	</label>	
      <div>&nbsp;
			<mark>
				<?php
   if (isset($_SESSION['err_nick'])) {
      echo $_SESSION['err_nick'];
      unset($_SESSION['err_nick']);
   }
   ?>
			</mark>
		</div>
   <label>
      <input type="text" name="email" placeholder="Email adress" style="width:150px; height:18px"
         value="<?php if (isset($_SESSION['form_email'])) {
                  echo $_SESSION['form_email'];
                  unset($_SESSION['form_email']);
               } ?>" /> Podaj adres email
   </label>
      <div>&nbsp;
         <mark>
            <?php
            if (isset($_SESSION['err_email'])) {
               echo $_SESSION['err_email'];
               unset($_SESSION['err_email']);
            }
            ?>
         </mark>
      </div>
   <label>
      <input type="password" name="password_1" placeholder="Password" style="width:150px; height:18px" 
         value="<?php if (isset($_SESSION['form_password_1'])) {
                  echo $_SESSION['form_password_1'];
                  unset($_SESSION['form_password_1']);
               } ?>" /> Twoje hasło
   </label>
      <div>&nbsp;
         <mark>
            <?php
            if (isset($_SESSION['err_password'])) {
               echo $_SESSION['err_password'];
               unset($_SESSION['err_password']);
            }
            ?>
         </mark>
      </div>
   <label>
      <input type="password" name="password_2" placeholder="Retry Password" style="width:150px; height:18px" 
         value="<?php if (isset($_SESSION['form_password_2'])) {
                  echo $_SESSION['form_password_2'];
                  unset($_SESSION['form_password_2']);
               } ?>"  /> Powtórz hasło
   </label><br><br>
   <label>
      <input type="checkbox" name="regul" <?php
                                          if (isset($_SESSION['form_regul'])) {
                                             echo "checked";
                                             unset($_SESSION['form_regul']);
                                          }
                                          ?>/> Akceptuję regulamin <a href="">Regulamin OWH</a> <br>
   </label>
      <div>&nbsp;
         <mark>
            <?php
            if (isset($_SESSION['err_regul'])) {
               echo $_SESSION['err_regul'];
               unset($_SESSION['err_regul']);
            }
            ?>
         </mark>
      </div>
   <input type="submit" value="Zarejestrój" name="zarejestroj">
</form>