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
						<div class="card card-accent-primary">
							<div class="card-header"><small>รายงานเกี่ยวกับ คลังใน</small></div>
							<div class="card-body d-flex justify-content-center">
								<a class="btn mb-3 btn-lg btn-square btn-primary" target="_blank" href="report/report_instock">รายงานยาสมุนไพรและเวชภัณฑ์คงเหลือสต๊อกใน</a>	
								
								<button class="btn mb-3 btn-lg btn-square btn-behance" data-toggle="modal" data-target="#report_intoout" type="button">
									<span>รายงานยาสมุนไพรและเวชภัณฑ์ที่เบิกจากคลังใน</span>
								</button>
								
								<button class="btn mb-3 btn-lg btn-square btn-info" data-toggle="modal" data-target="#report_importinstock" type="button">
									<span>รายงานรายละเอียดการนำเข้ายาสมุนไพรและเวชภัณฑ์</span>
								</button>
							</div>
					    </div>
						<div class="card card-accent-primary">
							<div class="card-header"><small>รายงานเกี่ยวกับ คลังนอก</small></div>
							<div class="card-body d-flex justify-content-center">								
								<button class="btn mb-3 btn-lg btn-square btn-behance" data-toggle="modal" data-target="#report_sellherbal" type="button">
									<span>รายงานการจ่ายยาสมุนไพรรายวัน</span>
								</button>
								<button class="btn mb-3 btn-lg btn-square btn-pinterest" data-toggle="modal" data-target="#report_sellOnRange" type="button">
									<span>รายงานการจ่ายยาสมุนไพรแบบช่วงเวลา</span>
								</button>
								<a class="btn mb-3 btn-lg btn-square btn-yahoo" target="_blank" href="report/report_outstock">รายงานยาสมุนไพรคงเหลือสต๊อกนอก</a>	
								
								<a class="btn mb-3 btn-lg btn-square btn-facebook" target="_blank" href="report/report_detailoutstock">รายงานผลรายละเอียดยาสมุนไพร</a>							
							</div>
					    </div>
					</div>
				</div>
				
			</div>
		</div>
	</main>
</div>
			