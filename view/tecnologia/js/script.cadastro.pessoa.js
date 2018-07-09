$(function(){
	$('#uf').change(function(){
		if( $(this).val() ) {
			$('#cidade').hide();
			$.getJSON('controller/global/cidades.ajax.php?search=',{uf: $(this).val(), ajax: 'true'}, function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].HANDLE + '">' + j[i].CIDADE + '</option>';
				}	
				$('#cidade').html(options).show();
			});
		} else {
			$('#cidade').html('<option value="">-- Escolha um estado --</option>');
		}
	});
	
	$('#cidade').change(function(){
		if( $(this).val() ) {
			$('#bairro').hide();
			$.getJSON('controller/global/bairros.ajax.php?search=',{cidade: $(this).val(), ajax: 'true'}, function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].HANDLE + '">' + j[i].NOME + '</option>';
				}	
				$('#bairro').html(options).show();
			});
		} else {
			$('#cidade').html('<option value="">-- Escolha uma cidade --</option>');
		}
	});
});