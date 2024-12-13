<?php
	if(!defined('APP')) die('error!<br>不能直接访问此页面');
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
				<h2 class="has-text-centered subtitle"><i class="fas fa-user"></i>&thinsp;Администратор</h2>
				<p class="has-text-centered"><span id="helloMsg">Привет! </span><span><?=$user_name?></span></p>
				<br>
				<table style="width: 100%;border-collapse:separate; border-spacing:0px 10px;">
					<tr>
						<td>
							ID:
						</td>
						<td style="padding-left: 15px;">
							<?=$user_id?>
						</td>
					</tr>
					<tr>
						<td>
							Имя:
						</td>
						<td style="padding-left: 15px;">
							<?=$user_account?>
						</td>
					</tr>
				</table>
				<br>
				<div class="has-text-right">
					<a class="button is-info is-outlined is-small" href="../public/changepwd.php">Сменить пароль</a>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
	require '../public/_share/_footer.php';
?>