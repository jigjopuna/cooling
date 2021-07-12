$(document).ready(function(){
		$("#btn-calngod").click(calucalatengod);
		$("#btn-free").click(freeship);		
		$("#btn-addroom").click(function(){ $('#addpage').css("display","block"); $('.amounts').css("display","none"); });
		$("#btn-compare").click(function(){ $('#compare').css("display","block")});
		
	});
	function calucalatengod(){
		
		var allprice = $('#totolprice').text().replace(/,/g, '');
		var firsts = (allprice*0.7).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		var seconds = (allprice*0.3).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		//var thirds = (allprice*0.2).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		
		
		$('.cal_ngo1').text(firsts);
		$('.cal_ngo2').text(seconds);
		//$('.cal_ngo3').text(thirds);
	}
	
	function freeship(){
		$('.fullpay').css("display","block");
		var prfupay = $('#pricefullpay').text();
		$('#fullpricepay').html(prfupay);
		
	}