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
	
	$('body').on("click", '#adddrug', function () {
		var name = $('#items option:selected').text();
		var id = $('#items option:selected').val();
		var desc = $('#items option:selected').attr('desc-data');
		var couting = $('#items option:selected').attr('count-data');
		var quantity = parseInt($('#quantity').val());
		var price = parseFloat($('#price').val());
		var expiredate = $('#expiredate').val() + ' ' + $('#expiretime').val();
		var lenght = arraydrug.length;
		var partner = $('#partner option:selected').val();
		var found = false;
		if($.trim($('#expiredate').val()) == '' || $.trim($('#expiretime').val()) == '') {
			alert('กรุณาระบุวันที่ให้ถูกต้อง');
			return;
		}
		
		arraydrug.forEach(function(item) {
			if(item.name === name){
				found = true;
				item.quantity = parseInt(item.quantity+quantity);
				item.price = item.price + price;
				$('#bodyforadd > tbody').each(function() {
					var quan = $(this).find('td #quan').eq(0).text(item.quantity);
					var price = $(this).find('td #price').eq(0).text(item.price);
				});
			}
		});
		
		if(!found)
		{
			arraydrug.push({id,name,desc,quantity,price,expiredate,partner});
			$('#bodyforadd > tbody:last-child').append('<tr>'+
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
			'<td class="text-right">'+
				'<div>'+ formatdate(expiredate) + " " + expiredate.slice(11,16) +'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div><button type="button" id="deletedrug" class="form-control bg-dark text-white" data-button-delete-id="'+ lenght +'">ลบ</button></div>'+
			'</td>'+
			'</tr>');
		}
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
	$('body').on("click.btn", '#addsql', function () {
		if(arraydrug.length !== 0)
		{
			var jsonString = JSON.stringify(arraydrug);
		    $.ajax({
				type: "POST",
				url: "ajax/insert.php",
				data: {data : jsonString}, 
				cache: false,

				success: function(data){
					alert(data);
					$("#bodyforadd tr").empty();
					arraydrug = [];
				}
			});
		}
	})

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
			}
			
		});
		 
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
	

	//medical
	var arraymedical = [];
	$('body').on("click", '#addmedical', function () {
		var name = $('#items option:selected').text();
		var id = $('#items option:selected').val();
		var desc = $('#items option:selected').attr('desc-data');
		var couting = $('#items option:selected').attr('count-data');
		var quantity = parseInt($('#quantity').val());
		var price = parseFloat($('#price').val());
		var lenght = arraymedical.length;
		var partner = $('#partner option:selected').val();
		var found = false;
		arraymedical.forEach(function(item) {
			if(item.name === name){
				found = true;
				item.quantity = parseInt(item.quantity+quantity);
				item.price = item.price + price;
				$('#bodyforaddmedical > tbody').each(function() {
					var quan = $(this).find('td #quan').eq(0).text(item.quantity);
					var price = $(this).find('td #price').eq(0).text(item.price);
				});
			}
		});
		if(!found)
		{
			arraymedical.push({id,name,desc,quantity,price,partner});//id = medicalid, name = medicalname, 
			$('#bodyforaddmedical > tbody:last-child').append('<tr>'+
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
			'<td class="text-center">'+
				'<div><button type="button" id="deletemedical" class="form-control bg-dark text-white" data-button-delete-id="'+ lenght +'">ลบ</button></div>'+
			'</td>'+
			'</tr>');
		}
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
		    $.ajax({
				type: "POST",
				url: "ajax/insert.php",
				data: {data : jsonString, type : 'medical'}, 
				cache: false,

				success: function(data){
					alert(data);
					$("#bodyforaddmedical tr").empty();
					arraymedical = [];
				}
			});
		}
	})
	
	
	$('body').on("click", '#add_export_medical', function () {
		var name = $('#items option:selected').attr('name-data');
		var id = $('#items option:selected').val();
		var desc = $('#items option:selected').attr('desc-data');
		var max = $('#items option:selected').attr('maximum-data');
		var couting = $('#items option:selected').attr('count-data');
		var quantity = parseInt($('#quantity').val());
		var price = parseFloat($('#price').val());
		var lenght = arraymedical.length;
		var partner = $('#partner option:selected').val();
		var found = false;
		
		if(quantity > max){
			alert('จำนวนยาไม่พอจ่าย');
			return;
		}

		$.each(arraymedical, function (key, item) {
			if(item.name === name){
				found = true;
				item.quantity = parseInt(item.quantity+quantity);
				item.price = item.price + price;
				$('#bodyforaddmedical > tbody').each(function() {
					var quan = $(this).find('td #quan').eq(0).text(item.quantity);
					var price = $(this).find('td #price').eq(0).text(item.price);
				});
			}
		});
		if(!found)
		{
			arraymedical.push({id,name,desc,quantity,price,partner});//id = medicalid, name = medicalname, 
			$('#bodyforaddmedical > tbody:last-child').append('<tr>'+
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
			'<td class="text-center">'+
				'<div><button type="button" id="deletemedical" class="form-control bg-dark text-white" data-button-delete-id="'+ lenght +'">ลบ</button></div>'+
			'</td>'+
			'</tr>');
		}
    })
	
	$('body').on("click.btn", '#export_medical', function () {
		if(arraymedical.length !== 0)
		{
			var jsonString = JSON.stringify(arraymedical);
		    $.ajax({
				type: "POST",
				url: "ajax/export.php",
				data: {data : jsonString, type : 'medical'}, 
				cache: false,

				success: function(data){
					alert(data);
					$("#bodyforaddmedical tr").empty();
					arraymedical = [];
					 location.reload();
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
});