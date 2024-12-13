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


        $sql_exchange = "SELECT * FROM t_student_dorm_exchange WHERE student_id = ? AND teacher_response = 'Утверждено' ORDER BY date DESC LIMIT 1";
        $stmt_exchange = $pdo->prepare($sql_exchange);
        $stmt_exchange->execute([$user_id]);
        $exchange_info = $stmt_exchange->fetch(PDO::FETCH_ASSOC);


        if ($exchange_info) {
            $to_dorm_number = $exchange_info['to_dorm_number'];
            $to_dorm_room = $exchange_info['to_dorm_room'];

            $sql_update_student = "UPDATE t_student SET dormitory_numb = ?, dormitory_room = ? WHERE id = ?";
            $stmt_update_student = $pdo->prepare($sql_update_student);
            $stmt_update_student->execute([$to_dorm_number, $to_dorm_room, $user_id]);

            $sql_update_exchange = "UPDATE t_student_dorm_exchange SET teacher_response = 'Переселен' WHERE id = ?";
            $stmt_update_exchange = $pdo->prepare($sql_update_exchange);
            $stmt_update_exchange->execute([$exchange_info['id']]);
        }

        $sql_incentives = "SELECT detail_inc FROM t_incentives WHERE student_id = ?";
        $stmt_incentives = $pdo->prepare($sql_incentives);
        $stmt_incentives->execute([$user_id]);
        $incentives = $stmt_incentives->fetchAll(PDO::FETCH_COLUMN);


        $sql_violations = "SELECT detail FROM t_student_violation WHERE student_id = ?";
        $stmt_violations = $pdo->prepare($sql_violations);
        $stmt_violations->execute([$user_id]);
        $violations = $stmt_violations->fetchAll(PDO::FETCH_COLUMN);


        $sql_positions = "SELECT name, role FROM t_position WHERE student_id = ?";
        $stmt_positions = $pdo->prepare($sql_positions);
        $stmt_positions->execute([$user_id]);
        $positions = $stmt_positions->fetchAll(PDO::FETCH_ASSOC);


        $sql_student_info = "SELECT * FROM t_student WHERE id = ?";
        $stmt_student_info = $pdo->prepare($sql_student_info);
        $stmt_student_info->execute([$user_id]);
        $student_info_data = $stmt_student_info->fetch(PDO::FETCH_ASSOC);


        $student_info = [
            'incentives' => $incentives,
            'violations' => $violations,
            'positions' => $positions,
            'id' => $student_info_data['id'],
            'account' => $student_info_data['account'],
            'name' => $student_info_data['name'],
            'dormitory_numb' => $student_info_data['dormitory_numb'],
            'dormitory_room' => $student_info_data['dormitory_room'],
            'group_name' => $student_info_data['group_name'],
            'address' => $student_info_data['address'],
            'curator_name' => $student_info_data['curator_name'],
            'curator_phone' => $student_info_data['curator_phone'],
            'parent_names' => $student_info_data['parent_names'],
            'parent_phone' => $student_info_data['parent_phone'],
            'hobbies' => $student_info_data['hobbies'],
            'position_role' => $student_info_data['position_role']

        ];

        require './view/home_html.php';
    }
} else {
    header('Location: ../public/logout.php');
}
?>
