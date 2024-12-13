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
				<h2 class="has-text-centered subtitle"><i class="fas fa-suitcase-rolling"></i>Записи выбытия и пребытия</h2>
				<div class="columns">
					<div class="column">
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
						</table>
					</div>
					<div class="column has-text-centered">
							<a class="button is-info is-outlined is-small" href="./leave_add.php">
								Отправить заявку
							</a>
					</div>
				</div>
					<?php
						if(empty($leave_list)):
					?>
						<p class="has-text-centered">Нет записей о заявках</p>
					<?php
						else:
					?>
						<table class="table" style="width: 100%;">
							<thead>
							    <tr>
									<th>Дата выбытия</th>
									<th>Дата прибытия</th>
									<th>Причина</th>
							    </tr>
							</thead>
					<?php
							foreach($leave_list as $row):
					?>
								<tr>
									<td>
										<?=date('Y-m-d H:i',strtotime($row['date_start']))?>
									</td>
									<td>
										<?=date('Y-m-d H:i',strtotime($row['date_end']))?>
									</td>
									<td>
										<?=$row['request']?>
									</td>
								</tr>
					<?php 
							endforeach;
					?>
						</table>
						<?php
							if($max_page>1):
						?>
							<br>
							<nav class="pagination is-centered" role="navigation" aria-label="pagination">
							  <a class="pagination-previous has-background-white" href="./leave.php?page=1">Главная</a>
							  <a class="pagination-previous has-background-white" href="./leave.php?page=<?=$page-1; ?>"><</a>
							  <ul class="pagination-list">
									<?php
										for($p=1;$p<=$max_page;$p++):
											if($p==$page):
									?>
												<li><a class="pagination-link is-current" href="./leave.php?page=<?=$p?>"><?=$p?></a></li>
									<?php
											else:
									?>
												<li><a class="pagination-link has-background-white" href="./leave.php?page=<?=$p?>"><?=$p?></a></li>
									<?php
											endif;
										endfor;
									?>
							  </ul>
							  <a class="pagination-next has-background-white" href="./leave.php?page=<?=$page+1; ?>">></a>
							  <a class="pagination-next has-background-white" href="./leave.php?page=<?=$max_page; ?>">Последняя страница</a>
							</nav>
						<?php
							endif;
						?>
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
