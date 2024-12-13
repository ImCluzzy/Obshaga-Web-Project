<?php
if (!defined('APP')) die('Ошибка!<br>Невозможно прямой доступ к этой странице');
?>
<?php
require '../public/_share/_head.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dormitory";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

session_start();
$teacher_id = $_SESSION['user_id'];

$sql = "SELECT dorm_numb FROM t_teacher WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $teacher_dorm_numb = $row['dorm_numb'];
} else {
    die('Ошибка! Номер общежития воспитателя не найден.');
}

$students = array();
$sql = "SELECT id, name FROM t_student WHERE dormitory_numb = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $teacher_dorm_numb);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
} else {
   
}

$stmt->close();
$conn->close();
?>

<div class="hero is-info">
    <div class="hero-body">
        <div class="columns is-gapless">
            <div class="column has-text-centered">
                <h1 class="title">Система управления общежитиями<span class="is-hidden-mobile">  </span></h1>
                <h2 class="subtitle">Панель воспитателя<span class="is-hidden-mobile">  </span></h2>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="columns is-centered">
        <div class="column is-two-fifths has-text-centered">
            <div class="box" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
                <div class="field is-centered">
                    <h2 class="subtitle"> Добавление поощрения</h2>
                </div>
                
                <form name="myForm" onsubmit="return validateForm()" method="post" action="./add_incentives_but.php">
                    <div class="field">
                        <div class="control">
                            <input class="input" list="studentsList" name="student_name" placeholder="Выберите учащегося" required>
                            <datalist id="studentsList">
                                <?php foreach ($students as $student): ?>
                                    <option value="<?= $student['name'] ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <textarea class="textarea" name="detail" required="required" placeholder="Детали поощрения"></textarea>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="input" type="date" name="date" required>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="button is-info">
                        <span> </span>
                        <span> Добавить поощрение </span>
                    </button>
                </form>
                <br>
                <div class="has-text-centered">
                    <a href="../teacher/home.php"><i class="fas fa-arrow-left"></i> Назад</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require '../public/_share/_footer.php';
?>
