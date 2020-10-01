var gettingDateIntoPage = function(){
    var monthNames = ["January - كانون الثاني", "February - شباط", "March - آذار", 
    	                  "April - نيسان", "May - أيار", "June - حزيران",
    					  "July - تموز", "August - آب", "September - أيلول", 
    					  "October - تشرين الأول", "November - تشرين الثاني", "December - كانون الاول"
  	];

  	var dateValue = $("#searchTxt").val();
  	//console.log(dateValue);
  	var getDate = new Date(dateValue);
  	var getMonth = getDate.getMonth();
  	var getMonthName = monthNames[getMonth];
  	var getYear = getDate.getFullYear();
  	//console.log(getMonthName);
  	$("#getMonthName").html(getMonthName+" "+getYear);

};

$(document).ready(function(){
  $("#searchTxt").on('change', gettingDateIntoPage);
})
