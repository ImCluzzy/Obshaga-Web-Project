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
    var number = document.forms["myForm"]["number"].value;
    var count_places = document.forms["myForm"]["count_places"].value;

    if (number.length > 10) {
        alert("Номер общежития не должен превышать 10 символов");
        return false;
    }

    if (isNaN(count_places) || count_places < 1) {
        alert("Количество мест должно быть положительным числом");
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
					<h2 class="subtitle"><i class="fas fa-building"></i> Добавить общежитие</h2>
				</div>
                
				<form name="myForm" onsubmit="return validateForm()" method="post" action="./add_dorm_form.php">
					<div class="field">
					  <div class="control">
						<input class="input" type="text" name="number" required="required" maxlength="200" placeholder="Номер общежития">
					  </div>
					</div>
					<div class="field">
					  <div class="control">
						<input class="input" type="number" name="count_places" required="required" placeholder="Количество мест">
					  </div>
					</div>
					<br>
					  <button type="submit" class="button is-info">
						  <span> </span>
						<span class="icon">
						  <i class="fas fa-building"></i>
						</span>
						<span> Добавить </span>
					  </button>
				</form>
				<br>
				<div class="has-text-centered">
					<a href="../<?=$user_type?>/add_dorm.php"><i class="fas fa-arrow-left"></i> Назад</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	require '../public/_share/_footer.php';
?>
