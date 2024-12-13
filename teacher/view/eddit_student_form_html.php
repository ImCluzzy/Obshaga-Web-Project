<?php
if (!defined('APP')) die('Ошибка! Непосредственный доступ к этой странице запрещен');
?>

<?php
require '../public/_share/_head.php';
?>

<div class="hero is-info">
    <div class="hero-body">
        <div class="columns is-gapless">
            <div class="column has-text-centered">
                <h1 class="title">Система управления общежитиями<span class="is-hidden-mobile">&emsp;&emsp;</span></h1>
                <h2 class="subtitle">Панель воспитателя<span class="is-hidden-mobile">&emsp;&emsp;</span></h2>
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="columns">
        <div class="column is-2 is-offset-1">
            <?php
            require './_share/_mune.php';
            ?>
        </div>
        <div class="column is-8" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
        <div class="box">
    <h2 class="has-text-centered subtitle"><i class="fas fa-user"></i>&thinsp;Редактирование информации о студенте</h2>
    <br>
    <form action="./save_student.php" method="POST">
        <input type="hidden" name="id" value="<?=$student_info['id']?>">
        <input type="hidden" name="action" id="action" value="save">
        <div class="field">
            <label class="label">Поощрения</label>
            <div class="control">
                <input class="input" type="text" name="incentives" value="<?=$student_info['incentives']?>">
            </div>
        </div>
        <div class="field">
            <label class="label">Должность</label>
            <div class="control">
                <div class="select">
                    <select name="positions">
                        <?php
                        require '../public/_share/_pdo.php';
                        $sql = "SELECT name FROM t_position";
                        $stmt = $pdo->query($sql);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='".$row['name']."'>".$row['name']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="field has-text-right">
            <button class="button is-info" type="submit" onclick="document.getElementById('action').value='save'">Сохранить</button>
            <button class="button is-success" type="submit" onclick="document.getElementById('action').value='add_position'">Добавить должность</button>
        </div>
    </form>
</div>

        </div>
    </div>
</section>
<?php
require '../public/_share/_footer.php';
?>
