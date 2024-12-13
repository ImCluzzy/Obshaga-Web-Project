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
					<a class="subtitle">Отправить заявку</a>
				</div>
				<br>
				<form method="post" action="leave_add.php">
					<table style="width: 100%;border-collapse:separate; border-spacing:0px 10px;">
						<tr>
							<td>
								Имя студента:
							</td>
							<td style="padding-left: 15px;">
								<?=$user_name?>
							</td>
						</tr>
						<tr>
							<td>
								Аккаунт (номер студента):
							</td>
							<td style="padding-left: 15px;">
								<?=$user_account?>
							</td>
						</tr>
						<tr>
							<td>
								Дата начала:
							</td>
							<td style="padding-left: 15px;">
								<input class="input" name="date_start" id="date_start" required="required" />
							</td>
						</tr>
						<tr>
							<td>
								Дата возвращения:
							</td>
							<td style="padding-left: 15px;">
								<input class="input" name="date_end" id="date_end" required="required" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								Причина:
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<textarea class="textarea" name="request" rows="6" maxlength="200" required="required" placeholder="Пожалуйста, введите причину отпуска..."><?=isset($request)?$request:''?></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="has-text-centered" style="padding-top: 15px;">
								<input type="submit" class="button is-info" value=" Отправить " />
							</td>
						</tr>
						<tr>
							<td colspan="2" class="has-text-centered" style="padding-top: 10px;">
								<a href="leave.php"><i class="fas fa-arrow-left"></i> Вернуться</a>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
	$(function(){
		var options={lang:'ru',format:'Y-m-d H:i'};
		$('#date_start').datetimepicker(options);
		$("#date_end").datetimepicker(options);
	})
</script>

<?php
	require '../public/_share/_footer.php';
?>
