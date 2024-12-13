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

        // Получаем информацию о воспитателе и его общежитии
        $sql = "SELECT * FROM t_teacher WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $user_id);
        $stmt->execute();
        $teacher_info = $stmt->fetch();
        $teacher_dorm = $teacher_info['dorm_numb'];

        // Удаляем устаревшие заявки
        $today = date("Y-m-d");
        $sql_delete = "DELETE FROM t_student_leave WHERE date_end < ?";
        $stmt_delete = $pdo->prepare($sql_delete);
        $stmt_delete->bindParam(1, $today);
        $stmt_delete->execute();

        // Получаем параметры поиска
        $search_name = isset($_GET['search_name']) ? '%' . $_GET['search_name'] . '%' : '%%';

        // Получаем все заявки из того же общежития
        $sql = "SELECT a.id, a.student_id, a.date_start, a.date_end, a.request, b.account, b.name AS student_name
                FROM t_student_leave AS a
                JOIN t_student AS b ON a.student_id = b.id
                WHERE b.dormitory_numb = ? AND b.name LIKE ?
                ORDER BY date_start DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $teacher_dorm);
        $stmt->bindParam(2, $search_name);
        $stmt->execute();
        $leave_list = $stmt->fetchAll();

        require './view/leave_html.php';
    }
} else {
    header('Location: ../public/logout.php');
}
?>
