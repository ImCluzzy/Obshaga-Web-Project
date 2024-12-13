<?php
    if(!defined('APP')) die('error!');
?>
<?php
    require '../public/_share/_head.php'
?>

<div class="hero is-info">
    <div class="hero-body">
        <div class="columns is-gapless">
            <div class="column has-text-centered">
                <h1 class="title">Система управления общежитиями<span class="is-hidden-mobile">  </span></h1>
                <h2 class="subtitle">Платформа администратора<span class="is-hidden-mobile">  </span></h2>
            </div>
        </div>
    </div>
</div>

<script>
function validateForm() {
    var name = document.forms["studentForm"]["name"].value;
    var account = document.forms["studentForm"]["account"].value;
    var password = document.forms["studentForm"]["password"].value;
    var dormitory_numb = document.forms["studentForm"]["dormitory_numb"].value;
    var group_name = document.forms["studentForm"]["group_name"].value;
    var curator_phone = document.forms["studentForm"]["curator_phone"].value;
    var parent_phone = document.forms["studentForm"]["parent_phone"].value;

    if (name.length > 200) {
        alert("ФИО студента не должно превышать 200 символов");
        return false;
    }

    if (account.length > 100) {
        alert("Аккаунт не должен превышать 100 символов");
        return false;
    }

    if (password.length < 6) {
        alert("Пароль должен быть не менее 6 символов");
        return false;
    }

    if (dormitory_numb.length > 10) {
        alert("Номер общежития не должен превышать 10 символов");
        return false;
    }

    if (group_name.length > 100) {
        alert("Название группы не должно превышать 100 символов");
        return false;
    }

    if (curator_phone.length > 20) {
        alert("Номер куратора не должен превышать 20 символов");
        return false;
    }

    if (parent_phone.length > 20) {
        alert("Номер родителей не должен превышать 20 символов");
        return false;
    }

    return true;
}
</script>

<section class="section">
    <div class="columns is-centered">
        <div class="column is-two-fifths has-text-centered">
            <div class="box" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
                <div class="field is-centered">
                    <h2 class="subtitle"><i class="fas fa-user"></i> Добавить учащегося</h2>
                </div>

                <form name="studentForm" onsubmit="return validateForm()" method="post" action="./add_student_form.php">
                    <div class="field">
                      <div class="control">
                        <input class="input" type="text" name="name" required="required" maxlength="200" placeholder="ФИО учащегося">
                      </div>
                    </div>
                    <div class="field">
                      <div class="control">
                        <input class="input" type="text" name="account" required="required" maxlength="100" placeholder="Аккаунт">
                      </div>
                    </div>
                    <div class="field">
                      <div class="control">
                        <input class="input" type="password" name="pwd" required="required" minlength="6" placeholder="Пароль">
                      </div>
                    </div>
                    <div class="field">
                      <div class="control">
                        <input class="input" type="text" name="group_name" required="required" maxlength="100" placeholder="Группа">
                      </div>
                    </div>
                    <div class="field">
                      <div class="control">
                        <input class="input" type="text" name="address" placeholder="Адрес">
                      </div>
                    </div>
                    <div class="field">
                      <div class="control">
                        <input class="input" type="text" name="curator_name" placeholder="ФИО куратора">
                      </div>
                    </div>
                    <div class="field">
                      <div class="control">
                        <input class="input" type="text" name="curator_phone" maxlength="20" placeholder="Номер куратора">
                      </div>
                    </div>
                    <div class="field">
                      <div class="control">
                        <input class="input" type="text" name="parent_names" placeholder="ФИО родителей">
                      </div>
                    </div>
                    <div class="field">
                      <div class="control">
                        <input class="input" type="text" name="parent_phone" maxlength="20" placeholder="Номер родителей">
                      </div>
                    </div>
                    <div class="field">
                      <div class="control">
                        <input class="input" type="text" name="hobbies" placeholder="Увлечения">
                      </div>
                    </div>
                    <br>
                      <button type="submit" class="button is-info">
                          <span> </span>
                        <span class="icon">
                          <i class="fas fa-user-plus"></i>
                        </span>
                        <span> Добавить </span>
                      </button>
                </form>
                <br>
                <div class="has-text-centered">
                    <a href="../<?=$user_type?>/add_student.php"><i class="fas fa-arrow-left"></i> Назад</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    require '../public/_share/_footer.php';
?>
