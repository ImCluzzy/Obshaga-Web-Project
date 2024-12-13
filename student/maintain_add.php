<?php
	header('content-type:text/html;charset=utf-8');
	define('APP','itcast');
	session_start();
	
	if(isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'student') {
		$user_id = $_SESSION['user_id'];
		
		require '../public/_share/_pdo.php';
		
		$stmt = $pdo->prepare("SELECT dormitory_numb, dormitory_room FROM t_student WHERE id = ?");
		$stmt->bindParam(1, $user_id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($row) {
			$dorm_numb = $row['dormitory_numb'];
			$dorm_room = $row['dormitory_room'];
			
			require './view/maintain_add_html.php';
		} else {
			header('Location: ./maintain.php');
		}
	} else {
		header('Location: ../public/logout.php');
	}
?>
