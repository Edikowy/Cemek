

<div>
    <form method="POST" action="php/login_mech.php">
        <label>Login:
            <input type="text" name="login" placeholder="Login" style="width:80px; height:18px">
        </label><br>
        <label>Hasło:
            <input type="password" name="password" placeholder="Password" style="width:80px; height:18px;">
        </label><br>
        <input type="submit" value="Zaloguj" name="loguj" style="width:60px; height:26px;">
    </form>
        <?php if (isset($_SESSION['err'])) echo $_SESSION['err']; ?>
</div>
