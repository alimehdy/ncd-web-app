$(document).ready(function()
{
	$(document).on('change', '.patient_status', function() {
    var $select = $(this);
    var $tr = $select.closest('tr');
    var pid = $tr.attr('id');
    console.log(pid)
    var $status = $tr.children('td.change_status');
    var current_status = $status.text();
    var new_status = $select.val();
    console.log(new_status);
    if (current_status == new_status) {
      alert("The status selected is already the same!");
    }

    else {
      if (confirm("Are you sure you want to change the status of this visit?")) {
        
        //console.log(pid + " " + new_status);
        $.ajax({
          url: '../php/changeVisitStatusNoSearch.php',
          type: 'POST',
          dataType: 'TEXT',
          data: { pid: pid, new_status: new_status },
          success: function(resp) {
          	if(resp=="updated")
          	{
          		$status.text(new_status);
          		//console.log(resp);
              if(new_status=="Inactive")
              {
                $.ajax({
                  url: '../php/changeQuantity.php',
                  type: 'POST',
                  data: { vid: pid },
                  dataType: 'TEXT',
                  success:function(response)
                  {
                    if(response=="updated")
                    {
                      console.log(response);
                    }
                  },
                  error:function(response)
                  {
                    console.log(response);
                  }
                })
              }
              if(new_status=="Active")
              {
                alert("Please click on Add Results/Medications button to add medication if patient took on that visit");
              }
          	}
          },
          error: function(resp) {}
        });
      }
    }
  });
});