$(function(){
	
	paceOptions = {
	  ajax: {
		trackMethods: ['GET', 'POST']
	  }
	};
	
	$(document).ajaxStart(function() { 
	   Pace.restart(); 
	});
	
	$('#checkAll').click(function(){
		if(this.checked) {
			$('input#chk[type=checkbox]').each(function(){
				$(this).prop('checked',true);
		   });  
		}
		else{
			$('input#chk[type=checkbox]').each(function(){
				$(this).prop('checked',false);
		   });
		}
	});


	// formato os numeros para moeda com ponto depois virgula
	function number_format (number, decimals, dec_point, thousands_sep) { 
		number = (number + '').replace(',', '').replace(' ', ''); 
		var n = !isFinite(+number) ? 0 : +number, 
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals), 
		sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep, dec = (typeof dec_point === 'undefined') ? ',' : dec_point, 
		s = '', 
		toFixedFix = function (n, prec) { 
		var k = Math.pow(10, prec); 
		return '' + Math.round(n * k) / k; }; 
		// Fix for IE parseFloat(0.55).toFixed(0) = 0; 
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.'); 
		if (s[0].length > 3) { 
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep); 
		} 
		if ((s[1] || '').length < prec) { 
			s[1] = s[1] || ''; 
			s[1] += new Array(prec - s[1].length + 1).join('0'); 
		} 
		return s.join(dec); 
	}

});