$(document).ready(function(){
	$("#minimize1").click(function()
	{
		$("#table1").slideToggle();
		$("#minimize1").find('i').toggleClass('fa-plus fa-minus');
	});
	$("#minimize2").click(function()
	{
		$("#table2").slideToggle();
		$("#minimize2").find('i').toggleClass('fa-plus fa-minus');
	});
	$("#minimize3").click(function()
	{
		$("#table3").slideToggle();
		$("#minimize3").find('i').toggleClass('fa-plus fa-minus');
	});
});