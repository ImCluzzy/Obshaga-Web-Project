<?php
header('content-type:text/html;charset=utf-8');
define('APP', 'itcast');
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];
    if ($user_type != "admin") {
        header("Location: ../$user_type/home.php");
    } else {
        if ($_POST) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $dormitory_numb = $_POST['dormitory_numb'];
            $dormitory_room = $_POST['dormitory_room']; 
            $group_name = $_POST['group_name'];
            $address = $_POST['address'];
            $curator_name = $_POST['curator_name'];
            $curator_phone = $_POST['curator_phone'];
            $parent_names = $_POST['parent_names'];
            $parent_phone = $_POST['parent_phone'];
            $hobbies = $_POST['hobbies'];

            require '../public/_share/_pdo.php';

            $sql = "UPDATE t_student SET 
                    name = ?, 
                    dormitory_numb = ?, 
                    dormitory_room = ?, 
                    group_name = ?, 
                    address = ?, 
                    curator_name = ?, 
                    curator_phone = ?, 
                    parent_names = ?, 
                    parent_phone = ?, 
                    hobbies = ? 
                    WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $dormitory_numb);
            $stmt->bindParam(3, $dormitory_room); 
            $stmt->bindParam(4, $group_name);
            $stmt->bindParam(5, $address);
            $stmt->bindParam(6, $curator_name);
            $stmt->bindParam(7, $curator_phone);
            $stmt->bindParam(8, $parent_names);
            $stmt->bindParam(9, $parent_phone);
            $stmt->bindParam(10, $hobbies);
            $stmt->bindParam(11, $id);

            if ($stmt->execute()) {
                header('Location: ./add_student.php');
                exit;
            } else {
                echo "<script>alert('Не удалось обновить данные студента, пожалуйста, попробуйте еще раз.')</script>";
                require './view/edit_student_form_html.php';
            }
        } else {
            require './view/edit_student_form_html.php';
        }
    }
} else {
    header('Location: ../public/logout.php');
    exit;
}
?>
