$(document).ready(function() {
	var arraydrug = [];
	var url_string = window.location.href;
	var url = new URL(url_string);
	var get_url = url.searchParams.get("p");

	function formatdate(date){
		var monthNamesThai = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม"];
		var dayNames = ["วันอาทิตย์ที่","วันจันทร์ที่","วันอังคารที่","วันพุทธที่","วันพฤหัสบดีที่","วันศุกร์ที่","วันเสาร์ที่"];
		
		return date.slice(8,10) + " " + monthNamesThai[date.slice(5,7)-1] + " " + date.slice(0,4);
	}
	
	function swalAlert(data,type){
		Swal.fire({
		  icon: type,
		  title: 'การตอบกลับ',
		  text: data,
			showClass: {
			popup: 'animate__animated animate__fadeInDown'
			},
			hideClass: {
				popup: 'animate__animated animate__fadeOutUp'
			}
		});
	}
	
	function swalAlertConfirm(data,type){
		Swal.fire({
			icon: type,
			title: 'การตอบกลับ',
			text: data,
			showClass: {
			popup: 'animate__animated animate__fadeInDown'
			},
			hideClass: {
				popup: 'animate__animated animate__fadeOutUp'
			}
		}).then((result) => {
		  if (result.isConfirmed) {
			location.reload();
		  } else if (result.isDismissed) {
			location.reload();
		  }
		});
	}
	
	$('body').on("click", '#adddrug', function () {
		var name = $('#items option:selected').text();
		var id = $('#items option:selected').val();
		var desc = $('#items option:selected').attr('desc-data');
		var couting = $('#items option:selected').attr('count-data');
		var quantity = parseInt($('#quantity').val());
		var price = parseFloat($('#price_val').val());
		var expiredate = $('#expiredate').val() /*+ ' ' + $('#expiretime').val()*/;
		var lenght = arraydrug.length;
		var partner = $('#partner option:selected').val();
		var partner_name = $('#partner option:selected').attr('name-data');
		var loter = $('#loter option:selected').val();
		var loter_name = $('#loter option:selected').attr('name-data');
		var found = false;
		if($.trim($('#expiredate').val()) == '' /*|| $.trim($('#expiretime').val()) == ''*/) {
			alert('กรุณาระบุวันที่ให้ถูกต้อง');
			return;
		}
		arraydrug.forEach(function(item,key) {
			if(item.name === name){
				found = true;
				item.quantity = parseInt(item.quantity+quantity);
				//item.price = item.price + price;
				item.price = price;
				item.partner = partner;
				$('#bodyforadd > tbody > tr').each(function() {
					var $tds = $(this).find('td #name').eq(0).text();
					if($tds === name){
						$(this).find('td #quan').eq(0).text(item.quantity);
						$(this).find('td #price').eq(0).text(item.price);
						$(this).find('td #partner_name').eq(0).text(partner_name);
						$(this).find('td #loter_name').eq(0).text(loter_name);
					}
				});
			}
		});
		if(!found)
		{
			arraydrug.push({id,name,desc,quantity,price,expiredate,partner,loter});
			$('#bodyforadd > tbody:last-child').append('<tr>'+
			'<td>'+
				'<div id="name">'+name+'</div>'+
				'<div class="small text-muted">'+desc+'</div>'+
			'</td>'+
			'<td>'+
				'<div id="partner_name">'+partner_name+'</div>'+
			'</td>'+
			'<td>'+
				'<div id="loter_name">'+loter_name+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div id="quan">'+quantity+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div>'+couting+'</div>'+
			'</td>'+
			'<td>'+
				'<div id="price">'+price+'</div>'+
			'</td>'+
			'<td class="text-right">'+
				'<div>'+ formatdate(expiredate) + " " + expiredate.slice(11,16) +'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div><button type="button" id="deletedrug" class="form-control bg-danger text-white" data-button-delete-id="'+ lenght +'">ลบ</button></div>'+
			'</td>'+
			'</tr>');
		}
		
		$('#addherbal').modal('hide');
    })
	
	
	$('body').on("click.btn", '[data-button-delete-id]', function () {
		var idarray = $(this).attr('data-button-delete-id');
		arraydrug.splice(idarray,1);
		$(this).closest("tr").remove();
	})
	
	$('body').on("click.li", '#list-e', function () {
		let idh = $(this).attr('data-id');
		if(idh){
			//console.log("TESTxxzs " + idh);
			
			$(location).attr('href', 'index?p=check_stock&ids='+idh)
			//$('#myModal').modal('show');
			//$("#index").val(idh);
		}
	})
	
	
	$('body').on("click.li", '#list-m', function () {
		let idh = $(this).attr('data-id');
		if(idh){
			//console.log("TESTxxzs " + idh);
			
			$(location).attr('href', 'index?p=check_stock&idm='+idh)
			//$('#myModal').modal('show');
			//$("#index").val(idh);
		}
	})
	
	$('body').on("click.btn", '#addsql', function () {
		if(arraydrug.length !== 0)
		{
			var jsonString = JSON.stringify(arraydrug);
			Swal.fire({
				title: 'ยืนยัน?',
				text: "กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนการบันทึกข้อมูล!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ยืนยัน',
				cancelButtonText: 'ยกเลิก',
				showClass: {
				popup: 'animate__animated animate__fadeInDown'
				},
				hideClass: {
					popup: 'animate__animated animate__fadeOutUp'
				}

				}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type: "POST",
						url: "ajax/insert.php",
						data: {data : jsonString}, 
						cache: false,

						success: function(data){
							$("#bodyforadd tr td").empty();
							arraydrug = [];
							//swalAlert(data, 'success')
							swalAlertConfirm(data,'success');
						}
					});
				}
			});
			
		}else{
			swalAlert("กรุณาเพิ่มข้อมูลก่อนการบันทึกผล",'error');
		}
	});
	
	$('#search').keyup(  function() {  
		var str = $("#search").val();
		//var n = str.search("Visit W3Schools!");
		/*$('ul#herbal_list>li').each(function () {
			var str_s = $(this).attr('data-name');
			//if(str.indexOf(str_s) != -1)
				console.log(str.indexOf(str_s));
		});	*/
		/*$("ul#herbal_list>li").hide(); 
		$("ul#herbal_list>li").find("[data-name*='" + str + "']").show(); */
		if(str.length <= 0)
		{
			$("[data-name]").show(); 
			$('[data-name]').addClass('d-flex');
		}
		else
		{
			$("[data-name]").hide().filter('[data-name*="'+str+'"]').show();
			$('[data-name]').removeClass('d-flex');
			//$('[data-name]').addClass('embed-responsive');
		}
		
	});

	if(get_url === "check_stock"){
		$('#changeType').change(function() {
			if(this.checked) {
				$('#herbal').show();
				$('#medical').hide();
			}else{
				$('#herbal').hide();
				$('#medical').show();
			}     
		});
		$('#herbal').show();
		$('#medical').hide();		 
	}
	
	
	if(get_url === "edit_warehouse"){
		var get_id = url.searchParams.get("id");
		//$('#myModal').modal('toggle');
		if(get_id)
			$('#myModal').modal('show');
		//$('#myModal').modal('hide');
	}
	
	
	
	if(get_url === "edit_medical"){
		var get_id = url.searchParams.get("id");
		//$('#myModal').modal('toggle');
		if(get_id)
			$('#myModal').modal('show');
		//$('#myModal').modal('hide');
	}
	
	if(get_url === "officers_list"){
		var get_id = url.searchParams.get("id");
		//$('#myModal').modal('toggle');
		if(get_id)
			$('#myModal').modal('show');
		//$('#myModal').modal('hide');
	}
		
	if(get_url === "herbal-info" || get_url === "medical-info" || get_url === "partner-info" || get_url === "lot-info"
		|| get_url === "type-info" || get_url === "lot-info" || get_url === "counting-info" 
	){
		var get_id = url.searchParams.get("id");
		//$('#myModal').modal('toggle');
		if(get_id)
			$('#myModal').modal('show');
		//$('#myModal').modal('hide');
		
		
		var get_status = url.searchParams.get("status");
		if(get_status === '1'){
			Swal.fire({
				icon: "success",
				title: 'การตอบกลับ',
				text: "สำเร็จ",
				showClass: {
				popup: 'animate__animated animate__fadeInDown'
				},
				hideClass: {
					popup: 'animate__animated animate__fadeOutUp'
				}
			}).then((result) => {
			  if (result.isConfirmed) {
				$(location).attr('href', 'index?p='+get_url)
			  } else if (result.isDismissed) {
				$(location).attr('href', 'index?p='+get_url)
			  }
			});
		}else if(get_status === '0'){
			Swal.fire({
				icon: "warning",
				title: 'การตอบกลับ',
				text: "เกิดข้อผิดพลาด",
				showClass: {
				popup: 'animate__animated animate__fadeInDown'
				},
				hideClass: {
					popup: 'animate__animated animate__fadeOutUp'
				}
			}).then((result) => {
			  if (result.isConfirmed) {
				$(location).attr('href', 'index?p='+get_url)
			  } else if (result.isDismissed) {
				$(location).attr('href', 'index?p='+get_url)
			  }
			});
		}
	}
	
	$('body').on("click", '#showdatabtn', function () {
		let idh = $(this).attr('data');
		if(idh){
			if(url.search.slice(1).search("show") !== -1){
				url.searchParams.set('show', idh); //AppendParam;
				$(location).attr('href', 'index?' + url.search.slice(1))
			}else{
				url.searchParams.append('show', idh); //AppendParam;
				$(location).attr('href', 'index?' + url.search.slice(1))
			}
			
		}
	})
	
	//medical
	var arraymedical = [];
	$('body').on("click", '#addmedical', function () {
		var name = $('#items option:selected').text();
		var id = $('#items option:selected').val();
		var desc = $('#items option:selected').attr('desc-data');
		var couting = $('#items option:selected').attr('count-data');
		var quantity = parseInt($('#quantity').val());
		var price = parseFloat($('#price_val').val());
		var lenght = arraymedical.length;
		var partner = $('#partner option:selected').val();
		var partner_name = $('#partner option:selected').attr('name-data');
		var loter = $('#loter option:selected').val();
		var loter_name = $('#loter option:selected').attr('name-data');
		var found = false;
		
		arraymedical.forEach(function(item,key) {
			if(item.name === name){
				found = true;
				item.quantity = parseInt(item.quantity+quantity);
				item.price = price;
				item.partner = partner;
				$('#bodyforaddmedical > tbody > tr').each(function() {
					var $tds = $(this).find('td #name').eq(0).text();
					if($tds === name){
						$(this).find('td #quan').eq(0).text(item.quantity);
						$(this).find('td #price').eq(0).text(item.price);
						$(this).find('td #partner_name').eq(0).text(partner_name);
						$(this).find('td #loter_name').eq(0).text(loter_name);
					}
				});
			}
		});
		if(!found)
		{
			arraymedical.push({id,name,desc,quantity,price,partner,loter});//id = medicalid, name = medicalname, 
			$('#bodyforaddmedical > tbody:last-child').append('<tr>'+
			'<td>'+
				'<div id="name">'+name+'</div>'+
				'<div class="small text-muted">'+desc+'</div>'+
			'</td>'+
			'<td>'+
				'<div id="partner_name">'+partner_name+'</div>'+
			'</td>'+
			'<td>'+
				'<div id="loter_name">'+loter_name+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div id="quan">'+quantity+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div>'+couting+'</div>'+
			'</td>'+
			'<td class="text-right">'+
				'<div id="price">'+price+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div><button type="button" id="deletemedical" class="form-control bg-danger text-white" data-button-delete-id="'+ lenght +'">ลบ</button></div>'+
			'</td>'+
			'</tr>');
		}
		
		$('#addmedicallist').modal('hide');
    })
	
	$('body').on("click.btn", '[data-button-delete-id]', function () {
		var idarray = $(this).attr('data-button-delete-id');
		arraymedical.splice(idarray,1);
		$(this).closest("tr").remove();
	})
	
	$('body').on("click.btn", '#addsqlmedical', function () {
		if(arraymedical.length !== 0)
		{
			var jsonString = JSON.stringify(arraymedical);

			Swal.fire({
				title: 'ยืนยัน?',
				text: "กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนการบันทึกข้อมูล!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ยืนยัน',
				cancelButtonText: 'ยกเลิก',
				showClass: {
				popup: 'animate__animated animate__fadeInDown'
				},
				hideClass: {
					popup: 'animate__animated animate__fadeOutUp'
				}
				}).then((result) => {
				if (result.isConfirmed) {
					 $.ajax({
						type: "POST",
						url: "ajax/insert.php",
						data: {data : jsonString, type : 'medical'}, 
						cache: false,

						success: function(data){
							swalAlertConfirm(data, 'success');
							$("#bodyforaddmedical tr").empty();
							arraymedical = [];
							//location.reload();
						}
					});
				}
			});
		}
	})
	
	
	$('body').on("click", '#add_export_medical', function () {
		var name = $('#items option:selected').attr('name-data');
		//var unitprice = $('#items option:selected').attr('unit-price');
		var id = $('#items option:selected').val();
		var desc = $('#items option:selected').attr('desc-data');
		var max = $('#items option:selected').attr('maximum-data');
		var couting = $('#items option:selected').attr('count-data');
		var quantity = parseInt($('#quantity').val());
		var unitprice = parseFloat($('#price_val').val());
		var price = unitprice * quantity;
		var lenght = arraymedical.length;
		var found = false;
		
		if(quantity > max){
			swalAlert('จำนวนเวชภัณฑ์ไม่พอจ่าย','error');
			return;
		}
		
		$.each(arraymedical, function (key, item) {
			if(item.name === name){
				found = true;
				item.quantity = (parseInt(item.quantity+quantity) > max) ? max : parseInt(item.quantity+quantity);
				item.price = price * item.quantity;
				$('#bodyforaddmedical_export > tbody > tr').each(function() {
					var $tds = $(this).find('td #name').eq(0).text();
					if($tds === name){
						$(this).find('td #quan').eq(0).text(item.quantity);
						$(this).find('td #price').eq(0).text(item.price);
						$(this).find('td #unitprice').eq(0).text(unitprice);
					}
				});
			}
		});
		if(!found)
		{
			arraymedical.push({id,name,desc,quantity,price});//id = medicalid, name = medicalname, 
			$('#bodyforaddmedical_export > tbody:last-child').append('<tr>'+
			'<td>'+
				'<div id="name">'+name+'</div>'+
				'<div class="small text-muted">'+desc+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div id="quan">'+quantity+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div>'+couting+'</div>'+
			'</td>'+
			'<td>'+
				'<div id="price">'+price+'</div>'+
			'</td>'+
			'<td>'+
				'<div id="unitprice">'+unitprice+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div><button type="button" id="deletemedical" class="form-control bg-danger text-white" data-button-delete-id="'+ lenght +'">ลบ</button></div>'+
			'</td>'+
			'</tr>');
		}

		$('#exportMedicalList').modal('hide');
    })
	
	$('body').on("click", '#add_export_herbal', function () {
		var name = $('#items option:selected').attr('name-data');
		var unitprice = $('#items option:selected').attr('unit-price');
		var id = $('#items option:selected').val();
		var desc = $('#items option:selected').attr('desc-data');
		var max = $('#items option:selected').attr('maximum-data');
		var couting = $('#items option:selected').attr('count-data');
		var quantity = parseInt($('#quantity').val());
		var price = parseFloat($('#price_val').val());
		var lenght = arraymedical.length;
		var found = false;
		
		if(quantity > max){
			swalAlert('จำนวนยาไม่พอจ่าย', 'error');
			return;
		}
		
		$.each(arraymedical, function (key, item) {
			if(item.name === name){
				found = true;
				item.quantity = (parseInt(item.quantity+quantity) > max) ? max : parseInt(item.quantity+quantity);
				$('#bodyforaddherbal_export > tbody > tr').each(function() {
					var $tds = $(this).find('td #name').eq(0).text();
					if($tds === name){
						$(this).find('td #quan').eq(0).text(item.quantity);
					}
				});
			}
		});
		if(!found)
		{
			arraymedical.push({id,name,desc,quantity,price});//id = medicalid, name = medicalname, 
			$('#bodyforaddherbal_export > tbody:last-child').append('<tr>'+
			'<td>'+
				'<div id="name">'+name+'</div>'+
				'<div class="small text-muted">'+desc+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div id="quan">'+quantity+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div>'+couting+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div><button type="button" id="deletemedical" class="form-control bg-danger text-white" data-button-delete-id="'+ lenght +'">ลบ</button></div>'+
			'</td>'+
			'</tr>');
		}

		$('#exportHerbalList').modal('hide');
    })
	
	$('body').on("click", '#add_selling_herbal', function () {
		var name = $('#items option:selected').attr('name-data');
		var unitprice = $('#items option:selected').attr('unit-price');
		var id = $('#items option:selected').val();
		var desc = $('#items option:selected').attr('desc-data');
		var max = $('#items option:selected').attr('maximum-data');
		var couting = $('#items option:selected').attr('count-data');
		var quantity = parseInt($('#quantity').val());
		var price = parseFloat($('#price_val').val());
		var status = $('#status').val();
		var lenght = arraymedical.length;
		var found = false;
		
		
		if(quantity > max){
			swalAlert('จำนวนยาไม่พอจ่าย', 'error');
			return;
		}
		
		$.each(arraymedical, function (key, item) {
			if(item.name === name){
				found = true;
				item.quantity = (parseInt(item.quantity+quantity) > max) ? max : parseInt(item.quantity+quantity);
				item.price = price * item.quantity;
				$('#bodyforaddselling_herbal > tbody > tr').each(function() {
					var $tds = $(this).find('td #name').eq(0).text();
					if($tds === name){
						$(this).find('td #quan').eq(0).text(item.quantity);
						$(this).find('td #price').eq(0).text(item.price);
						$(this).find('td #remaining').eq(0).text(max-item.quantity);
					}
				});
			}
		});
		if(!found)
		{
			arraymedical.push({id,name,desc,quantity,price,status});//id = medicalid, name = medicalname, 
			$('#bodyforaddselling_herbal > tbody:last-child').append('<tr>'+
			'<td>'+
				'<div id="name">'+name+'</div>'+
				'<div class="small text-muted">'+desc+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div id="price">'+(price*quantity)+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div id="quan">'+quantity+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div>'+couting+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div id="remaining">'+(max-quantity)+" "+couting+'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div><button type="button" id="deletemedical" class="form-control bg-danger text-white" data-button-delete-id="'+ lenght +'">ลบ</button></div>'+
			'</td>'+
			'</tr>');
		}

		$('#sellingHerbalList').modal('hide');
    })
	
	$('body').on("click.btn", '#export_medical', function () {
		if(arraymedical.length !== 0)
		{
			var jsonString = JSON.stringify(arraymedical);
			Swal.fire({
				title: 'ยืนยัน?',
				text: "กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนการบันทึกข้อมูล!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ยืนยัน',
				cancelButtonText: 'ยกเลิก',
				showClass: {
				popup: 'animate__animated animate__fadeInDown'
				},
				hideClass: {
					popup: 'animate__animated animate__fadeOutUp'
				}
				}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type: "POST",
						url: "ajax/export.php",
						data: {data : jsonString, type : 'medical'}, 
						cache: false,

						success: function(data){
							swalAlertConfirm(data,'success');
							$("#bodyforaddmedical_export tr").empty();
							arraymedical = [];
						}
					});
				}
			});
		}
	})
	
	$('body').on("click.btn", '#export_herbal', function () {
		if(arraymedical.length !== 0)
		{
			var jsonString = JSON.stringify(arraymedical);
			Swal.fire({
				title: 'ยืนยัน?',
				text: "กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนการบันทึกข้อมูล!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ยืนยัน',
				cancelButtonText: 'ยกเลิก',
				showClass: {
				popup: 'animate__animated animate__fadeInDown'
				},
				hideClass: {
					popup: 'animate__animated animate__fadeOutUp'
				}
				}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type: "POST",
						url: "ajax/export.php",
						data: {data : jsonString, type : 'herbal'}, 
						cache: false,

						success: function(data){
							swalAlertConfirm(data,'success');
							$("#bodyforaddherbal_export tr").empty();
							arraymedical = [];
						}
					});
				}
			});
			
		}
	})
	
	$('body').on("click.btn", '#selling_herbal', function () {
		if(arraymedical.length !== 0)
		{
			var jsonString = JSON.stringify(arraymedical);
			Swal.fire({
				title: 'ยืนยัน?',
				text: "กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนการบันทึกข้อมูล!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ยืนยัน',
				cancelButtonText: 'ยกเลิก',
				showClass: {
				popup: 'animate__animated animate__fadeInDown'
				},
				hideClass: {
					popup: 'animate__animated animate__fadeOutUp'
				}
				}).then((result) => {
				if (result.isConfirmed) {
					 $.ajax({
						type: "POST",
						url: "ajax/selling.php",
						data: {data : jsonString, type : 'herbal'}, 
						cache: false,

						success: function(data){
							swalAlertConfirm(data,'success');
							$("#bodyforaddselling_herbal tr").empty();
							arraymedical = [];
						}
					});
				}
			});
		}
	})
	
	var getUrlParameter = function getUrlParameter(sParam) {
		var sPageURL = window.location.search.substring(1),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
			}
		}
	};
	
	
	//////Paginate Function////////
	
	$('body').on("click.a", '#paginateButton', function () {
		let idh = $(this).attr('data');
		if(idh){
			if(url.search.slice(1).search("page") !== -1){
				url.searchParams.set('page', idh); //AppendParam;
				$(location).attr('href', 'index?' + url.search.slice(1))
			}else{
				url.searchParams.append('page', idh); //AppendParam;
				$(location).attr('href', 'index?' + url.search.slice(1))
			}
			
		}
	})
	
	
	///ViewLogHerbal
	
	  
	$('body').on("click", '#viewResultLogHerbal', function () {
		let idh = $(this).attr('data-id');
		$('#bodyForLogHerbal > tbody').empty(); //clear old data
		$('#editLogHerbal_btn').attr('data-id', idh); //id to button
		if(idh){
			$.ajax({
				type: "POST",
				url: "ajax/viewLogHerbal.php",
				data: { id: idh }
			}).done(function( msg ) {
				const data = JSON.parse(msg);
				if(data.code === 200){
					$('#logHerbalWarehouse').modal('show');
					$.each(data.success.message, function (key, item) {
						$('#bodyForLogHerbal > tbody:last-child').append('<tr>'+
						'<td>'+
							'<div>'+(key+1)+'</div>'+
						'</td>'+
						'<td class="text-center">'+
							'<div id="x">'+item.herbalName+'</div>'+
						'</td>'+
						'<td class="text-center">'+
							'<div id="x">'+item.partnerName+'</div>'+
						'</td>'+
						'<td class="text-center">'+
							'<div id="x">'+item.price+'</div>'+
						'</td>'+
						'<td class="text-center">'+
							'<div id="x">'+item.quantity+'</div>'+
						'</td>'+
						'<td class="text-center">'+
							'<div>'+formatdate(item.expireDate)+ " , " + item.expireDate.slice(11,16)+'</div>'+
						'</td>'+
						'<td class="text-center">'+
							'<div><button class="btn btn-sm btn-square btn-behance mt-1" type="button" id="editLogHerbal_btn" data-id="'+item.id+'">แก้ไข</button></div>'+
						'</td>'+
						'</tr>');
					});
				}else{
					swalAlert('Api Failed', 'error');
				}
			});
			
		}
	})
	
	$('body').on("click", '#viewResultLogMedical', function () {
		let idh = $(this).attr('data-id');
		$('#bodyForLogMedical > tbody').empty(); //clear old data
		if(idh){
			$.ajax({
				type: "POST",
				url: "ajax/viewLogMedical.php",
				data: { id: idh }
			}).done(function( msg ) {
				const data = JSON.parse(msg);
				if(data.code === 200){
					$('#logMedicalWarehouse').modal('show');
					$.each(data.success.message, function (key, item) {
						$('#bodyForLogMedical > tbody:last-child').append('<tr>'+
						'<td>'+
							'<div>'+(key+1)+'</div>'+
						'</td>'+
						'<td class="text-center">'+
							'<div id="x">'+item.medicalName+'</div>'+
						'</td>'+
						'<td class="text-center">'+
							'<div id="x">'+item.partnerName+'</div>'+
						'</td>'+
						'<td class="text-center">'+
							'<div id="x">'+item.price+'</div>'+
						'</td>'+
						'<td class="text-center">'+
							'<div id="x">'+item.quantity+'</div>'+
						'</td>'+
						'</tr>');
					});
				}else{
					swalAlert('Api Failed', 'error');
				}
			});
			
		}
	})
	
	
	//showing tooltip descdata
	
	$('body').on("change", '#items', function () {
		let desc = $('#items option:selected').attr('desc-data');
		let quan = $('#items option:selected').attr('count-data');
		$('#desc-tooltips').attr('data-original-title', desc);
		$('#quantity-name').text(quan);
	})
	
	
	if(get_url === "report_all"){
		$('input[name="datetimes"]').daterangepicker({
			timePicker: false,
			startDate: moment().startOf('day'),
			endDate: moment().startOf('day').add(1, 'day'),
			maxDate: moment().startOf('day'),
			locale: {
			  format: 'YYYY-MM-DD'
			}
		}/*, function(start, end, label) {
			
			
		 }*/);
		 
		$('input[name="datetimes"]').on('apply.daterangepicker', function(ev, picker) {
			//$(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
			/*$.ajax({
				type: "POST",
				url: "report/report_intoout",
				data: { start: picker.startDate.format('YYYY-MM-DD'), end: picker.endDate.format('YYYY-MM-DD') }
			}).done(function( msg ) {
				console.log(msg);
			});*/

			$(location).attr('href', 'report/report_intoout?start='+picker.startDate.format('YYYY-MM-DD')+'&end='+picker.endDate.format('YYYY-MM-DD'))
		});
		
		$('body').on("click.btn", '#checkReportSellHerbal', function () {
			let viewDate = $('#viewDate').val();
			if(viewDate){
				$(location).attr('href', 'report/report_sellherbal?date='+viewDate)
			}
		});
		
		
		$('input[name="sell_dateRange"]').daterangepicker({
			timePicker: false,
			startDate: moment().startOf('day'),
			endDate: moment().startOf('day').add(1, 'day'),
			maxDate: moment().startOf('day'),
			locale: {
			  format: 'YYYY-MM-DD'
			}
		});
		 
		$('input[name="sell_dateRange"]').on('apply.daterangepicker', function(ev, picker) {
			$(location).attr('href', 'report/report_sell_daterange?start='+picker.startDate.format('YYYY-MM-DD')+'&end='+picker.endDate.format('YYYY-MM-DD'))
		});
		
	}
	
	
	$('body').on("click.btn", '#user_setting_return', function () {
		const pass1 = $('#password').val();
		const pass2 = $('#password2').val();
		
		if(pass1.length < 6 && pass2.length < 6){
			swalAlert("รหัสผ่านต้องมี 6 ตัวขึ้นไป", "error")
		}else{
			$.ajax({
				type: "POST",
				url: "ajax/user_setting.php",
				data: { password: pass1, password2: pass2 }
			}).done(function( msg ) {
				
				const data = JSON.parse(msg);
				
				console.log(data);
				swalAlert(data.data.message, data.status)
			});
		}
	})
	
							
	
	$('body').on("click.btn", '#editLogHerbal_btn', function () {		
		let idh = $(this).attr('data-id');
		//console.log(idh);
		$('#formInputHerbal').html('');
		if(idh){
			$('#logHerbalWarehouse').modal('hide');
			$.ajax({
				type: "GET",
				url: "ajax/editLogHerbal",
				data: { id: idh }
			}).done(function( msg ) {
				const data = JSON.parse(msg);
				
				if(data.code === 200){
					$('#editLogHerbal').modal('show');
					const item = data.success.message
						$('#formInputHerbal').append('<div class="col-md-12">');
						$('#formInputHerbal').append('<span class="help-block">ชื่อยาสมุนไพร</span>');
						$('#formInputHerbal').append('<input class="form-control" id="herbal_name" name="herbal_name" value="'+item.herbalName+'" type="text" placeholder="ชื่อยาสมุนไพร" disabled>');
						$('#formInputHerbal').append('</div>');
						$('#formInputHerbal').append('<div class="col-md-12">');
						$('#formInputHerbal').append('<span class="help-block">ราคา</span>');
						$('#formInputHerbal').append('<input class="form-control" id="price_herbal" name="price_herbal" value="'+item.Price+'" type="number" placeholder="ราคา">');
						$('#formInputHerbal').append('</div>');
						$('#formInputHerbal').append('<div class="col-md-12">');
						$('#formInputHerbal').append('<span class="help-block">จำนวน</span>');
						$('#formInputHerbal').append('<input class="form-control" id="quantity_herbal" name="quantity_herbal" value="'+item.Quantity+'" type="number" placeholder="จำนวน">');
						$('#formInputHerbal').append('</div>');
						$('#formInputHerbal').append('<div class="col-md-12">');
						$('#formInputHerbal').append('<span class="help-block">วันหมดอายุ</span>');
						$('#formInputHerbal').append('<input class="form-control" id="expire_date" name="expire_date" value="'+item.ExpireDate.substring(0,10)+'" min="'+moment().format('YYYY-MM-DD')+'" type="date" placeholder="วันหมดอายุ">');
						$('#formInputHerbal').append('</div>');
						if(item.status === '1')
							$('#formInputHerbal').append('<button class="btn btn-primary mt-2" type="submit" id="apiResult_LogHerbal_btn" data-id="'+idh+'" data-status="'+item.status+'" onclick="return confirm(\'ยืนยันการแก้ไข?\')" >แก้ไข</button>');
						else
							$('#formInputHerbal').append('<button class="btn btn-danger mt-2" type="button" disabled>ยาถูกเบิกจ่ายออกไปแล้วไม่สามารถแก้ไขได้</button>');
				}else{
					swalAlert('Api Failed', 'error');
				}
			});
		}else{
			swalAlert('Api Failed', 'error');
		}
	})
	
	$('body').on("click.btn", '#apiResult_LogHerbal_btn', function () {		
		const iStatus = $(this).attr('data-status');
		const id = $(this).attr('data-id');
		const priceHerbal = $('#price_herbal').val();
		const quantityHerbal = $('#quantity_herbal').val();
		const expireDate = $('#expire_date').val();
		if(iStatus && id){
			$.ajax({
				type: "POST",
				url: "ajax/editLogHerbal",
				data: { id: id, priceHerbal: priceHerbal, quantityHerbal: quantityHerbal, expireDate: expireDate}
			}).done(function( msg ) {
				const data = JSON.parse(msg);
				if(data.code === 200){
					$('#editLogHerbal').modal('hide');
					swalAlert('ข้อมูลการนำเข้าถูกแก้ไขเรียบร้อยแล้ว', 'success');
				}else{
					swalAlert('Api Failed', 'error');
				}
			});
		}else{
			swalAlert('Api Failed', 'error');
		}
	})
	
	
	if(get_url === null){
		let herbalArray = [];
		let sellQuantity = [];
		let percentCal = [];
		let checkResult = false;
		$.ajax({
			type: "GET",
			url: "api/top_monthly.php"
		}).done(function( msg ) {
			
			const data = JSON.parse(msg);
			
			data.forEach(function(item,key) {
				
				if(item.herbalName && item.sellQuantity){
					let pt = ((item.sellQuantity/data[data.length-1].totalQuantity) * 100).toFixed(2);
					herbalArray.push(item.herbalName);
					sellQuantity.push(item.sellQuantity);
					percentCal.push( item.herbalName + " : " + pt + "%");
					
					checkResult = true;
				}	
			});
			
			if (checkResult) {
				var sellherbal_monthly = new Chart(document.getElementById('sellherbal_monthly'), {
				  type: 'doughnut',
				  data: {
					labels: percentCal,
					datasets: [{
					  data: sellQuantity,
					  backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#14ff2c', '#a203ff'],
					  hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#14ff2c', '#a203ff']
					}]
				  },
				  options: {
					responsive: true,
					cutoutPercentage: 50,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'ยอดการขายประจำเดือน'
					 }
				  }
				}); // eslint-disable-next-line no-unused-vars
			}
			
			
		});
	}
});