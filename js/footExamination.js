$(document).ready(function()
{
  $("#right_result").on('keyup', function(){
    var right_result = $("#right_result").val();
    //console.log(right_result)
    if(right_result>=4){
      $('.yes-val-r').prop('checked', true);
    }
    if(right_result>=0 && right_result<4){
      $('.no-val-r').prop('checked', true);
    }
    if(right_result==''){
      $('.yes-val-r').prop('checked', false);
      $('.no-val-r').prop('checked', false);
      //$('input[id="monofilament_right_left"]').prop('checked', false);
    }
  })
  $("#left_result").on('keyup', function(){
    var left_result = $("#left_result").val();
    //console.log(right_result)
    if(left_result>=4){
      $('.yes-val-l').prop('checked', true);
    }
    if(left_result>=0 && left_result<4){
      $('.no-val-l').prop('checked', true);
    }
    if(left_result==''){
      $('.yes-val-l').prop('checked', false);
      $('.no-val-l').prop('checked', false);
      //$('input[id="monofilament_right_left"]').prop('checked', false);
    }
  })
  $(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

  $('#foot_exam').on('click', function () {
    $('#myModal').modal('show');
  })


  // $('input[id=calluses_right]').on('click', function()
  // {

  // })

  $("#add_examination").on('click', function()
  {
    var date_of_exam = $("#date_of_exam").val();
    var pid = $("#patient_id_foot").val();
    var prev_ulcer_left = $('input[id=prev_ulcer_left]:checked').val();
    var prev_ulcer_right = $('input[id=prev_ulcer_right]:checked').val();
    var prev_amput_left = $('input[id=prev_amput_left]:checked').val();
    var prev_amput_right = $('input[id=prev_amput_right]:checked').val();
    var deformity_left = $('input[id=deformity_left]:checked').val();
    var deformity_right = $('input[id=deformity_right]:checked').val();
    var absent_pedal_left = $('input[id=absent_pedal_left]:checked').val();
    var absent_pedal_right = $('input[id=absent_pedal_right]:checked').val();
    var active_ulcer_left = $('input[id=active_ulcer_left]:checked').val();
    var active_ulcer_right = $('input[id=active_ulcer_right]:checked').val();
    var ingrown_left = $('input[id=ingrown_left]:checked').val();
    var ingrown_right = $('input[id=ingrown_right]:checked').val();
    var calluses_left = $('input[id=calluses_left]:checked').val();
    var calluses_right = $('input[id=calluses_right]:checked').val();
    var blisters_left = $('input[id=blisters_left]:checked').val();
    var blisters_right = $('input[id=blisters_right]:checked').val();
    var fissure_left = $('input[id=fissure_left]:checked').val();
    var fissure_right = $('input[id=fissure_right]:checked').val();
    var monofilament_right_left = $('input[id=monofilament_right_left]:checked').val();
    var monofilament_right_right = $('input[id=monofilament_right_right]:checked').val();
    var monofilament_left_left = $('input[id=monofilament_left_left]:checked').val();
    var monofilament_left_right = $('input[id=monofilament_left_right]:checked').val();

    if(date_of_exam=="")
    {
      $("#date_of_exam").focus();
      $("#date_of_exam").css('border-color', 'red')
    }
    //1
    else if(prev_ulcer_left==undefined)
    {
      $("#prev_ulcer_left").focus();
      $("#prev_ulcer_left").closest('td').addClass('flash');
      setTimeout(function() {
        $("#prev_ulcer_left").closest('td').removeClass('flash');
      }, 2000);
    }

    //2
    else if(prev_ulcer_right==undefined)
    {
      $("#prev_ulcer_right").focus();
      $("#prev_ulcer_right").closest('td').addClass('flash');
      setTimeout(function() {
        $("#prev_ulcer_right").closest('td').removeClass('flash');
      }, 2000);
    }
    
    //3
    else if(prev_amput_left==undefined)
    {
      $("#prev_amput_left").focus();
      $("#prev_amput_left").closest('td').addClass('flash');
      setTimeout(function() {
        $("#prev_amput_left").closest('td').removeClass('flash');
      }, 2000);
    }

    //4
    else if(prev_amput_right==undefined)
    {
      $("#prev_amput_right").focus();
      $("#prev_amput_right").closest('td').addClass('flash');
      setTimeout(function() {
        $("#prev_amput_right").closest('td').removeClass('flash');
      }, 2000);
    }

    //5
    else if(deformity_left==undefined)
    {
      $("#deformity_left").focus();
      $("#deformity_left").closest('td').addClass('flash');
      setTimeout(function() {
        $("#deformity_left").closest('td').removeClass('flash');
      }, 2000);
    }

    //6
    else if(deformity_right==undefined)
    {
      $("#deformity_right").focus();
      $("#deformity_right").closest('td').addClass('flash');
      setTimeout(function() {
        $("#deformity_right").closest('td').removeClass('flash');
      }, 2000);
    }

    //7
    else if(absent_pedal_left==undefined)
    {
      $("#absent_pedal_left").focus();
      $("#absent_pedal_left").closest('td').addClass('flash');
      setTimeout(function() {
        $("#absent_pedal_left").closest('td').removeClass('flash');
      }, 2000);
    }

    //8
    else if(absent_pedal_right==undefined)
    {
      $("#absent_pedal_right").focus();
      $("#absent_pedal_right").closest('td').addClass('flash');
      setTimeout(function() {
        $("#absent_pedal_right").closest('td').removeClass('flash');
      }, 2000);
    }

    //9
    else if(active_ulcer_left==undefined)
    {
      $("#active_ulcer_left").focus();
      $("#active_ulcer_left").closest('td').addClass('flash');
      setTimeout(function() {
        $("#active_ulcer_left").closest('td').removeClass('flash');
      }, 2000);
    }

    //10
    else if(active_ulcer_right==undefined)
    {
      $("#active_ulcer_right").focus();
      $("#active_ulcer_right").closest('td').addClass('flash');
      setTimeout(function() {
        $("#active_ulcer_right").closest('td').removeClass('flash');
      }, 2000);
    }

    //11
    else if(ingrown_left==undefined)
    {
      $("#ingrown_left").focus();
      $("#ingrown_left").closest('td').addClass('flash');
      setTimeout(function() {
        $("#ingrown_left").closest('td').removeClass('flash');
      }, 2000);
    }

    //12
    else if(ingrown_right==undefined)
    {
      $("#ingrown_right").focus();
      $("#ingrown_right").closest('td').addClass('flash');
      setTimeout(function() {
        $("#ingrown_right").closest('td').removeClass('flash');
      }, 2000);
    }

    //13
    else if(calluses_left==undefined)
    {
      $("#calluses_left").focus();
      $("#calluses_left").closest('td').addClass('flash');
      setTimeout(function() {
        $("#calluses_left").closest('td').removeClass('flash');
      }, 2000);
    }

    //14
    else if(calluses_right==undefined)
    {
      $("#calluses_right").focus();
      $("#calluses_right").closest('td').addClass('flash');
      setTimeout(function() {
        $("#calluses_right").closest('td').removeClass('flash');
      }, 2000);
    }

    //15
    else if(blisters_left==undefined)
    {
      $("#blisters_left").focus();
      $("#blisters_left").closest('td').addClass('flash');
      setTimeout(function() {
        $("#blisters_left").closest('td').removeClass('flash');
      }, 2000);
    }

    //16
    else if(blisters_right==undefined)
    {
      $("#blisters_right").focus();
      $("#blisters_right").closest('td').addClass('flash');
      setTimeout(function() {
        $("#blisters_right").closest('td').removeClass('flash');
      }, 2000);
    }

    //17
    else if(fissure_left==undefined)
    {
      $("#fissure_left").focus();
      $("#fissure_left").closest('td').addClass('flash');
      setTimeout(function() {
        $("#fissure_left").closest('td').removeClass('flash');
      }, 2000);
    }

    //18
    else if(fissure_right==undefined)
    {
      $("#fissure_right").focus();
      $("#fissure_right").closest('td').addClass('flash');
      setTimeout(function() {
        $("#fissure_right").closest('td').removeClass('flash');
      }, 2000);
    }

    //19
    else if(monofilament_right_left==undefined)
    {
      $("#monofilament_right_left").focus();
      $("#monofilament_right_left").closest('td').addClass('flash');
      setTimeout(function() {
        $("#monofilament_right_left").closest('td').removeClass('flash');
      }, 2000);
    }

    //20
    else if(monofilament_right_right==undefined)
    {
      $("#monofilament_right_right").focus();
      $("#monofilament_right_right").closest('td').addClass('flash');
      setTimeout(function() {
        $("#monofilament_right_right").closest('td').removeClass('flash');
      }, 2000);
    }

    //21
    else if(monofilament_left_left==undefined)
    {
      $("#monofilament_left_left").focus();
      $("#monofilament_left_left").closest('td').addClass('flash');
      setTimeout(function() {
        $("#monofilament_left_left").closest('td').removeClass('flash');
      }, 2000);
    }

    //22
    else if(monofilament_left_right==undefined)
    {
      $("#monofilament_left_right").focus();
      $("#monofilament_left_right").closest('td').addClass('flash');
      setTimeout(function() {
        $("#monofilament_left_right").closest('td').removeClass('flash');
      }, 2000);
    }

    else
    {
      $.ajax({
        url: '../php/footExamination.php',
        type: 'POST',
        data: {date_of_exam : date_of_exam,
              pid : pid,
              prev_ulcer_left : prev_ulcer_left,
              prev_ulcer_right : prev_ulcer_right,
              prev_amput_left : prev_amput_left,
              prev_amput_right : prev_amput_right,
              deformity_left : deformity_left,
              deformity_right : deformity_right,
              absent_pedal_left : absent_pedal_left,
              absent_pedal_right : absent_pedal_right,
              active_ulcer_left : active_ulcer_left,
              active_ulcer_right : active_ulcer_right,
              ingrown_left : ingrown_left,
              ingrown_right : ingrown_right,
              calluses_left : calluses_left,
              calluses_right : calluses_right,
              blisters_left : blisters_left,
              blisters_right : blisters_right,
              fissure_left : fissure_left,
              fissure_right : fissure_right,
              monofilament_right_left : monofilament_right_left,
              monofilament_right_right : monofilament_right_right,
              monofilament_left_left : monofilament_left_left,
              monofilament_left_right : monofilament_left_right},
        dataType: 'TEXT',

        success:function(resp)
        {
          if(resp=="added")
          {
            alert("Data added to database!");
          }
        },
        error:function(resp)
        {
          console.log(resp);
        }
      })
    }

  })
});