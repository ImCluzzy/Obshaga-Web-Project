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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_name']) && isset($_POST['role_to_delete'])) {
    $student_name = $_POST['student_name'];
    $role_to_delete = $_POST['role_to_delete'];


    $stmt = $conn->prepare("SELECT id FROM t_student WHERE name = ?");
    $stmt->bind_param("s", $student_name);
    $stmt->execute();
    $stmt->bind_result($student_id);
    $stmt->fetch();
    $stmt->close();

    if ($student_id) {

        $stmt = $conn->prepare("DELETE FROM t_position WHERE name = ? AND student_id = ?");
        $stmt->bind_param("si", $role_to_delete, $student_id);

        if ($stmt->execute()) {
            header('Location: ./home.php');
        } else {
            echo "Ошибка при удалении: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Студент с указанным именем не найден.";
    }
} else {
    echo "Недостаточно данных для удаления.";
}

$conn->close();

?>
