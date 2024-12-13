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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['role']) && isset($_POST['student_name'])) {
        $name = $_POST['name'];
        $role = $_POST['role'];
        $student_name = $_POST['student_name'];

        $stmt = $conn->prepare("SELECT id FROM t_student WHERE name = ?");
        $stmt->bind_param("s", $student_name);
        $stmt->execute();
        $stmt->bind_result($student_id);
        $stmt->fetch();
        $stmt->close();

        if ($student_id) {
           
            $stmt = $conn->prepare("INSERT INTO t_position (name, role, student_id) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $name, $role, $student_id);

            if ($stmt->execute()) {
                header('Location: ./home.php');
            } else {
                echo "Ошибка: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Студент с указанным именем не найден.";
        }
    } else {
        echo "Необходимо предоставить информацию о должности, роли и имени студента.";
    }
} else {
    require './view/add_position_html.php';
}
