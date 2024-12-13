<?php

	header('content-type:text/html;charset=utf-8');
	$dsn="mysql:host=localhost; port=3306; dbname=dormitory; charset=utf8";
	try{
		$pdo=new PDO($dsn,'root', '');
	}catch(BDOException $e){
		echo $e->getMessage();
	}
?>