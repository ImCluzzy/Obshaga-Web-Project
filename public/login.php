<?php
header('Content-Type: text/html; charset=utf-8');
define('APP', 'itcast');
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];
    header("Location: ../$user_type/home.php");
}

if ($_POST) {
    require './_share/_pdo.php';
    $account = $_POST['account'];
    $pwd = $_POST['pwd'];
    $type = $_POST['type'];

    if (!empty($account) && !empty($pwd) && !empty($type)) {
        $sql = "SELECT * FROM t_$type WHERE account=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$account]);
        $row = $stmt->fetch();

        if ($row) {
            $hashed_pwd = $row['pwd'];
            if (password_verify($pwd, $hashed_pwd)) {
                $id = $row['id'];
                $name = $row['name'];

                $_SESSION['user_id'] = $id;
                $_SESSION['user_account'] = $account;
                $_SESSION['user_type'] = $type;
                $_SESSION['user_name'] = $name;

                header("Location: ../$type/home.php");
                exit;
            } else {
                $msg = "Введен неправильный пароль";
            }
        } else {
            $msg = "Введен неправильный логин";
        }
    } else {
        $msg = "Пожалуйста, заполните все поля";
    }
}

require './view/login_html.php';
?>