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

        $stmt = $pdo->prepare("SELECT dormitory_room, dormitory_numb FROM t_student WHERE id = ?");
        $stmt->execute([$user_id]);
        $student_info = $stmt->fetch();

        $dorm_building = $student_info['dormitory_numb'];
        $dorm_number = $student_info['dormitory_room'];

        if ($_POST) {
            $to_dorm_building = $_POST['building'];
            $to_dorm_number = $_POST['number'];
            $request = $_POST['request'];

           
            $sql_count_students = "SELECT COUNT(*) as count_students FROM t_student WHERE dormitory_numb = ? AND dormitory_room = ?";
            $stmt_count_students = $pdo->prepare($sql_count_students);
            $stmt_count_students->execute([$to_dorm_building, $to_dorm_number]);
            $result_count_students = $stmt_count_students->fetch();

            if ($result_count_students['count_students'] >= 4) {
                echo "<script>alert('Комната переполнена. Выберите другую комнату.')</script>";
            } else {
                
                if ($to_dorm_building == $dorm_building && $to_dorm_number == $dorm_number) {
                    echo "<script>alert('Вы уже в этой комнате')</script>";
                } else {
                    $sql = "SELECT id FROM t_dorm WHERE number = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$to_dorm_building]);
                    $row = $stmt->fetch();

                    if (!$row) {
                        echo "<script>alert('Целевое общежитие не существует, пожалуйста, проверьте.')</script>";
                    } else {
                        $to_dorm_id = $row['id'];
                        $today_date = date('Y-m-d');
                        $teacher_response = 'На рассмотрении';

                        $sql_insert_exchange = "INSERT INTO t_student_dorm_exchange (student_id, to_dorm_number, to_dorm_room, date, request, teacher_response) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt_insert_exchange = $pdo->prepare($sql_insert_exchange);

                        if (!$stmt_insert_exchange->execute([$user_id, $to_dorm_building, $to_dorm_number, $today_date, $request, $teacher_response])) {
                            exit("Не удалось подать заявку, пожалуйста, попробуйте еще раз." . $stmt_insert_exchange->errorInfo());
                        }

                        header('Location: ./exchange.php');
                        exit;
                    }
                }
            }
        }

        require './view/exchange_add_html.php';
    }
} else {
    header('Location: ../public/logout.php');
}
?>
