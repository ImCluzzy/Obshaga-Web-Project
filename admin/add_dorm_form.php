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
             
                $number=$_POST['number'];
                $count_places=$_POST['count_places'];

                require '../public/_share/_pdo.php';

                $check_sql = "SELECT * FROM t_dorm WHERE number = ?";
                $check_stmt = $pdo->prepare($check_sql);
                $check_stmt->bindParam(1, $number);
                $check_stmt->execute();
                $check_result = $check_stmt->fetch();

                if ($check_result) {
                    echo "<script>alert('Общежитие с таким номером уже существует.')</script>";
                    require './view/add_dorm_form_html.php';
                } else {
                    $sql="insert into t_dorm(`number`,`count_places`) values(?,?)";
                    $stmt=$pdo->prepare($sql);
                    $stmt->bindParam(1,$number);
                    $stmt->bindParam(2,$count_places);
                    if($stmt->execute())
                    {
                        header('Location: ./add_dorm.php');
                    } else {
                        echo "<script>alert('Не удалось добавить общежитие, пожалуйста, попробуйте еще раз.')</script>";
                        require './view/add_dorm_form_html.php';
                    }
                }
            } else {
                require './view/add_dorm_form_html.php';
            }
        }
    }else{
        header('Location: ../public/logout.php');
    }
?>
