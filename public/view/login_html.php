<?php
if (!defined('APP')) die('error!<br> не доступно');
require './_share/_head.php';
?>

    <div class="hero is-info">
        <div class="hero-body">
            <div class="columns is-gapless">
                <div class="column is-hidden-mobile is-1"></div>
                <div class="column has-text-centered">
                    <h1 class="title">Система управления общежитием<span class="is-hidden-mobile">&emsp;&emsp;</span></h1>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="columns is-centered">
            <div class="column is-two-fifths has-text-centered">
                <div class="box" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
                    <div class="field is-centered">
                        <h2 class="subtitle"><i class="fas fa-user"></i>&thinsp;Логин пользователя</h2>
                    </div>
                    <form method="post" action="login.php">
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" name="account" value="<?= isset($account) ? $account : '' ?>" required="required" placeholder="номер пользователя">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input" type="password" name="pwd" value="<?= isset($pwd) ? $pwd : '' ?>" required="required" placeholder="пароль">
                            </div>
                        </div>
                        <div class="field is-inline-block">
                            <div class="control">
                                <label class="radio">
                                    <input type="radio" name="type" value="student" checked="checked" onclick="setLoginData('student')">
                                    учащийся&nbsp;
                                </label>
                                <label class="radio">
                                    <input type="radio" name="type" value="teacher" onclick="setLoginData('teacher')">
                                    воспитатель&nbsp;
                                </label>
                                <label class="radio">
                                    <input type="radio" name="type" value="admin" onclick="setLoginData('admin')">
                                    администратор&nbsp;
                                </label>
                            </div>
                        </div>
                        <?php
                        if (isset($msg)) {
                            echo "<br><span class=\"has-text-danger\">$msg</span>";
                        }
                        ?>
                        <br><br>
                        <button type="submit" class="button is-info">
                            <span>&emsp;</span>
                            <span class="icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </span>
                            <span>&thinsp;войти&emsp;</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function setLoginData(type) {
            let accountField = document.querySelector("input[name='account']");
            let pwdField = document.querySelector("input[name='pwd']");

            if (type === 'student') {
                accountField.value = '11'; // Student ID
                pwdField.value = '123123'; // Student Password
            } else if (type === 'teacher') {
                accountField.value = '10'; // Teacher ID
                pwdField.value = '123'; // Teacher Password
            } else if (type === 'admin') {
                accountField.value = '1'; // Admin ID
                pwdField.value = '123'; // Admin Password
            } else {
                accountField.value = '';
                pwdField.value = '';
            }
        }
    </script>

<?php
if (isset($type)) {
    echo "<script>setLoginData('$type');</script>";
}

require './_share/_footer.php';
?>