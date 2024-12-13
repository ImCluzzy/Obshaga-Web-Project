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
        <div class="column is-8">
            <div class="box" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
                <h2 class="has-text-centered subtitle"><i class="fas fa-exchange-alt"></i> Заявки на преселение</h2>
                <div class="columns">
                    <div class="column">
                        
                        <table style="width: 100%;border-collapse:separate; border-spacing:0px 10px;">
                            <tr>
                                <td>
                                    Текущее общежитие:
                                </td>
                                <td style="padding-left: 15px;">
                                    <?= isset($dorm_building) ? $dorm_building . " номер здания" : "Не назначено" ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Текущий номер комнаты:
                                </td>
                                <td style="padding-left: 15px;">
                                    <?= isset($dorm_id) ? $dorm_id . " комната" : "Не назначено" ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="column has-text-centered">
                        <a class="button is-info is-outlined is-small" href="exchange_add.php">
                            Отправить заявку
                        </a>
                    </div>
                </div>
                <div class="columns">
                    <div class="column has-text-centered">
                        <form action="exchange.php" method="POST">
                            <input type="hidden" name="filter" value="Переселен">
                            <button type="submit" class="button is-success is-outlined is-small">
                                Заявки со статусом "Переселен"
                            </button>
                        </form>
                    </div>
                    <div class="column has-text-centered">
                        <form action="exchange.php" method="POST">
                            <input type="hidden" name="filter" value="На рассмотрении">
                            <button type="submit" class="button is-warning is-outlined is-small">
                                Заявки со статусом "На рассмотрении"
                            </button>
                        </form>
                    </div>
                </div>
                <?php
                if (empty($exchange_list)):
                    ?>
                    <p class="has-text-centered">Нет записей о заявках</p>
                    <?php
                else:
                    ?>
                    <table class="table" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Номер общежития</th>
                            <th>Номер комнаты</th>
                            <th>Причина смены</th>
                            <th>Статус</th>
                        </tr>
                        </thead>
                        <?php
                        foreach ($exchange_list as $row):
                            ?>
                            <tr>
                                <td>
                                    <?= $row['to_dorm_number'] ?>
                                </td>
                                <td>
                                    <?= $row['to_dorm_room'] ?>
                                </td>
                                <td>
                                    <?= $row['request'] ?>
                                </td>
                                <td>
                                    <?= $row['teacher_response'] ?>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </table>
                    <?php
                    if ($max_page > 1):
                        ?>
                        <br>
                        <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                            <a class="pagination-previous has-background-white" href="./exchange.php?page=1">Главная</a>
                            <a class="pagination-previous has-background-white" href="./exchange.php?page=<?= $page - 1; ?>"><</a>
                            <ul class="pagination-list">
                                <?php
                                for ($p = 1; $p <= $max_page; $p++):
                                    if ($p == $page):
                                        ?>
                                        <li><a class="pagination-link is-current" href="./exchange.php?page=<?= $p ?>"><?= $p ?></a></li>
                                    <?php
                                    else:
                                        ?>
                                        <li><a class="pagination-link has-background-white" href="./exchange.php?page=<?= $p ?>"><?= $p ?></a></li>
                                    <?php
                                    endif;
                                endfor;
                                ?>
                            </ul>
                            <a class="pagination-next has-background-white" href="./exchange.php?page=<?= $page + 1; ?>">
                            <a class="pagination-next has-background-white" href="./exchange.php?page=<?= $max_page; ?>">Последняя страница</a>
                        </nav>
                    <?php
                    endif;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>

<?php
require '../public/_share/_footer.php';
?>
