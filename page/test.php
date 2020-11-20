<?php
										$result_list = $functions->getupdateMedicalStock(1);
										$vl = 0;
										$vlar = array();
										$need = 69;
										foreach ($result_list['result'] as $row) 
										{	
											$getvl = $row['value_sum'];
											if($vl < $need)
											{
												if($getvl > $need)
												{
													$vl = $getvl + $vl;
													break;
												}
												else{
													$vl = $getvl + $vl;
													$newx = 0;
													if($vl > $need){
														$newx = $vl - $need;
														$vl = $vl - $newx;
													}
													$newadd = array('id' => $row['IDs'] , 'values' => ($getvl-$newx));
													array_push($vlar, $newadd);
												}
											}
										}
									?>
									<div class="list-group-item list-group-item-action flex-column align-items-start">
									  <p class="mb-1">
										<?php echo $vl;?>
										<br>
										<?php print_r($vlar);?>
									  </p>
									</div>