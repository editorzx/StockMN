<?php
if(!isset($_SESSION["token"])) 
	exit(0);
?>
<!-- /.modal-->
<div class="modal fade" id="report_intoout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">กรุณาเลือกวันที่ ที่ต้องการตรวจสอบ</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row content-center">
					<div class="col-md-auto">
						<div class="form-group">
							<h3 class="text-danger">กรุณาเลือกวันที่ ที่ต้องการตรวจสอบในรายงานด้านล่าง</h3>
							<input class="form-control" type="text" name="datetimes" id="dateranges" />
						</div>
					</div>
				</div>
			</div>
						<!-- /.modal-content-->
		</div>
					<!-- /.modal-dialog-->
		</div>
	</div>
</div>
<!-- /.modal-->


<!-- /.modal-->
<div class="modal fade" id="report_sellherbal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">กรุณาเลือกวันที่ ที่ต้องการตรวจสอบ</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row content-center">
					<div class="form-group">
						<h3 class="text-danger">กรุณาเลือกวันที่ ที่ต้องการตรวจสอบในรายงานด้านล่าง</h3>
						<input class="form-control" type="date" id="viewDate" value="<?php echo date("Y-m-d");?>" max="<?php echo date("Y-m-d");?>" />
						<button class="btn mb-3 mt-3 btn-sm btn-square btn-info" id="checkReportSellHerbal">ออกรายงาน</button>
					</div>
				</div>
			</div>
						<!-- /.modal-content-->
		</div>
					<!-- /.modal-dialog-->
	</div>
</div>
<!-- /.modal-->


<!-- /.modal-->
<div class="modal fade" id="report_sellOnRange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">กรุณาเลือกวันที่ ที่ต้องการตรวจสอบ</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row content-center">
					<div class="col-md-auto">
						<div class="form-group">
							<h3 class="text-danger">กรุณาเลือกวันที่ ที่ต้องการตรวจสอบในรายงานด้านล่าง</h3>
							<input class="form-control" type="text" name="sell_dateRange" id="dateranges" />
						</div>
					</div>
				</div>
			</div>
						<!-- /.modal-content-->
		</div>
					<!-- /.modal-dialog-->
		</div>
	</div>
</div>
<!-- /.modal-->

