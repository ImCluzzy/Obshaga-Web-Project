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
        <div class="column is-8">
            <div class="box" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
                <h2 class="has-text-centered subtitle"><i class="fas fa-suitcase-rolling"></i> Учащиеся, выбывшие из общежития</h2>

                <?php
                    $search_name = isset($_GET['search_name']) ? htmlspecialchars($_GET['search_name']) : '';
                ?>
                <?php if (!isset($_GET['filter'])): ?>
                <form method="GET" action="" class="has-text-centered">
                    <div class="field has-addons">
                        <div class="control">
                            <input class="input is-small" type="text" name="search_name" placeholder="Имя" value="<?= $search_name ?>">
                        </div>
                        <div class="control">
                            <button class="button is-info is-small" type="submit">Поиск</button>
                        </div>
                    </div>
                </form>
                <?php endif; ?>

                <div class="buttons has-addons is-centered">
                    <a href="./filter_leave.php?filter=active&search_name=<?= $search_name ?>" class="button <?= ($_GET['filter'] ?? '') === 'active' ? 'is-info' : '' ?>">Активные</a>
                    <a href="./filter_leave.php?filter=inactive&search_name=<?= $search_name ?>" class="button <?= ($_GET['filter'] ?? '') === 'inactive' ? 'is-info' : '' ?>">Неактивные</a>
                    <a href="./filter_leave.php?filter=future&search_name=<?= $search_name ?>" class="button <?= ($_GET['filter'] ?? '') === 'future' ? 'is-info' : '' ?>">Будущие</a>
                </div>
                
                <?php
                    if(empty($leave_list)):
                ?>
                    <p class="has-text-centered">Нет заявок от студентов</p>
                <?php
                    else:
                ?>
                    <table class="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Номер учащегося</th>
                                <th>ФИО</th>
                                <th>Время начала</th>
                                <th>Время возвращения</th>
                                <th>Причина</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                        foreach ($leave_list as $row):
                ?>
                            <tr>
                                <td><?= htmlspecialchars($row['account']) ?></td>
                                <td>
                                    <?= htmlspecialchars($row['student_name']) ?>
                                </td>
                                <td><?= date('Y-m-d H:i', strtotime($row['date_start'])) ?></td>
                                <td><?= date('Y-m-d H:i', strtotime($row['date_end'])) ?></td>
                                <td><?= htmlspecialchars($row['request']) ?></td>
                            </tr>
                <?php 
                        endforeach;
                ?>
                        </tbody>
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
