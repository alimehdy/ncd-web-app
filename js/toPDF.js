
$(function () {
	var specialElementHandlers = {
	    '#editor': function (element,renderer) {
	        return true;
	    }
	};
  	$('#pdf_this').click(function () {
  	$("#pdf_this").hide();
  	$("#print_this").hide();
    var doc = new jsPDF('a4');

    doc.addHTML($('#print_div')[0], 15, 15, {
      'background': '#fff',
      'height': 17000,'elementHandlers': specialElementHandlers
    }, function() {
      doc.save('patient_profile.pdf');
      $("#pdf_this").show();
  	  $("#print_this").show();
    });
  });
});