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
    if (isset($_POST['student_name']) && isset($_POST['detail']) && isset($_POST['date'])) {
        $student_name = $_POST['student_name'];
        $detail = $_POST['detail'];
        $date = $_POST['date'];

     
        $stmt = $conn->prepare("SELECT id FROM t_student WHERE name = ?");
        $stmt->bind_param("s", $student_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $student_id = $row['id'];

           
            $stmt = $conn->prepare("INSERT INTO t_incentives (student_id, detail_inc, date) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $student_id, $detail, $date);

            if ($stmt->execute()) {
                header('Location: ./home.php');
            } else {
                echo "Ошибка: " . $stmt->error;
            }
        } else {
            echo "Студент с таким именем не найден.";
        }
    } else {
      
    }
} else {
    require './view/add_incentive_html.php';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn->close();
}
?>
