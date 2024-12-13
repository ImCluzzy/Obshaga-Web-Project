<?php
if (!defined('APP')) die('Ошибка!<br>Эта страница не доступна');
?>
<?php

require '../public/_share/_head.php';
?>

<div class="hero is-info">
    <div class="hero-body">
        <div class="columns is-gapless">
            <div class="column has-text-centered">
                <h1 class="title">Система управления общежитиями<span class="is-hidden-mobile">  </span></h1>
                <h2 class="subtitle">Платформа учащегося<span class="is-hidden-mobile">  </span></h2>
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
                <p class="has-text-centered"><span>😃</span><span id="helloMsg">Привет!</span><span><?= $student_info['name'] ?></span></p>
                <br>
                <table style="width: 100%;border-collapse:separate; border-spacing:0px 10px;">
                    <tr>
                        <td>ID:</td>
                        <td style="padding-left: 15px;"><?= $student_info['id'] ?></td>
                    </tr>
                    <tr>
                        <td>Аккаунт (номер студента):</td>
                        <td style="padding-left: 15px;"><?= $student_info['account'] ?></td>
                    </tr>
                    <tr>
                        <td>ФИО:</td>
                        <td style="padding-left: 15px;"><?= $student_info['name'] ?></td>
                    </tr>
                    <tr>
                        <td>Номер общежития:</td>
                        <td style="padding-left: 15px;"><?= $student_info['dormitory_numb'] ?></td>
                    </tr>
                    <tr>
                        <td>Номер комнаты:</td>
                        <td style="padding-left: 15px;"><?= $student_info['dormitory_room'] ?></td>
                    </tr>
                    <tr>
                        <td>Группа:</td>
                        <td style="padding-left: 15px;"><?= $student_info['group_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Адрес:</td>
                        <td style="padding-left: 15px;"><?= $student_info['address'] ?></td>
                    </tr>
                    <tr>
                        <td>ФИО куратора:</td>
                        <td style="padding-left: 15px;"><?= $student_info['curator_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Номер телефона куратора:</td>
                        <td style="padding-left: 15px;"><?= $student_info['curator_phone'] ?></td>
                    </tr>
                    <tr>
                        <td>ФИО родителей:</td>
                        <td style="padding-left: 15px;"><?= $student_info['parent_names'] ?></td>
                    </tr>
                    <tr>
                        <td>Номер телефона родителей:</td>
                        <td style="padding-left: 15px;"><?= $student_info['parent_phone'] ?></td>
                    </tr>
                    <tr>
                        <td>Увлечения:</td>
                        <td style="padding-left: 15px;"><?= $student_info['hobbies'] ?></td>
                    </tr>
                    <tr>
                        <td>Поощрения:</td>
                        <td style="padding-left: 15px;">
                            <?php if (!empty($student_info['incentives'])): ?>
                                <?php foreach ($student_info['incentives'] as $incentive): ?>
                                    <?= $incentive ?><br>
                                <?php endforeach; ?>
                            <?php else: ?>
                                Нет информации
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Взыскания:</td>
                        <td style="padding-left: 15px;">
                            <?php if (!empty($student_info['violations'])): ?>
                                <?php foreach ($student_info['violations'] as $violation): ?>
                                    <?= $violation ?><br>
                                <?php endforeach; ?>
                            <?php else: ?>
                                Нет информации
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Общественная работа в общежитии:</td>
                        <td style="padding-left: 15px;">
                            <?php if (!empty($student_info['positions'])): ?>
                                <?php foreach ($student_info['positions'] as $position): ?>
                                    <?= $position['name'] ?> - <?= $position['role'] ?><br>
                                <?php endforeach; ?>
                            <?php else: ?>
                                Нет информации
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <br>
                <div class="has-text-right">
                    <a class="button is-info is-outlined is-small" href="../public/changepwd.php">Изменить пароль</a>
                </div>
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
