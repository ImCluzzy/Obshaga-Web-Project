<?php
	header('content-type:text/html;charset=utf-8');
	define('APP','itcast');
	session_start();
	
	if(isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'student'){
		require '../public/_share/_pdo.php';

		$user_id = $_SESSION['user_id'];
		
		$stmt = $pdo->prepare("SELECT dormitory_numb, dormitory_room FROM t_student WHERE id = ?");
		$stmt->execute([$user_id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if($result){
			$dormitory_numb = $result['dormitory_numb'];
			$dormitory_room = $result['dormitory_room'];
			
			$stmt = $pdo->prepare("SELECT * FROM t_dorm_maintain WHERE student_id = ?");
			$stmt->execute([$user_id]);
			$maintain_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

			require './view/maintain_html.php';
		} else {
			echo "Ошибка: Не удалось получить информацию о номере общежития и комнате студента.";
		}
	} else {
		header('Location: ../public/logout.php');
	}
?>
