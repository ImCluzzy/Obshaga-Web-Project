<?php
header('content-type:text/html;charset=utf-8');
define('APP', 'itcast');
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];
    if ($user_type != "teacher") {
        header("Location: ../$user_type/home.php");
    } else {
        if ($_POST) {
            $id = $_POST['id'];
            $incentives = $_POST['incentives'];
            $positions = $_POST['positions'];

            require '../public/_share/_pdo.php';

            $sql = "UPDATE t_student SET incentives = ?, positions = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $incentives);
            $stmt->bindParam(2, $positions);
            $stmt->bindParam(3, $id);

            if ($stmt->execute()) {
                header('Location: ./home.php');
            } else {
                echo "<script>alert('Не удалось обновить данные студента, пожалуйста, попробуйте еще раз.')</script>";
                require './view/eddit_student_form_html.php';
            }
        } else if ($_GET) {
            $id = $_GET['id'];

            require '../public/_share/_pdo.php';

            $sql = "SELECT * FROM t_student WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $student_info = $stmt->fetch(PDO::FETCH_ASSOC);

            require './view/eddit_student_form_html.php';
        } else {
            echo "<script>alert('Нет данных для обновления.')</script>";
            require './view/eddit_student_form_html.php';
        }
    }
} else {
    header('Location: ../public/logout.php');
}
?>
