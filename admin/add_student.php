<?php
    define('APP', true);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dormitory";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    $sql = "SELECT id, name, dormitory_numb, group_name FROM t_student";
    $result = $conn->query($sql);

    $student_list = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $check_sql = "SELECT number FROM t_dorm WHERE number = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param("i", $row['dormitory_numb']);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows == 0) {
                $row['dormitory_numb'] = 0;

                $update_sql = "UPDATE t_student SET dormitory_numb = 0 WHERE id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("i", $row['id']);
                $update_stmt->execute();
            }

            array_push($student_list, $row);
        }
    } else {
        
    $conn->close();
    }
    require './view/add_student_html.php';
    
?>
