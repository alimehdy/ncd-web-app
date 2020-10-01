var barcodeSearch = function()
{
	var barcodeValue = $("#barcode_nbr").val();
	//console.log(barcodeValue)
	$.ajax({
		url: '../php/searchByBarcode.php',
		type: 'POST',
		data: { barcode: barcodeValue },
		dataType: 'TEXT',
		success:function(resp)
		{
			console.log(resp);
			$("#medication_id").val(resp);
		},
		error:function(resp)
		{
			console.log(resp)
		}
	})
}

$(document).ready(function()
{
	$("#barcode_nbr").on('change', barcodeSearch);
	$("#barcode_nbr").on('keyup', barcodeSearch);
})