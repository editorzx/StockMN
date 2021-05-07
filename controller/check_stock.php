<?php 
	if(isset($_GET['idm']))
	{
?>
	  <script>
	 $(document).ready(function() {
		$('#myModal').modal('show');
	 });
	 </script>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">ตรวจสอบข้อมูล <span id="index"></span></h4>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		  </div>
		  <div class="modal-body">
				<div class="list-group">
					<?php
						$result_list = $functions->GetMedicalDetail($_GET['idm']);
						foreach ($result_list['result'] as $row) 
						{

					?>
					<div class="list-group-item list-group-item-action flex-column align-items-start">
					  <p class="mb-1">
						<?php echo sprintf(DETAIL_MEDICAL,$row['Name'],$row['Quantity'],$row['counting_name'],$row['Price']);?> 
					  </p>						 
					</div>
					<?php
						}
					?>
				</div>
		  </div>
		  <div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
<?php
}
?>
 <?php 
if(isset($_GET['ids']))
{
 ?>
	  <script>
	 $(document).ready(function() {
		$('#myModal').modal('show');
	 });
	 </script>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title">ตรวจสอบข้อมูล <span id="index"></span></h4>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					  </div>
					  <div class="modal-body">
							<div class="list-group">
								<?php
									$result_list = $functions->GetHerbaldetail($_GET['ids']);
									foreach ($result_list['result'] as $row) 
									{

								?>
								<div class="list-group-item list-group-item-action flex-column align-items-start">
								  <p class="mb-1">
									<?php echo sprintf(DETAIL_HERBAL,$row['Name'],$row['Quantity'],$row['counting_name'],$row['Type']);?> 
								  </p>							 
								  <small class="text-muted">วันที่นำเข้า : <?php echo $row['Date'];?></small>
								  </br>
								 <small class="text-muted">วันหมดอายุ : <?php echo $row['Expire'];?></small>		
								</div>
								<?php
									}
								?>
							</div>
					  </div>
					  <div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
					  </div>
					</div>
				  </div>
				</div>
<?php
}
?>