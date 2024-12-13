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

            if($_POST){
                $account=$_POST['account'];
                $pwd=$_POST['pwd'];
                $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
                $name=$_POST['name'];
                $dorm_numb=$_POST['dorm_numb'];
                $phone_number=$_POST['phone_number'];

                require '../public/_share/_pdo.php';

                $check_sql = "SELECT * FROM t_teacher WHERE dorm_numb = ?";
                $check_stmt = $pdo->prepare($check_sql);
                $check_stmt->bindParam(1, $dorm_numb);
                $check_stmt->execute();
                $check_result = $check_stmt->fetch();

                if ($check_result) {
                    echo "<script>alert('Учитель с таким номером общежития уже существует.')</script>";
                    require './view/add_teacher_form_html.php';
                } else {
                    $sql="insert into t_teacher(`account`,`pwd`,`name`,`dorm_numb`,`phone_number`) values(?,?,?,?,?)";
                    $stmt=$pdo->prepare($sql);
                    $stmt->bindParam(1,$account);
                    $stmt->bindParam(2,$hashed_pwd);
                    $stmt->bindParam(3,$name);
                    $stmt->bindParam(4,$dorm_numb);
                    $stmt->bindParam(5,$phone_number);
                    if($stmt->execute())
                    {
                        header('Location: ./add_teacher.php');
                    } else {
                        echo "<script>alert('Не удалось добавить учителя, пожалуйста, попробуйте еще раз.')</script>";
                        require './view/add_teacher_form_html.php';
                    }
                }
            } else {
                require './view/add_teacher_form_html.php';
            }
        }
    }else{
        header('Location: ../public/logout.php');
    }   
?>
