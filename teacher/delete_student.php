<?php
    header('content-type:text/html;charset=utf-8');
    define('APP','itcast');
    session_start();

    if(isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
        $user_type = $_SESSION['user_type'];
        if($user_type != "teacher") { 
            header("Location: ../$user_type/home.php");
        } else {
            $user_account = $_SESSION['user_account'];
            $user_name = $_SESSION['user_name'];
            $user_id = $_SESSION['user_id'];

            if($_GET) {
                $student_id = $_GET['id']; 

                require '../public/_share/_pdo.php';

                
                $sql = "UPDATE t_student SET dormitory_numb = null, dormitory_room = null WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(1, $student_id);
                if($stmt->execute()) {
                    header('Location: ./home.php'); 
                } else {
                    echo "<script>alert('Не удалось обновить информацию о студенте. Пожалуйста, попробуйте еще раз.')</script>";
                    require './view/home_html.php'; 
                }
            } else {
                require '. /view/home_html.php'; 
            }
        }
    } else {
        header('Location: ../public/logout.php');
    }
?>
