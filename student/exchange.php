<?php
header('content-type:text/html;charset=utf-8');
define('APP', 'itcast');
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];
    if ($user_type != "student") {
        header("Location: ../$user_type/home.php");
    } else {
        $user_account = $_SESSION['user_account'];
        $user_name = $_SESSION['user_name'];
        $user_id = $_SESSION['user_id'];

        require '../public/_share/_pdo.php';


        $stmt_student = $pdo->prepare("SELECT dormitory_numb, dormitory_room FROM t_student WHERE id = ?");
        $stmt_student->execute([$user_id]);
        $student_info = $stmt_student->fetch();
        $dorm_building = $student_info['dormitory_numb'];
        $dorm_id = $student_info['dormitory_room'];

        $page_size = 5;
        $result = $pdo->prepare("SELECT COUNT(*) FROM t_student_dorm_exchange WHERE student_id = ?");
        $result->execute([$user_id]);
        $count = $result->fetchColumn();
        $max_page = ceil($count / $page_size);
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $page = $page > $max_page ? $max_page : $page;
        $page = $page < 1 ? 1 : $page;
        $lim = ($page - 1) * $page_size;


        $stmt_exchange = $pdo->prepare("SELECT to_dorm_number, to_dorm_room, request, teacher_response FROM t_student_dorm_exchange WHERE student_id = ? ORDER BY date DESC LIMIT $lim, $page_size");
        $stmt_exchange->execute([$user_id]);
        $exchange_list = $stmt_exchange->fetchAll();


        if (isset($_POST['filter'])) {
            $status = $_POST['filter'];
            if ($status == 'На рассмотрении') {
       
                $exchange_list = array_filter($exchange_list, function ($row) {
                    return $row['teacher_response'] == 'На рассмотрении';
                });
            } elseif ($status == 'Переселен') {
 
                $exchange_list = array_filter($exchange_list, function ($row) {
                    return $row['teacher_response'] == 'Переселен';
                });
            }
        }

        require './view/exchange_html.php';
    }
} else {
    header('Location: ../public/logout.php');
}
?>
