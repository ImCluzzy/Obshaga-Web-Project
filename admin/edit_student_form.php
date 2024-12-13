<?php
    header('content-type:text/html;charset=utf-8');
    define('APP', 'itcast');
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
        $user_type = $_SESSION['user_type'];
        if ($user_type != "admin") {
            header("Location: ../$user_type/home.php");
        } else {
            $user_account = $_SESSION['user_account'];
            $user_name = $_SESSION['user_name'];
            $user_id = $_SESSION['user_id'];

            if ($_POST) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $incentives = $_POST['incentives'];
                $violations = $_POST['violations'];
                $group_name = $_POST['group_name'];
                $address = $_POST['address'];
                $curator_name = $_POST['curator_name'];
                $curator_phone = $_POST['curator_phone'];
                $parent_names = $_POST['parent_names'];
                $parent_phone = $_POST['parent_phone'];
                $hobbies = $_POST['hobbies'];
                $positions = $_POST['positions'];

                require '../public/_share/_pdo.php';

                $sql = "UPDATE t_student SET 
                        name = ?, 
                        incentives = ?, 
                        violations = ?, 
                        group_name = ?, 
                        address = ?, 
                        curator_name = ?, 
                        curator_phone = ?, 
                        parent_names = ?, 
                        parent_phone = ?, 
                        hobbies = ?, 
                        positions = ?
                        WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $name, 
                    $incentives, 
                    $violations, 
                    $group_name, 
                    $address, 
                    $curator_name, 
                    $curator_phone, 
                    $parent_names, 
                    $parent_phone, 
                    $hobbies, 
                    $positions, 
                    $id
                ]);

                if ($stmt) {
                    header('Location: ./list_students.php');
                } else {
                    echo "<script>alert('Не удалось обновить данные студента, пожалуйста, попробуйте еще раз.')</script>";
                    
                    $sql = "SELECT * FROM t_student WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$id]);
                    $student_info = $stmt->fetch(PDO::FETCH_ASSOC);

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
                require './view/edit_student_form_html.php';
            }
        }
    } else {
    header('Location: ../public/logout.php');
}
?>
