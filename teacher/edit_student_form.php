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

        if ($_POST) {
            $id = $_POST['id'];
            $incentives = $_POST['incentives'];
            $positions = $_POST['positions'];
            $action = $_POST['action']; 

            require '../public/_share/_pdo.php';

            $check_sql = "SELECT * FROM t_student WHERE id = ?";
            $check_stmt = $pdo->prepare($check_sql);
            $check_stmt->execute([$id]);
            $student_exists = $check_stmt->fetch();

            if ($student_exists) {
                if ($action === 'save') {
                 
                    $sql = "UPDATE t_student SET incentives = ?, positions = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$incentives, $positions, $id]);

                    if ($stmt) {
                        header('Location: ./list_students.php');
                    } else {
                        echo "<script>alert('Не удалось обновить данные студента, пожалуйста, попробуйте еще раз.')</script>";
                        require './view/edit_student_form_html.php';
                    }
                } elseif ($action === 'add_position') {
                
                    $sql = "SELECT positions FROM t_student WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$id]);
                    $current_positions = $stmt->fetchColumn();

                    if ($current_positions) {
                        
                        $positions_array = explode(',', $current_positions);
                        if (!in_array($positions, $positions_array)) {
                            $positions_array[] = $positions;
                            $new_positions = implode(',', $positions_array);
                        } else {
                            $new_positions = $current_positions; 
                        }
                    } else {
                        $new_positions = $positions;
                    }

                    $update_sql = "UPDATE t_student SET positions = ? WHERE id = ?";
                    $update_stmt = $pdo->prepare($update_sql);
                    $update_stmt->execute([$new_positions, $id]);

                    if ($update_stmt) {
                        header('Location: ./list_students.php');
                    } else {
                        echo "<script>alert('Не удалось обновить данные студента, пожалуйста, попробуйте еще раз.')</script>";
                        require './view/edit_student_form_html.php';
                    }
                }
            } else {
                echo "<script>alert('Студент с указанным идентификатором не найден.')</script>";
                require './view/edit_student_form_html.php';
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
