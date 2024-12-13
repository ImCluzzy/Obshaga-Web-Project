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
			
			require '../public/_share/_pdo.php';
			
	
			$page_size=5;
			$result=$pdo->query("select count(*) from t_student_leave where student_id=$user_id");
			$count=$result->fetch()[0];
			$max_page=ceil($count/$page_size);
			$page=isset($_GET['page']) ? intval($_GET['page']) : 1;
			$page=$page>$max_page ? $max_page : $page;
			$page=$page < 1 ? 1 : $page;
			$lim=($page -1)*$page_size;
			
			$sql="select * from t_student_leave where student_id=$user_id order by date_start desc limit $lim,$page_size";
			$result=$pdo->query($sql);
			$leave_list=$result->fetchAll();
			require './view/leave_html.php';
		}
	}else{

		header('Location: ../public/logout.php');
	}
?>