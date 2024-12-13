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

$sql = "SELECT t_dorm.number, t_dorm.count_places, 
               IFNULL(t_teacher.name, 'Отсутствует') as teacher_name,
               COUNT(t_student.id) AS occupied_places
        FROM t_dorm 
        LEFT JOIN t_teacher ON t_dorm.number = t_teacher.dorm_numb
        LEFT JOIN t_student ON t_dorm.number = t_student.dormitory_numb
        GROUP BY t_dorm.number";
$result = $conn->query($sql);

$dorm_list = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
       
        $row['free_places'] = $row['count_places'] - $row['occupied_places'];
        array_push($dorm_list, $row);
    }
} else {
    echo "";
}
$conn->close();

require './view/add_dorm_html.php';
?>
