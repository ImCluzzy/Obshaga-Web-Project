<?php
    header('content-type:text/html;charset=utf-8');
    define('APP','itcast');
    session_start();

    if(isset($_SESSION['user_id'])&&isset($_SESSION['user_type'])){
        $user_type=$_SESSION['user_type'];
        if($user_type!="admin"){
            header("Location: ../$user_type/home.php");
        }else{
            $user_account=$_SESSION['user_account'];
            $user_name=$_SESSION['user_name'];
            $user_id=$_SESSION['user_id'];

            if($_GET){
                $dorm_numb = $_GET['dorm_numb'];

                require '../public/_share/_pdo.php';

                $sql="DELETE FROM t_teacher WHERE dorm_numb = ?";
                $stmt=$pdo->prepare($sql);
                $stmt->bindParam(1, $dorm_numb);
                if($stmt->execute())
                {
                    header('Location: ./add_teacher.php');
                } else {
                    echo "<script>alert('Не удалось удалить воспитателя, пожалуйста, попробуйте еще раз.')</script>";
                    require './view/add_teacher_form_html.php';
                }
            } else {
                require './view/add_teacher_form_html.php';
            }
        }
    }else{
        header('Location: ../public/logout.php');
    }
?>
