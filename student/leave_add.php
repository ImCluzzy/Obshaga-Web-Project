<?php
	header('content-type:text/html;charset=utf-8');
	define('APP','itcast');
	session_start();
	
	if(isset($_SESSION['user_id'])&&isset($_SESSION['user_type'])){
		$user_type=$_SESSION['user_type'];
		if($user_type!="student"){
		
			header("Location: ../$user_type/home.php");
		}else{

			$user_account=$_SESSION['user_account'];
			$user_name=$_SESSION['user_name'];
			$user_id=$_SESSION['user_id'];
			
			if($_POST){
				$date_start=$_POST['date_start'];
				$date_end=$_POST['date_end'];
				$request=$_POST['request'];
				if(strtotime($date_start)<time()){
					echo "<script>alert('Время начала должно быть больше текущего времени.')</script>";
				}else if(strtotime($date_end)<=strtotime($date_start)){
					echo "<script>alert('Время возврата должно быть больше времени начала.')</script>";
				}else{
					require '../public/_share/_pdo.php';
					$sql="insert into t_student_leave(`student_id`,`date_start`,`date_end`,`request`) values($user_id,?,?,?)";
					$stmt=$pdo->prepare($sql);
					$stmt->bindParam(1,$date_start);
					$stmt->bindParam(2,$date_end);
					$stmt->bindParam(3,$request);
					if(!$stmt->execute())
					{
						exit("Приложение не удалось, попробуйте еще раз.".$stmt->errorInfo());
					}
					header('Location: ./leave.php');
				}
			}
			
			require './view/leave_add_html.php';
		}
	}else{

		header('Location: ../public/logout.php');
	}
?>