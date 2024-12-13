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
                <h2 class="subtitle">Панель администратора<span class="is-hidden-mobile">  </span></h2>
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
                <h2 class="has-text-centered subtitle"><i class="fas fa-user"></i> Информация о учащихся</h2>
                <a class="button is-info is-outlined is-small" href="./add_student_form.php">Добавить учащегося</a>
                <?php
                    if(empty($student_list)):
                ?>
                    <p class="has-text-centered">Нет информации о учащихся</p>
                <?php
                    else:
                ?>
                    <hr>
                
                    <table class="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Номер общежития</th>
                                <th>Группа</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                <?php
                        foreach($student_list as $row):
                ?>
                            <tr>
                                <td>
                                    <?=$row['name']?>
                                </td>
                                <td>
                                    <?=$row['dormitory_numb']?>
                                </td>
                                <td>
                                    <?=$row['group_name']?>
                                </td>
                                <td>
                                    <a class="button is-info is-outlined is-small" href="./full_info_student.php?id=<?=$row['id']?>">Подробнее</a>
                                    <a class="button is-danger is-outlined is-small" href="./delete_student.php?id=<?=$row['id']?>">Удалить</a>
                                </td>
                            </tr>
                <?php 
                        endforeach;
                ?>
                    </table>
                    <br>
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
