//To add diagnosis from drop list into text box
$("#diagnosis_data").on('change', function()
{
  $("#diagnosis").val($('#diagnosis').val() + ' - ' +
    $(this).find("option:selected").text());
});