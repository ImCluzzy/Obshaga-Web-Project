<?php
    require '../public/_share/_pdo.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['dorm_numb']) && isset($_POST['dorm_room'])) {
            $dorm_numb = $_POST['dorm_numb'];
            $dorm_room = $_POST['dorm_room'];
            $request = $_POST['request'];
            $student_id = $_POST['student_id'];
            
            $date = date("Y-m-d");
            
            $sql = "INSERT INTO t_dorm_maintain (dorm_number, room, request, admin_response, date, student_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(1, $dorm_numb);
            $stmt->bindParam(2, $dorm_room);
            $stmt->bindParam(3, $request);
            $stmt->bindValue(4, 'на расмотрении');
            $stmt->bindParam(5, $date);
            $stmt->bindParam(6, $student_id); 
            
            if ($stmt->execute()) {
                header('Location: ./maintain.php');
                exit();
            } else {
                exit("Ошибка при выполнении запроса: " . $stmt->errorInfo()[2]);
            }
        } else {
            header('Location: ./maintain_add.php');
            exit();
        }
    } else {
        header('Location: ../index.php');
        exit();
    }
?>
