<?php
    header('Content-Type: text/html; charset=utf-8');
    define('APP', 'itcast');
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
        $user_type = $_SESSION['user_type'];
        if ($user_type != "admin") {
            header("Location: ../$user_type/home.php");
        } else {
            $user_account = $_SESSION['user_account'];
            $user_name = $_SESSION['user_name'];
            $user_id = $_SESSION['user_id'];

            if ($_POST) {
                $account = $_POST['account'];
                $pwd = $_POST['pwd'];
                $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
                $name = $_POST['name'];
                $group_name = $_POST['group_name'];
                $address = $_POST['address'];
                $curator_name = $_POST['curator_name'];
                $curator_phone = $_POST['curator_phone'];
                $parent_names = $_POST['parent_names'];
                $parent_phone = $_POST['parent_phone'];
                $hobbies = $_POST['hobbies'];

                require '../public/_share/_pdo.php';

                $check_sql = "SELECT * FROM t_student WHERE account = ?";
                $check_stmt = $pdo->prepare($check_sql);
                $check_stmt->bindParam(1, $account);
                $check_stmt->execute();
                $check_result = $check_stmt->fetch();

                if ($check_result) {
                    echo "<script>alert('Студент с таким аккаунтом уже существует.')</script>";
                    require './view/add_student_form_html.php';
                } else {
                    
                    $sql = "INSERT INTO t_student (account, pwd, name, group_name, address, curator_name, curator_phone, parent_names, parent_phone, hobbies) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(1, $account);
                    $stmt->bindParam(2, $hashed_pwd); 
                    $stmt->bindParam(3, $name);
                    $stmt->bindParam(4, $group_name);
                    $stmt->bindParam(5, $address);
                    $stmt->bindParam(6, $curator_name);
                    $stmt->bindParam(7, $curator_phone);
                    $stmt->bindParam(8, $parent_names);
                    $stmt->bindParam(9, $parent_phone);
                    $stmt->bindParam(10, $hobbies);
                    

                    if ($stmt->execute()) {
                        header('Location: ./add_student.php');
                    } else {
                        echo "<script>alert('Не удалось добавить студента, пожалуйста, попробуйте еще раз.')</script>";
                        require './view/add_student_form_html.php';
                    }
                }
            } else {
                require './view/add_student_form_html.php';
            }
        }
    } else {
        header('Location: ../public/logout.php');
    }
?>
