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
                <h2 class="subtitle">Панель администратора<span class="is-hidden-mobile">&emsp;&emsp;</span></h2>
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
                <h2 class="has-text-centered subtitle"><i class="fas fa-user"></i>&thinsp;Редактирование информации о учащемся</h2>
                <br>
                <form action="./save_student.php" method="POST">
                    <input type="hidden" name="id" value="<?=$student_info['id']?>">
                    <div class="field">
                        <label class="label">Имя</label>
                        <div class="control">
                            <input class="input" type="text" name="name" value="<?=$student_info['name']?>" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Группа</label>
                        <div class="control">
                            <input class="input" type="text" name="group_name" value="<?=$student_info['group_name']?>" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Адрес</label>
                        <div class="control">
                            <input class="input" type="text" name="address" value="<?=$student_info['address']?>" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">ФИО куратора</label>
                        <div class="control">
                            <input class="input" type="text" name="curator_name" value="<?=$student_info['curator_name']?>">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Номер куратора</label>
                        <div class="control">
                            <input class="input" type="text" name="curator_phone" value="<?=$student_info['curator_phone']?>">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">ФИО родителей</label>
                        <div class="control">
                            <input class="input" type="text" name="parent_names" value="<?=$student_info['parent_names']?>">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Номер родителей</label>
                        <div class="control">
                            <input class="input" type="text" name="parent_phone" value="<?=$student_info['parent_phone']?>">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Увлечения</label>
                        <div class="control">
                            <input class="input" type="text" name="hobbies" value="<?=$student_info['hobbies']?>">
                        </div>
                    </div>
                    <div class="field has-text-right">
                        <button class="button is-info" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
require '../public/_share/_footer.php';
?>
