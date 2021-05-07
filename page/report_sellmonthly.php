

<?php
if(!isset($_SESSION["token"])) 
	exit(0);
?>
<?php include ('template/left_menu.php'); ?>
<div class="c-wrapper c-fixed-components">
<?php include ('template/top_menu.php'); ?>
<div class="c-body">
	<main class="c-main">
		<div class="container-fluid">

			<div class="fade-in">
				<div class="row justify-content-center">
					<div class="col-lg-8 col-sm-6 col-md-4">
						<div class="card">
						<div class="card-header">กราฟยาสมุนไพรขายดีประจำเดือน 5 อันดับ</div>
							<div class="card-body">
								<div class="c-chart-wrapper">
									<canvas id="sellherbal_monthly"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</main>
</div>
			