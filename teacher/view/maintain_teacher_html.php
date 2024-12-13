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
        <div class="column is-8">
            <div class="box" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
                <h2 class="has-text-centered subtitle"><i class="fas fa-wrench"></i> Заявления о проблемах</h2>
                <div class="columns">
                    <div class="column">
                        <table style="width: 100%;border-collapse:separate; border-spacing:0px 10px;">
                            <tr>
                                <td>
                                    Общежитие:
                                </td>
                                <td style="padding-left: 15px;">
                                    <?=isset($dormitory_numb)?$dormitory_numb." номер общежития":"Не назначено"?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                    <?php
                        if(empty($maintain_list)):
                    ?>
                        <p class="has-text-centered">Нет записей о заявках</p>
                    <?php
                        else:
                    ?>
                        <table class="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Содержание заявки</th>
                                    <th>Ответ</th>
                                    <th>Действие</th>
                                </tr>
                            </thead>
                    <?php
                            foreach($maintain_list as $row):
                    ?>
                                <tr>
                                    <td>
                                        <?=isset($row['date']) ? date('Y-m-d',strtotime($row['date'])) : 'Дата не указана'?>
                                    </td>
                                    <td>
                                        <?=isset($row['request']) ? $row['request'] : 'Заявка не указана'?>
                                    </td>
                                    <td>
                                        <?=isset($row['admin_response']) ? $row['admin_response'] : 'Ответ администратора не указан'?>
                                    </td>
                                    <td>
    									<?php if ($row['admin_response'] !== 'Устраненно'): ?>
        									<a class="button is-success is-small approve-btn" href="ready.php?id=<?= $row['id'] ?>">Устраненно</a>
    										<?php endif; ?>
									</td>
                                </tr>
                    <?php 
                            endforeach;
                    ?>
                        </table>
                    <?php
                        endif;
                    ?>
            </div>
        </div>
    </div>
</section>

<?php
    require '../public/_share/_footer.php';
?>
