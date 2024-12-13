<?php
	if(!defined('APP')) die('error!');
?>
<?php

	require './_share/_head.php';
?>

<div class="hero is-info">
	<div class="hero-body">
		<div class="columns is-gapless">
			<div class="column has-text-centered">
				<h1 class="title">Управление общежитием<span class="is-hidden-mobile">&emsp;&emsp;</span></h1>
			</div>
		</div>
	</div>
</div>
<section class="section">
	<div class="columns is-centered">
		<div class="column is-two-fifths has-text-centered">
			<div class="box" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
				<div class="field is-centered">
					<h2 class="subtitle"><i class="fas fa-key"></i>&thinsp;Смена пароля</h2>
				</div>
				<br>
				<form method="post" action="./changepwd.php">
					<div class="field">
					  <div class="control">
						<input class="input" type="password" name="old_pwd" required="required" maxlength="200" placeholder="Старый пароль">
					  </div>
					</div>
					<div class="field">
					  <div class="control">
						<input class="input" type="password" name="new_pwd" required="required" maxlength="200" placeholder="Новый пароль">
					  </div>
					</div>
					<div class="field">
					  <div class="control">
						<input class="input" type="password" name="check_pwd" required="required" maxlength="200" placeholder="Повторите пароль">
					  </div>
					</div>
					<?php
						if(isset($msg)){
							echo "<span class=\"has-text-danger\">$msg</span><br>";
						}
					?>
					<br>
					  <button type="submit" class="button is-info">
						  <span>&emsp;</span>
						<span class="icon">
						  <i class="fas fa-unlock-alt"></i>
						</span>
						<span>&thinsp;ОК&emsp;</span>
					  </button>
				</form>
				<br>
				<div class="has-text-centered">
					<a href="../<?=$user_type?>/home.php"><i class="fas fa-arrow-left"></i>&thinsp;Назад</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	
	if(isset($type)){
		echo "<script>$(\"input[name='type'][value='$type']\").attr('checked','true');</script>";
	}
?>

<?php

	require './_share/_footer.php';
?>