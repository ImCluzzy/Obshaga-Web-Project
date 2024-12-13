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

        $sql = "SELECT name, phone_number, dorm_numb FROM t_teacher";
        $result = $conn->query($sql);

        $teacher_list = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $check_sql = "SELECT number FROM t_dorm WHERE number = ?";
                $check_stmt = $conn->prepare($check_sql);
                $check_stmt->bind_param("i", $row['dorm_numb']);
                $check_stmt->execute();
                $check_result = $check_stmt->get_result();

                if ($check_result->num_rows == 0) {
                    $row['dorm_numb'] = 0;

                    $update_sql = "UPDATE t_teacher SET dorm_numb = 0 WHERE name = ?";
                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->bind_param("s", $row['name']);
                    $update_stmt->execute();
                }

                array_push($teacher_list, $row);
            }
        } else {
            echo "";
        }
        $conn->close();

        require './view/add_teacher_html.php';
    ?>
