<?php
header('content-type:text/html;charset=utf-8');
define('APP', 'itcast');
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];
    if ($user_type != "teacher") {
        header("Location: ../$user_type/home.php");
    } else {
        $user_account = $_SESSION['user_account'];
        $user_name = $_SESSION['user_name'];
        $user_id = $_SESSION['user_id'];

        require '../public/_share/_pdo.php';


        $stmt_teacher = $pdo->prepare("SELECT dorm_numb FROM t_teacher WHERE id = ?");
        $stmt_teacher->execute([$user_id]);
        $teacher_info = $stmt_teacher->fetch(PDO::FETCH_ASSOC);
        $teacher_dorm_numb = $teacher_info['dorm_numb'];

    
        $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
        $search_group = isset($_GET['search_group']) ? $_GET['search_group'] : '';
        $search_room = isset($_GET['search_room']) ? $_GET['search_room'] : '';
        $search_violation = isset($_GET['search_violation']) ? $_GET['search_violation'] : '';
        $search_incentive = isset($_GET['search_incentive']) ? $_GET['search_incentive'] : '';
        $search_hobby = isset($_GET['search_hobby']) ? $_GET['search_hobby'] : '';

     
        $sql = "SELECT id, name, dormitory_room, group_name FROM t_student WHERE dormitory_numb = ?";
        $params = [$teacher_dorm_numb];

        if ($search_name) {
            $sql .= " AND name LIKE ?";
            $params[] = "%$search_name%";
        }

        if ($search_group) {
            $sql .= " AND group_name LIKE ?";
            $params[] = "%$search_group%";
        }

        if ($search_room) {
            $sql .= " AND dormitory_room LIKE ?";
            $params[] = "%$search_room%";
        }

        if (!empty($search_violation)) {
            $sql .= " AND id IN (SELECT student_id FROM t_student_violation WHERE detail LIKE ?)";
            $params[] = "%$search_violation%";
        }

        if (!empty($search_incentive)) {
            $sql .= " AND id IN (SELECT student_id FROM t_incentives WHERE detail_inc LIKE ?)";
            $params[] = "%$search_incentive%";
        }

        if (!empty($search_hobby)) {
            $sql .= " AND hobbies LIKE ?";
            $params[] = "%$search_hobby%";
        }

        $sql .= " ORDER BY dormitory_room ASC";

        $stmt_students = $pdo->prepare($sql);
        $stmt_students->execute($params);
        $students = $stmt_students->fetchAll(PDO::FETCH_ASSOC);

    
        $student_ids = array_column($students, 'id');
        $student_leaves = [];
        if (!empty($student_ids)) {
            $in_query = implode(',', array_fill(0, count($student_ids), '?'));
            $stmt_leaves = $pdo->prepare("SELECT student_id, date_start, date_end FROM t_student_leave WHERE student_id IN ($in_query)");
            $stmt_leaves->execute($student_ids);
            while ($row = $stmt_leaves->fetch(PDO::FETCH_ASSOC)) {
                $student_leaves[$row['student_id']][] = $row;
            }
        }

        require './view/home_html.php';
    }
} else {
    header('Location: ../public/logout.php');
}
?>
