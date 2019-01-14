<?php
session_start();
if (!isset($_POST['login'])) {
	header('Location: ../index.php');
	exit();
}
require_once "connect_db.php";
mysqli_report(MYSQLI_REPORT_STRICT);
try {
	$conn = new mysqli($host, $db_user, $db_password, $db_name);
	if ($conn->connect_errno != 0) {
		throw new Exception(mysqli_connect_errno());
	} else {
		$login = $_POST['login'];
		$password = $_POST['password'];

		$login = htmlentities($login, ENT_QUOTES, "UTF-8");

		if ($res = $conn->query(
			sprintf(
				"SELECT * FROM uzytkownicy WHERE user='%s'",
				mysqli_real_escape_string($conn, $login)
			)
		)) {
			$howManyUsers = $res->num_rows;
			if ($howManyUsers > 0) {
				$row = $res->fetch_assoc();

				if (password_verify($password, $row['pass'])) {
					$_SESSION['logged'] = true;
					$_SESSION['id'] = $row['id'];
					$_SESSION['user'] = $row['user'];
					$_SESSION['email'] = $row['email'];

					unset($_SESSION['err']);
					$res->free_result();
					header('Location: ../index_logged.php');
				} else {
					$_SESSION['err'] = 'Zly haslo';
					header('Location: ../index.php');
				}

			} else {
				$_SESSION['err'] = 'Zly login';
				header('Location: ../index.php');
			}

		} else {
			throw new Exception($conn->error);
		}

		$conn->close();
	}
} catch (Exception $e) {
	echo 'baza danych niedostępna';
}