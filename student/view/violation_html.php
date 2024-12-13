<?php
	if(!defined('APP')) die('Ошибка!<br>Эта страница не доступна');
?>
<?php
	require '../public/_share/_head.php';
?>

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
				<h2 class="has-text-centered subtitle"><i class="fas fa-clipboard-list"></i> Записи о взысканиях</h2>
				<div class="columns">
					<div class="column">
						<table style="width: 100%;border-collapse:separate; border-spacing:0px 10px;">
							<tr>
								<td>
									Имя:
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
				</div>
					<?php
						if(empty($maintain_list)):
					?>
						<p class="has-text-centered">Нет записей о нарушениях, продолжайте в том же духе!</p>
					<?php
						else:
					?>
						<table class="table" style="width: 100%;">
							<thead>
							    <tr>
									<th>Дата</th>
									<th>Взыскание</th>
									<th>Причина</th>
									<th>Ответ воспитателя</th>
							    </tr>
							</thead>
					<?php
							foreach($maintain_list as $row):
					?>
								<tr>
									<td>
										<?=date('Y-m-d',strtotime($row['date']))?>
									</td>
									<td>
										<?=$row['detail']?>
									</td>
									<td>
										<?=$row['punishment']?>
									</td>
									<td>
										<?=$row['teacher_response']?>
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
							  <a class="pagination-previous has-background-white" href="./violation.php?page=1">Главная</a>
							  <a class="pagination-previous has-background-white" href="./violation.php?page=<?=$page-1; ?>"><</a>
							  <ul class="pagination-list">
									<?php
										for($p=1;$p<=$max_page;$p++):
											if($p==$page):
									?>
												<li><a class="pagination-link is-current" href="./violation.php?page=<?=$p?>"><?=$p?></a></li>
									<?php
											else:
									?>
												<li><a class="pagination-link has-background-white" href="./violation.php?page=<?=$p?>"><?=$p?></a></li>
									<?php
											endif;
										endfor;
									?>
							  </ul>
							  <a class="pagination-next has-background-white" href="./violation.php?page=<?=$page+1; ?>">></a>
							  <a class="pagination-next has-background-white" href="./violation.php?page=<?=$max_page; ?>">Последняя страница</a>
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
