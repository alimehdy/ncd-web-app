function printing1()
{
  // $("#print_div").show();
  //  $("#print_div").show().append("<link rel='stylesheet' href='../css/bootstrap.min.css' media='print' />");
  // window.print();

   var divToPrint=document.getElementById("wait");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);

  var css = "table, td, th { \n"+
  "    border: 1px solid black; \n"+
  "    txt-align:justify; \n"+
  "} \n"+
  "th {  \n"+
  "    background-color: #7a7878; \n"+
  "    text-align:left; \n"+
  "}";
   var div = $("<div />", {
    html: '&shy;<style>' + css + '</style>'
    }).appendTo( newWin.document.body);
   newWin.print();
   newWin.close();

}

$(document).ready(function()
{
  $("#print_this").on('click', function()
  {

    $("#print_this").hide();
    $("#pdf_this").hide();
    printing1();
    $("#print_this").show();
    $("#pdf_this").show();
  });
});