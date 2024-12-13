<?php

require '../public/_share/_pdo.php';


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    
    $id = htmlspecialchars($_GET['id']);

 
    $sql = "UPDATE t_dorm_maintain SET admin_response = 'Устраненно' WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
} else {
   
    echo "Ошибка: ID записи не указан";
}
?>
