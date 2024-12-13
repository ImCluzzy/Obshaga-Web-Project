<?php
    header('content-type:text/html;charset=utf-8');
    define('APP', 'itcast');
    session_start();

  
    require '../public/_share/_pdo.php';


    $current_date = date('Y-m-d');


    if (isset($_GET['filter'])) {
        $filter = $_GET['filter'];
        

        $teacher_dorm = null;
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $sql_teacher = "SELECT dorm_numb FROM t_teacher WHERE id = ?";
            $stmt_teacher = $pdo->prepare($sql_teacher);
            $stmt_teacher->execute([$user_id]);
            $teacher_dorm = $stmt_teacher->fetchColumn();
        }


        if ($filter == 'active') {
            $sql = "SELECT a.id, a.date_start, a.date_end, a.request, b.account, b.name AS student_name
                    FROM t_student_leave AS a
                    JOIN t_student AS b ON a.student_id = b.id
                    WHERE a.date_start <= ? AND a.date_end >= ? AND b.dormitory_numb = ?
                    ORDER BY a.date_start DESC";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$current_date, $current_date, $teacher_dorm]);
            $leave_list = $stmt->fetchAll();
        }
     
        elseif ($filter == 'inactive') {
            $sql = "SELECT a.id, a.date_start, a.date_end, a.request, b.account, b.name AS student_name
                    FROM t_student_leave AS a
                    JOIN t_student AS b ON a.student_id = b.id
                    WHERE a.date_end < ? AND b.dormitory_numb = ?
                    ORDER BY a.date_start DESC";
        
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$current_date, $teacher_dorm]);
            $leave_list = $stmt->fetchAll();
        }
     
        elseif ($filter == 'future') {
            $sql = "SELECT a.id, a.date_start, a.date_end, a.request, b.account, b.name AS student_name
                    FROM t_student_leave AS a
                    JOIN t_student AS b ON a.student_id = b.id
                    WHERE a.date_start > ? AND b.dormitory_numb = ?
                    ORDER BY a.date_start DESC";
        
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$current_date, $teacher_dorm]);
            $leave_list = $stmt->fetchAll();
        }
  
        else {
            die('Ошибка! Некорректный фильтр');
        }
    }
  
    else {
        $sql = "SELECT a.id, a.date_start, a.date_end, a.request, b.account, b.name AS student_name
                FROM t_student_leave AS a
                JOIN t_student AS b ON a.student_id = b.id
                WHERE b.dormitory_numb = ?
                ORDER BY a.date_start DESC";


        $stmt = $pdo->prepare($sql);
        $stmt->execute([$teacher_dorm]);
        $leave_list = $stmt->fetchAll();
    }

 
    require './view/leave_html.php';
?>
