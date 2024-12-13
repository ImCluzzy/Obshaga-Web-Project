<?php
    header('content-type:text/html;charset=utf-8');
    define('APP','itcast');
    session_start();
    
    if(isset($_SESSION['user_id']) && isset($_SESSION['user_type'])){
        $user_name = $_SESSION['user_name'];
        $user_id = $_SESSION['user_id'];
        $user_type = $_SESSION['user_type'];
        
        if($_POST){
            $old_pwd = $_POST['old_pwd'];
            $new_pwd = $_POST['new_pwd'];
            $check_pwd = $_POST['check_pwd'];
            
            if($new_pwd != $check_pwd){
                $msg = "Новые пароли, введенные дважды, не соответствуют друг другу";
            } else {
                require './_share/_pdo.php';
                
                $sql = "SELECT pwd FROM t_$user_type WHERE id = :user_id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['user_id' => $user_id]);
                $result = $stmt->fetch();
                
                if($result){
                    $pwd = $result['pwd'];
                    
                    if(!password_verify($old_pwd, $pwd)){
                        $msg = "Старый пароль, который вы ввели, неверен";
                    } else if(password_verify($new_pwd, $pwd)){
                        $msg = "Старый пароль не может совпадать с новым паролем.";
                    } else {
                        $hashed_new_pwd = password_hash($new_pwd, PASSWORD_DEFAULT);
                        $sql = "UPDATE t_$user_type SET pwd = :new_pwd WHERE id = :user_id";
                        $stmt = $pdo->prepare($sql);
                        if($stmt->execute(['new_pwd' => $hashed_new_pwd, 'user_id' => $user_id])){
                            echo "<script>alert('измененно');</script>";
                        } else {
                            exit("Ошибка: " . implode(", ", $stmt->errorInfo()));
                        }
                    }
                } else {
                    $msg = "Ошибка получения данных пользователя.";
                }
            }
        }
    } else {
        header("Location: ./logout.php");
    }

    require './view/changepwd_html.php';
?>
