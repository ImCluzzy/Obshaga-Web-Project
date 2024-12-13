<?php
    header('content-type:text/html;charset=utf-8');
    define('APP', 'itcast');
    session_start();
    
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'teacher') {
        require '../public/_share/_pdo.php';

        $user_id = $_SESSION['user_id'];
        
        $stmt = $pdo->prepare("SELECT dorm_numb FROM t_teacher WHERE id = ?");
        $stmt->execute([$user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $dormitory_numb = $result['dorm_numb'];
            
            $stmt = $pdo->prepare("SELECT * FROM t_dorm_maintain WHERE dorm_number = ?");
            $stmt->execute([$dormitory_numb]);
            $maintain_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

            require './view/maintain_teacher_html.php';
        } else {
            echo "Ошибка: Не удалось получить информацию о номере общежития учителя.";
        }
    } else {
        header('Location: ../public/logout.php');
    }
?>
