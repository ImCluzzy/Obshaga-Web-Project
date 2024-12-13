<?php
	if(!defined('APP')) die('Ошибка! Непосредственный доступ к этой странице запрещен');
?>
<?php

	require '../public/_share/_head.php';
?>

<div class="hero is-info">
	<div class="hero-body">
		<div class="columns is-gapless">
		
			<div class="column has-text-centered">
				<h1 class="title">Система управления общежитиями<span class="is-hidden-mobile">  </span></h1>
				<h2 class="subtitle">Панель администратора<span class="is-hidden-mobile">  </span></h2>
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
				<h2 class="has-text-centered subtitle"><i class="fas fa-building"></i> Информация об общежитиях</h2>
				<a class="button is-info is-outlined is-small" href="./add_dorm_form.php">Добавить общежитие</a>
				<?php
					if(empty($dorm_list)):
				?>
					<p class="has-text-centered">Нет информации об общежитиях</p>
				<?php
					else:
				?>
					<hr>
				
					<table class="table" style="width: 100%;">
						<thead>
						    <tr>
								<th>Номер общежития</th>
								<th>Количество мест</th>
								<th>Количество свободных мест</th>
								<th>Воспитатель</th>
								<th>Действия</th>
						    </tr>
						</thead>
				<?php
						foreach($dorm_list as $row):
				?>
							<tr>
								<td>
									<?=$row['number']?>
								</td>
								<td>
									<?=$row['count_places']?>
								</td>
								<td>
									<?=$row['free_places']?>
								</td>
								<td>
									<?=$row['teacher_name']?>
								</td>
								<td>
								<a class="button is-info is-outlined is-small" href="./delete_dorm.php?number=<?=$row['number']?>">Удалить</a>
								</td>
							</tr>
				<?php 
						endforeach;
				?>
					</table>
					<br>
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
