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
                <h2 class="subtitle">Информация о студенте<span class="is-hidden-mobile">&emsp;&emsp;</span></h2>
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
                <h2 class="has-text-centered subtitle"><i class="fas fa-user"></i>&thinsp;Полная информация о учащимся</h2>
                <br>
                <table class="table is-striped is-fullwidth">
                    <tbody>
                        <tr>
                            <th>Имя:</th>
                            <td><?=$student_info['name']?></td>
                        </tr>
                        <tr>
                            <th>Номер общежития:</th>
                            <td><?=$student_info['dormitory_numb']?></td>
                        </tr>
                        <tr>
                            <th>Номер комнаты:</th>
                            <td><?=$student_info['dormitory_room']?></td>
                        </tr>
                        <tr>
                            <th>Группа:</th>
                            <td><?=$student_info['group_name']?></td>
                        </tr>
                        <tr>
                            <th>Адрес:</th>
                            <td><?=$student_info['address']?></td>
                        </tr>
                        <tr>
                            <th>ФИО куратора:</th>
                            <td><?=$student_info['curator_name']?></td>
                        </tr>
                        <tr>
                            <th>Номер куратора:</th>
                            <td><?=$student_info['curator_phone']?></td>
                        </tr>
                        <tr>
                            <th>ФИО родителей:</th>
                            <td><?=$student_info['parent_names']?></td>
                        </tr>
                        <tr>
                            <th>Номер родителей:</th>
                            <td><?=$student_info['parent_phone']?></td>
                        </tr>
                        <tr>
                            <th>Увлечения:</th>
                            <td><?=$student_info['hobbies']?></td>
                        </tr>
                        <tr>
                            <th>Общественная работа:</th>
                            <td>
                                <?php
                                foreach ($positions as $position) {
                                    echo htmlspecialchars($position['name']) . ' - ' . htmlspecialchars($position['role']) . '<br>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Поощрения:</th>
                            <td>
                                <?php
                                foreach ($incentives as $incentive) {
                                    echo htmlspecialchars($incentive['detail_inc']) . '<br>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Взыскания:</th>
                            <td>
                                <?php
                                if (!empty($violations)) {
                                    foreach ($violations as $violation) {
                                        echo htmlspecialchars($violation['detail']) . '<br>';
                                    }
                                } else {
                                    echo 'Нет нарушений';
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="has-text-centered">
                    <br>
                    <a class="button is-info" href="edit_student_form.php?id=<?= $student_info['id'] ?>">Редактировать</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require '../public/_share/_footer.php';
?>
