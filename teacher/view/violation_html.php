<?php
if(!defined('APP')) die('Ошибка!<br>Невозможно прямой доступ к этой странице');
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
                <h2 class="has-text-centered subtitle"><i class="fas fa-clipboard-list"></i> Взыскания учащихся</h2>
                <div class="buttons">
                    <a class="button is-info is-outlined is-small" href="add_violation.php">Добавить взыскание</a>
                </div>
                <?php
                if (empty($violation_list)):
                    ?>
                    <p class="has-text-centered">Нет записей о нарушениях студентов</p>
                <?php
                else:
                    ?>
                    <table class="table" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Номер учащегося</th>
                            <th>ФИО</th>
                            <th>Взыскание</th>
                            <th>Причина</th>
                            <th>Дата</th>
                            <th>Статус</th>
                        </tr>
                        </thead>
                        <?php
                        foreach ($violation_list as $row):
                            ?>
                            <tr>
                                <td><?= $row['account'] ?></td>
                                <td><?= $row['student_name'] ?></td>
                                <td><?= $row['detail'] ?></td>
                                <td><?= $row['punishment'] ?></td>
                                <td><?= date('d.m.Y', strtotime($row['date'])) ?></td>
                                <?php
                                $teacher_response = $row['teacher_response'];
                                if (empty($teacher_response)):
                                    ?>
                                    <td>
                                        <a class="button is-small is-outlined is-link" onclick="markAsRead(<?= $row['id'] ?>)">Отметить как отработанное</a>
                                    </td>
                                <?php
                                else:
                                    ?>
                                    <td>
                                        <span class="tag is-success is-light">Отработал</span>
                                    </td>
                                <?php
                                endif;
                                ?>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </table>
                    <form id="form" method="post" action="violation.php?page=<?= $page ?>">
                        <input type="hidden" name="id" id="id" />
                    </form>
                    <script>
                        function markAsRead(id) {
                            document.getElementById('id').value = id;
                            document.getElementById('form').submit();
                        }
                    </script>
                    <?php
                    if ($max_page > 1):
                        ?>
                        <br>
                        <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                            <a class="pagination-previous has-background-white" href="./violation.php?page=1">Главная</a>
                            <a class="pagination-previous has-background-white" href="./violation.php?page=<?= $page - 1; ?>"><</a>
                            <ul class="pagination-list">
                                <?php
                                for ($p = 1; $p <= $max_page; $p++):
                                    if ($p == $page):
                                        ?>
                                        <li><a class="pagination-link is-current" href="./violation.php?page=<?= $p ?>"><?= $p ?></a></li>
                                    <?php
                                    else:
                                        ?>
                                        <li><a class="pagination-link has-background-white" href="./violation.php?page=<?= $p ?>"><?= $p ?></a></li>
                                    <?php
                                    endif;
                                endfor;
                                ?>
                            </ul>
                            <a class="pagination-next has-background-white" href="./violation.php?page=<?= $page + 1; ?>">></a>
                            <a class="pagination-next has-background-white" href="./violation.php?page=<?= $max_page; ?>">Конец</a>
                        </nav>
                    <?php
                    endif;
                    ?>
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
