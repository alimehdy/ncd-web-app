  $(document).ready(function(){
  $.ajax
  ({
    url: '../php/getAvg.php',
    type: 'POST',
    dataType: 'JSON',
    success:function(resp)
    {
      var assessmentDate = [];
      var avgAssessment = [];
      $.each(resp, function( key, row)
      {
        assessmentDate.push(row['assessmentDate']);
        avgAssessment.push(row['avgAssessment']);
      });


        var areaChartData = {
          labels: assessmentDate,
          datasets: [
            {
              label: "Assessment Average (%)",
              fill: true,
              borderColor: '#0090ff',
              backgroundColor: '#EC932F',
              pointBorderColor: '#ffffff',
              pointBackgroundColor: '#EC932F',
              pointHoverBackgroundColor: '#EC932F',
              pointHoverBorderColor: '#EC932F',
              data: avgAssessment
            }

          ],

        };
        
        var ctx = $("#mycanvas");

        var barGraph = new Chart(ctx, {
          type: 'line',
          data: areaChartData

        });
      },
      error:function(resp)
      {
        console.log(resp);
      }
    });
});