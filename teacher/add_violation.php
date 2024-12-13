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
    if (isset($_POST['student_name']) && isset($_POST['detail']) && isset($_POST['punishment'])) {
        $student_name = $_POST['student_name'];
        $detail = $_POST['detail'];
        $punishment = $_POST['punishment'];

 
        $stmt = $conn->prepare("SELECT id FROM t_student WHERE name = ?");
        $stmt->bind_param("s", $student_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $student_id = $row['id'];

           
            $date = date("Y-m-d");
            $stmt = $conn->prepare("INSERT INTO t_student_violation (student_id, detail, date, punishment) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $student_id, $detail, $date, $punishment);

            if ($stmt->execute()) {
                header('Location: ./violation.php');
            } else {
                echo "Ошибка: " . $stmt->error;
            }
        } else {
            echo "Студент с таким именем не найден.";
        }
    } else {
        echo "Необходимо предоставить информацию о студенте, детали нарушения и наказании.";
    }
} else {
    require './view/add_violation_form.php';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn->close();
}
?>
