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
                $number = $_GET['number'];

                require '../public/_share/_pdo.php';

                $sql="DELETE FROM t_dorm WHERE number = ?";
                $stmt=$pdo->prepare($sql);
                $stmt->bindParam(1, $number);
                if($stmt->execute())
                {
                    header('Location: ./add_dorm.php');
                } else {
                    echo "<script>alert('Не удалось удалить общежитие, пожалуйста, попробуйте еще раз.')</script>";
                    require './view/add_dorm_form_html.php';
                }
            } else {
                require './view/add_dorm_form_html.php';
            }
        }
    }else{
        header('Location: ../public/logout.php');
    }
?>
