$(document).ready(function(){
	$('#med_table').on('click', '.tdSel', function() {
		//console.log($(this).attr('data-counter'));
		//Get Med ID:
		var mid = $("#searchTxt").val();
		
		var thisVar = $(this);
		var num_pills = ($(this).text());
		$(this).val("");
		var id = $(this).closest('tr').attr('id');
		console.log(num_pills);
		$(this).replaceWith('<input type="number" id="test" class="form-control select" value='+num_pills+'>')
		$('#med_table #test').on('focusout', function()
		{
			var new_quantity = $(this).val();
			var html = '<td id="test" class="tdSel">'+new_quantity+'</td>';
			$(this).replaceWith(html);
			//$(this).html(new_quantity)
			console.log(new_quantity);
			//alert("out");
			//Ajax
			if((id !== null || id !== "") && (new_quantity!=="" || new_quantity!==null) && num_pills!==new_quantity)
			{
				$.ajax({
					url: '../php/changeMedQuantity.php',
					type: 'POST',
					data: {med_id: id, new_quantity: new_quantity},
					datatype: 'TEXT',
					success:function(resp)
					{
						if(resp=="success")
						{
							$.ajax({
								url: '../php/getRemaining.php',
								type: 'POST',
								data: {mid: mid},
								dataType: 'TEXT',
								success:function(res)
								{
									$("#still_pill_ajax").text(res);
								},
								error:function(res)
								{
									console.log(res);
								}
							})
						}
					},
					error:function(resp)
					{
						console.log(resp)
					}
				})
			}
		})
		
	});
})