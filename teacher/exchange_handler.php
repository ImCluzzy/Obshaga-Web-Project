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
                $response = $_POST['response'];
                if (!empty($exchange_id)) {
                    $sql = "UPDATE t_student_dorm_exchange SET teacher_response = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(1, $response);
                    $stmt->bindParam(2, $exchange_id);
                    if (!$stmt->execute()) {
                        exit("Ошибка при обновлении: " . implode(", ", $stmt->errorInfo()));
                    }
                    header('Location: ./exchange.php');
                }
            } else {
                header('Location: ./exchange.php');
            }
        }
    } else {
        header('Location: ../public/logout.php');
    }
?>
