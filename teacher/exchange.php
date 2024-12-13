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
            $exchange_id = $_POST['id'];
            $response = "Отработал";
            if (!empty($exchange_id)) {
                $sql = "UPDATE t_student_dorm_exchange SET teacher_response = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(1, $response);
                $stmt->bindParam(2, $exchange_id);
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

        $sql = "DELETE FROM t_student_dorm_exchange WHERE teacher_response = 'Отработал' AND to_dorm_number = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $teacher_dorm);
        $stmt->execute();

        $sql = "SELECT COUNT(*) FROM t_student_dorm_exchange AS a
                JOIN t_student AS b ON a.student_id = b.id
                WHERE a.to_dorm_number = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $teacher_dorm);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        $page_size = 5;
        $max_page = ceil($count / $page_size);
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $page = $page > $max_page ? $max_page : $page;
        $page = $page < 1 ? 1 : $page;
        $lim = ($page - 1) * $page_size;

  
        $sql = "SELECT a.id, to_dorm_number, to_dorm_room, date, request, teacher_response, b.id as student_id
                FROM t_student_dorm_exchange AS a
                JOIN t_student AS b ON a.student_id = b.id
                WHERE a.to_dorm_number = ?
                ORDER BY date DESC LIMIT ?, ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $teacher_dorm);
        $stmt->bindParam(2, $lim, PDO::PARAM_INT);
        $stmt->bindParam(3, $page_size, PDO::PARAM_INT);
        $stmt->execute();
        $exchange_list = $stmt->fetchAll();

       
        foreach ($exchange_list as &$exchange) {
            $student_id = $exchange['student_id'];
            $sql = "SELECT name FROM t_student WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $student_id);
            $stmt->execute();
            $student_name = $stmt->fetchColumn();
            $exchange['student_name'] = $student_name;
        }
        unset($exchange);

        require './view/exchange_html.php';
    }
} else {
    header('Location: ../public/logout.php');
}
?>
