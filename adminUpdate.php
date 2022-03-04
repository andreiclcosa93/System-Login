<?php 

	session_start();

	if(isset($_SESSION['userId'])) {
		require('./config/db.php');
		$userId = $_SESSION['userId'];
		$stmt = $pdo -> prepare('SELECT * FROM users WHERE id = ?');
		$stmt->execute([$userId]);
		$user = $stmt->fetch();

		if($user->role === "admin") {

			$role = $_POST['userInfo'];
			echo "$role <br>";
			$targetUserId = $_POST['targetUserId'];

			echo "$targetUserId <br>"

			if(isset($_POST['superEdit'])) {
				$stmt = $pdo -> prepare('UPDATE users SET role = ? WHERE id = ?');
				$stmt->execute([$role, $targetUserId]);
				
			} elseif (isset($_POST['superDelete'])) {
				$stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
				$stmt->execute([$targetUserId]);
			}

			header('Location: http://localhost/login-project/index.php');
	}
}

?>