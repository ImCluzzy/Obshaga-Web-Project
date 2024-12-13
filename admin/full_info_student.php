<?php
header('content-type:text/html;charset=utf-8');
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

        if ($_GET && isset($_GET['id'])) {
            $student_id = $_GET['id'];

            require '../public/_share/_pdo.php';

          
            $student_sql = "SELECT * FROM t_student WHERE id = ?";
            $student_stmt = $pdo->prepare($student_sql);
            $student_stmt->bindParam(1, $student_id);
            $student_stmt->execute();
            $student_info = $student_stmt->fetch();

            // Получение должности студента из таблицы t_position
            $position_sql = "SELECT name, role FROM t_position WHERE student_id = ?";
            $position_stmt = $pdo->prepare($position_sql);
            $position_stmt->bindParam(1, $student_id);
            $position_stmt->execute();
            $positions = $position_stmt->fetchAll(PDO::FETCH_ASSOC);

            // Получение поощрений студента из таблицы t_incentives
            $incentive_sql = "SELECT detail_inc FROM t_incentives WHERE student_id = ?";
            $incentive_stmt = $pdo->prepare($incentive_sql);
            $incentive_stmt->bindParam(1, $student_id);
            $incentive_stmt->execute();
            $incentives = $incentive_stmt->fetchAll(PDO::FETCH_ASSOC);

            $violation_sql = "SELECT detail FROM t_student_violation WHERE student_id = ?";
            $violation_stmt = $pdo->prepare($violation_sql);
            $violation_stmt->bindParam(1, $student_id);
            $violation_stmt->execute();
            $violations = $violation_stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($student_info) {
                require './view/full_info_student_html.php';
            } else {
                echo "<script>alert('Информация о студенте не найдена.')</script>";
            }
        } else {
            echo "<script>alert('Не удалось получить информацию о студенте.')</script>";
        }
    }
} else {
    header('Location: ../public/logout.php');
}
?>
