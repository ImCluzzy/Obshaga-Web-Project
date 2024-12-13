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
                <h1 class="title">Система управления общежитиями<span class="is-hidden-mobile">  </span></h1>
                <h2 class="subtitle">Панель воспитателя<span class="is-hidden-mobile">  </span></h2>
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
                <h2 class="has-text-centered subtitle"><i class="fas fa-user"></i> Личная информация</h2>
                <p class="has-text-centered"><span>😃</span><span id="helloMsg">Привет!</span><span><?=$user_name?></span></p>
                <br>
                <div class="has-text-centered">
                    <a class="button is-info is-outlined is-small" href="../public/changepwd.php">Изменить пароль</a>
                </div>
                <br>
                <form method="GET" action="" class="search-form">
                    <div class="columns is-multiline">
                        <div class="column is-one-third">
                            <div class="search-field">
                                <label for="search_name">ФИО:</label>
                                <input class="input is-small" type="text" id="search_name" name="search_name" placeholder="ФИО" value="<?= htmlspecialchars($search_name) ?>">
                            </div>
                        </div>
                     <div class="column is-one-third">
                            <div class="search-field">
                                <label for="search_group">Группа:</label>
                                <input class="input is-small" type="text" id="search_group" name="search_group" placeholder="Группа" value="<?= htmlspecialchars($search_group) ?>">
                            </div>
                        </div>
                        <div class="column is-one-third">
                            <div class="search-field">
                                <label for="search_room">Комната:</label>
                                <input class="input is-small" type="text" id="search_room" name="search_room" placeholder="Комната" value="<?= htmlspecialchars($search_room) ?>">
                         </div>
                        </div>
                        <div class="column is-one-third">
                            <div class="search-field">
                                <label for="search_violation">Нарушение:</label>
                                <input class="input is-small" type="text" id="search_violation" name="search_violation" placeholder="Нарушение" value="<?= htmlspecialchars($search_violation) ?>">
                            </div>
                        </div>
                        <div class="column is-one-third">
                            <div class="search-field">
                                <label for="search_incentive">Поощрение:</label>
                                <input class="input is-small" type="text" id="search_incentive" name="search_incentive" placeholder="Поощрение" value="<?= htmlspecialchars($search_incentive) ?>">
                            </div>
                        </div>
                        <div class="column is-one-third">
                         <div class="search-field">
                                <label for="search_hobby">Интерес:</label>
                                <input class="input is-small" type="text" id="search_hobby" name="search_hobby" placeholder="Интерес" value="<?= htmlspecialchars($search_hobby) ?>">
                         </div>
                        </div>
                    </div>
                    <div class="search-field">
                        <button class="button is-info is-small" type="submit">Поиск</button>
                    </div>
                </form>

                <br>    
                <?php if (empty($students)): ?>
                    <p class="has-text-centered">Нет информации о учащихся</p>
                <?php else: ?>
                    <hr>
                    <h2 class="subtitle has-text-centered"><i class="fas fa-chalkboard-teacher"></i>учащиеся в вашем общежитии</h2>
                    <table class="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ФИО</th>
                                <th>Номер комнаты</th>
                                <th>Название группы</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $student):
                                $has_leave = false;
                                if (isset($student_leaves[$student['id']])) {
                                    foreach ($student_leaves[$student['id']] as $leave) {
                                        $date_start = strtotime($leave['date_start']);
                                        $date_end = strtotime($leave['date_end']);
                                        $now = time();
                                        if ($date_start <= $now && $date_end >= $now) {
                                            $has_leave = true;
                                            break;
                                        }
                                    }
                                }
                                $name_class = $has_leave ? 'has-text-danger' : 'has-text-success';
                            ?>
                                <tr>
                                    <td class="<?= $name_class ?>"><?= $student['name'] ?></td>
                                    <td><?= $student['dormitory_room'] ?></td>
                                    <td><?= $student['group_name'] ?></td>
                                    <td>
                                        <a class="button is-info is-outlined is-small" href="./full_info_student_teacher.php?id=<?= $student['id'] ?>">Подробнее</a>
                                        <a class="button is-danger is-outlined is-small" href="./delete_student.php?id=<?= $student['id'] ?>">Выселить</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <br>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    window.onload = function () {
   
        now = new Date(), hour = now.getHours()
        if (hour < 6) { $('#helloMsg').text("Доброй ночи,") }
        else if (hour < 9) { $('#helloMsg').text("Доброе утро!") }
        else if (hour < 12) { $('#helloMsg').text("Добрый день!") }
        else if (hour < 14) { $('#helloMsg').text("Добрый день!") }
        else if (hour < 17) { $('#helloMsg').text("Добрый день!") }
        else if (hour < 19) { $('#helloMsg').text("Добрый вечер!") }
        else { $('#helloMsg').text("Доброй ночи,") }
    }
</script>
<?php
require '../public/_share/_footer.php';
?>
