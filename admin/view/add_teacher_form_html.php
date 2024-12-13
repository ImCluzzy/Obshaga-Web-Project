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
    var account = document.forms["myForm"]["account"].value;
    var name = document.forms["myForm"]["name"].value;
    var phone_number = document.forms["myForm"]["phone_number"].value;

    var namePattern = /^[A-ZА-Я][a-zа-я]+\s[A-ZА-Я][a-zа-я]+\s[A-ZА-Я][a-zа-я]+$/;
    var phonePattern = /^\+375\d+$/;

    if (account.length > 10) {
        alert("Аккаунт не должен превышать 10 символов");
        return false;
    }

    if (!namePattern.test(name)) {
        alert("Имя должно состоять из 3 слов, каждое с большой буквы");
        return false;
    }

    if (!phonePattern.test(phone_number)) {
        alert("Номер телефона должен соответствовать белорусскому формату: +375 (XX) XXX-XX-XX");
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
					<h2 class="subtitle"><i class="fas fa-user-plus"></i> Добавить воспитателя</h2>
				</div>
                
				<form name="myForm" onsubmit="return validateForm()" method="post" action="./add_teacher_form.php">
					<div class="field">
					  <div class="control">
						<input class="input" type="text" name="account" required="required" maxlength="200" placeholder="Аккаунт">
					  </div>
					</div>
					<div class="field">
					  <div class="control">
						<input class="input" type="password" name="pwd" required="required" maxlength="200" placeholder="Пароль">
					  </div>
					</div>
					<div class="field">
					  <div class="control">
						<input class="input" type="text" name="name" required="required" maxlength="200" placeholder="Имя">
					  </div>
					</div>
					<div class="field">
					  <div class="control">
						<select class="input" name="dorm_numb" required="required">
							<?php
								
								$db = new mysqli('localhost', 'root', '', 'dormitory');

								if ($db->connect_error) {
									die("Connection failed: " . $db->connect_error);
								}

						
								$result = $db->query("SELECT number FROM t_dorm");

								while ($row = $result->fetch_assoc()) {
									echo "<option value='" . $row['number'] . "'>" . $row['number'] . "</option>";
								}

								$db->close();
							?>
						</select>
					  </div>
					</div>
					<div class="field">
					  <div class="control">
						<input class="input" type="text" name="phone_number" required="required" maxlength="13" placeholder="Номер телефона">
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
					<a href="../<?=$user_type?>/add_teacher.php"><i class="fas fa-arrow-left"></i> Назад</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	require '../public/_share/_footer.php';
?>
