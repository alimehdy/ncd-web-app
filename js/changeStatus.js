$(document).ready(function()
{
	$(document).on('change', '.patient_status', function() {
    var $select = $(this);
    var $tr = $select.closest('tr');
    var pid = $tr.attr('id');
    var $status = $tr.children('td.change_status');
    var current_status = $status.text();
    var new_status = $select.val();
    console.log(new_status);
    if (current_status == new_status) {
      alert("The status selected is already the same!");
    }

    else {
      if (confirm("Are you sure you want to change the status of a patient ?")) {
        
        //console.log(pid + " " + new_status);
        $.ajax({
          url: '../php/changeStatus.php',
          type: 'POST',
          dataType: 'TEXT',
          data: { pid: pid, new_status: new_status },
          success: function(resp) {
          	if(resp=="updated")
          	{
          		$status.text(new_status);
          		//console.log(resp);
          	}
          },
          error: function(resp) {}
        });
      }
    }
  });
});