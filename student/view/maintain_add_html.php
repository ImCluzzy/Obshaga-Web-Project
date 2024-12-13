<?php
	if(!defined('APP')) die('Ошибка!<br>Эта страница не доступна');
?>
<?php
	require '../public/_share/_head.php';
?>

<script src="../lib/jquery.datetimepicker.js" type="text/javascript"></script>
<link href="../lib/jquery.datetimepicker.css" rel="stylesheet"/>
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
				<div class="has-text-centered">
					<a class="subtitle">Сообщить о проблеме</a>
					 <i class="fas fa-chevron-right"></i> Отправить заявку
				</div>
				<br>
				<form method="POST" action="./send_maintain.php">
					<table style="width: 100%;border-collapse:separate; border-spacing:0px 10px;">
						<tr>
							<td>
								Общежитие:
							</td>
							<td style="padding-left: 15px;">
								<?=isset($dorm_numb)?$dorm_numb." номер здания":"Не назначено"?>
							</td>
						</tr>
						<tr>
							<td>
								Номер комнаты:
							</td>
							<td style="padding-left: 15px;">
								<?=isset($dorm_room)?$dorm_room." комната":"Не назначено"?>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								Содержание заявки:
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<textarea class="textarea" name="request" rows="6" maxlength="200" required="required" placeholder="Пожалуйста, введите содержание заявки..."></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="has-text-centered"  style="padding-top: 15px;">
								<input type="submit" class="button is-info" value=" Отправить " />
							</td>
						</tr>
						<tr>
							<td colspan="2" class="has-text-centered"  style="padding-top: 10px;">
								<a href="maintain.php"><i class="fas fa-arrow-left"></i> Вернуться</a>
							</td>
						</tr>
						<input type="hidden" name="dorm_numb" value="<?= isset($dorm_numb) ? $dorm_numb : '' ?>">
   						<input type="hidden" name="dorm_room" value="<?= isset($dorm_room) ? $dorm_room : '' ?>">
						<input type="hidden" name="student_id" value="<?= isset($user_id) ? $user_id : '' ?>">
					</table>
				</form>
			</div>
		</div>
	</div>
</section>

<?php
	require '../public/_share/_footer.php';
?>
