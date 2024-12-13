<?php
    if (!defined('APP')) die('Ошибка!<br>Эта страница не доступна');
?>
<?php
    require '../public/_share/_head.php';
?>
<script src="../lib/jquery.datetimepicker.js" type="text/javascript"></script>
<link href="../lib/jquery.datetimepicker.css" rel="stylesheet"/>
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
        <div class="column is-8">
            <div class="box" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
                <div class="has-text-centered">
                    <a class="subtitle">Заявка на смену общежития</a>
                     <i class="fas fa-chevron-right"></i> Отправить заявку
                </div>
                <br>
                <form method="post" action="exchange_add.php">
                    <table style="width: 100%;border-collapse:separate; border-spacing:0px 10px;">
                        <tr>
                            <td>
                                Имя студента:
                            </td>
                            <td style="padding-left: 15px;">
                                <?=$user_name?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Аккаунт (номер студента):
                            </td>
                            <td style="padding-left: 15px;">
                                <?=$user_account?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Текущее общежитие:
                            </td>
                            <td style="padding-left: 15px;">
                                <?=isset($dorm_building) ? $dorm_building . " номер здания " . $dorm_number . " комната" : "Не назначено"?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Целевое общежитие:
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Здание:
                            </td>
                            <td>
                                <input type="text" class="input" name="building" required="required" maxlength="10" placeholder="Номер целевого здания общежития" value="<?=isset($to_dorm_building) ? $to_dorm_building : ''?>" />
                            </td>
                            <td>
                                <span> номер здания</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Номер комнаты:
                            </td>
                            <td>
                            <select class="input" name="number" required="required">
                                <option value="">Выберите номер комнаты в целевом общежитии</option>
                                <?php
    
                                $room_numbers = [
                                    '201', '202', '203', '204', '205', '206', '207', '208', '209', '210', '211', '212', '213', '214', '215', '216',
                                    '301', '302', '303', '304', '305', '306', '307', '308', '309', '310', '311', '312', '313', '314', '315', '316',
                                    '401', '402', '403', '404', '405', '406', '407', '408', '409', '410', '411', '412', '413', '414', '415', '416',
                                    '501', '502', '503', '504', '505', '506', '507', '508', '509', '510', '511', '512', '513', '514', '515', '516'
                                ];

                                foreach ($room_numbers as $room_number) {
                                  $selected = isset($to_dorm_number) && $to_dorm_number == $room_number ? 'selected' : '';
                                 echo "<option value=\"$room_number\" $selected>$room_number</option>";
                                }
                                ?>
                            </select>

                            </td>
                            <td>
                                <span> комната</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Причина смены общежития:
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <textarea class="textarea" name="request" rows="6" maxlength="200" required="required" placeholder="Пожалуйста, введите причину для смены общежития..."><?=isset($request) ? $request : ''?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="has-text-centered" style="padding-top: 15px;">
                                <input type="submit" class="button is-info" value=" Отправить " />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="has-text-centered" style="padding-top: 10px;">
                                <a href="exchange.php"><i class="fas fa-arrow-left"></i> Вернуться</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
    require '../public/_share/_footer.php';
?>
