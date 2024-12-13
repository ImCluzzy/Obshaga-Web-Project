<?php
    if(!defined('APP')) die('Ошибка! Непосредственный доступ к этой странице запрещен');
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
        <div class="column is-8">
            <div class="box" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
                <h2 class="has-text-centered subtitle"><i class="fas fa-exchange-alt"></i> Смена общежития учащимися</h2>
                    <?php
                        if(empty($exchange_list)):
                    ?>
                        <p class="has-text-centered">Нет заявок от учащихся</p>
                    <?php
                        else:
                    ?>
                        <table class="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>ФИО учащегося</th>
                                    <th>Целевое общежитие</th>
                                    <th>Целевая комната</th>
                                    <th>Дата заявки</th>
                                    <th>Причина</th>
                                    <th>Ответ</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                    <?php
                            foreach($exchange_list as $row):
                    ?>
                                <tr>
                                    <td>
                                        <a href="./full_info_student_teacher.php?id=<?= htmlspecialchars($row['student_id']) ?>">
                                            <?=$row['student_name']?>
                                        </a>
                                    </td>
                                    <td>
                                        <?=$row['to_dorm_number']?>
                                    </td>
                                    <td>
                                        <?=$row['to_dorm_room']?>
                                    </td>
                                    <td>
                                        <?=date('Y-m-d',strtotime($row['date']))?>
                                    </td>
                                    <td>
                                        <?=$row['request']?>
                                    </td>
                                    <td>
                                        <?=$row['teacher_response']?>
                                    </td>
                                    <td class="field has-addons">
                                        <?php if($row['teacher_response'] !== "Переселен"): ?>
    									    <p class="control">
    										    <a  onclick="approveRequest(<?=$row['id']?>)" class="button is-info is-outlined is-small" href="#">Утвердить</a>
    									    </p>
    									    <p class="control">
    										    <a onclick="rejectRequest(<?=$row['id']?>)" class="button is-danger is-outlined is-small" href="#">Отказать</a>
    									    </p>
                                        <?php endif; ?>
								    </td>
                                </tr>
                    <?php 
                            endforeach;
                    ?>
                        </table>
                        <form id="form" method="post" action="exchange_handler.php">
            
                            <input type="hidden" name="id" id="id" />
                            <input type="hidden" name="response" id="response" />
                        </form>
                        <script>
                            function approveRequest(id){
                                    $("#id").val(id);
                                    $("#response").val("Утверждено"); 
									$("form").attr("action", "exchange_handler.php");
                                    $("form").submit();
                            }
                            function rejectRequest(id){
                                    $("#id").val(id);
                                    $("#response").val("Отказано"); 
									$("form").attr("action", "exchange_handler.php"); 
                                    $("form").submit();
                            }
                        </script>
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
