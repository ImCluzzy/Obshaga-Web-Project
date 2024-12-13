<?php
header('content-type:text/html;charset=utf-8');
define('APP', 'itcast');
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];
    if ($user_type != "teacher") {
        header("Location: ../$user_type/home.php");
    } else {
        $user_id = $_SESSION['user_id'];

        require '../public/_share/_pdo.php';

        if ($_POST) {
            $violation_id = $_POST['id'];
            $response = "Отработал";
            if (!empty($violation_id)) {
                $sql = "UPDATE t_student_violation SET teacher_response = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(1, $response);
                $stmt->bindParam(2, $violation_id);
                if (!$stmt->execute()) {
                    exit("Отправка не удалась: " . implode(", ", $stmt->errorInfo()));
                }
                header('Location: ./violation.php');
            }
        }

  
        $sql = "SELECT dorm_numb FROM t_teacher WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $user_id);
        $stmt->execute();
        $teacher_info = $stmt->fetch();
        $teacher_dorm = $teacher_info['dorm_numb'];


        $sql = "DELETE FROM t_student_violation WHERE teacher_response = 'Отработал' AND student_id IN (SELECT id FROM t_student WHERE dormitory_numb = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $teacher_dorm);
        $stmt->execute();

        $page_size = 5;
        $sql = "SELECT COUNT(*) FROM t_student_violation AS a
                JOIN t_student AS b ON a.student_id = b.id
                WHERE b.dormitory_numb = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $teacher_dorm);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        $max_page = ceil($count / $page_size);
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $page = $page > $max_page ? $max_page : $page;
        $page = $page < 1 ? 1 : $page;
        $lim = ($page - 1) * $page_size;

        $sql = "SELECT a.id, detail, date, account, teacher_response, punishment, date, b.name as student_name
                FROM t_student_violation AS a
                JOIN t_student AS b ON a.student_id = b.id
                WHERE b.dormitory_numb = ?
                ORDER BY date DESC LIMIT ?, ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $teacher_dorm);
        $stmt->bindParam(2, $lim, PDO::PARAM_INT);
        $stmt->bindParam(3, $page_size, PDO::PARAM_INT);
        $stmt->execute();
        $violation_list = $stmt->fetchAll();

        require './view/violation_html.php';
    }
} else {
    header('Location: ../public/logout.php');
}
?>
