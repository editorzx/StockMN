<?php include ('template/left_menu.php'); ?>
<div class="c-wrapper c-fixed-components">
<?php include ('template/top_menu.php'); ?>
 <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
		 
            <div class="fade-in">
              <div class="row">					
					<div class="col-lg-12" id="herbal">
						<div class="card">
							<div class="card-header"><small>ประวัติการเบิกจ่าย</small></div>
							<div class="card-body">
								<div class="list-group">
									<?php
										$result_list = $functions->Gettinglist('herbal_list');
										foreach ($result_list['result'] as $row) 
										{

									?>
									<div class="list-group-item list-group-item-action flex-column align-items-start">
									  <p class="mb-1">
										<?php echo 'ชื่อ : ' . $row['Name'];?> 
									  </p>
									 <small class="text-muted"><?php echo 'คำอธิบาย : ' . $row['Desc'];?></small>
									</div>
									<?php
										}
									?>
								</div>
							</div>
					    </div>
					</div>
            </div>
          </div>
        </main>
      </div>
	  </div>
	 </div>
	