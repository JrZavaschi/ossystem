$(function(){
	function calcular(){
		var valorVenda = getMoney('valorCusto') * getMoney('margemLucro') / 100;

		if (Number.isNaN(valorVenda)){
				valorVenda  = 0; // zerando caso seja NaN
		}

		id('ValorVenda').value = number_format(valorVenda, 2, ',', '.');
	}
});