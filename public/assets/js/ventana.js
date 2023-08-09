
$(document).ready(function () {

  $('#submitBtn').click(function(e) {

      e.preventDefault();

      var password = $('#password').val();
      var passwordConfirmation = $('#password-confirm').val();
    
      if ((password === passwordConfirmation) && (password.length >= 8)) {
          $('#userRegister').submit();
      }
      else if(password != passwordConfirmation)
      {
        $('#password-lenght-message').css('display', 'none');
        $('#password-coincide-message').css('display', 'block');
      }
      else if(password.length < 8)
      {
        $('#password-coincide-message').css('display', 'none');
        $('#password-lenght-message').css('display', 'block');
      }

  });


  /* -----  EDIT ESTUDIANTE MODAL AJAX -------*/

  $('#EditarEstudiante').on('show.bs.modal', function(event){
	var button = $(event.relatedTarget)
	var url = button.data('url')
	var getDataUrl = button.data('send') 
	var modal = $(this)

	$.ajax({
		type: 'GET',
		url: getDataUrl,
		dataType: 'JSON',
		success: function (data)
		{
			var name = data.name
			var lastname = data.lastname
			var birthdate = data.bithdate
			var gender = data.gender
			var phone = data.phone_number
			var dni = data.dni
			var url_img = data.url_img

			modal.find('.name').val(name)
			modal.find('.lastname').val(lastname)
			modal.find('.birthdate').val(birthdate)
			modal.find('.gender').val(gender)
			modal.find('.phone_number').val(phone)
			modal.find('.dni').val(dni)
			modal.find('#previewImage').attr('src', url_img)
		},
		error: function(response){

		}
	})

	modal.find('#edit-students-form').attr('action', url)
  
  });
 
  /* -----  EDIT SECCION MODAL AJAX -------*/


  $('#SectionUpdateModal').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget)
    var url = button.data('url')
    var getDataUrl = button.data('send') 
    var modal = $(this)
  
    $.ajax({
      type: 'GET',
      url: getDataUrl,
      dataType: 'JSON',
      success: function (data)
      {
        var id_sectionType = data.id_sectiontype
        var id_level = data.id_level
        var name = data.section_name
        var level_name = data.level_name
        var sectionType_name = data.sectionType_name
  
        modal.find('.type_select').val(id_sectionType)
        modal.find('.type_select').text(sectionType_name)
        modal.find('.level-select').val(id_level)
        modal.find('.level-select').text(level_name)
        modal.find('.section_name').val(name)
      },
      error: function(response){
  
      }
    })
  
    modal.find('#SectionUpdate-form').attr('action', url)
    
    });




    $('#SectionUpdateStudentModal').on('show.bs.modal', function(event){
      var button = $(event.relatedTarget)
      var url = button.data('url')
      var getDataUrl = button.data('send') 
      var modal = $(this)

      $.ajax({
        type:'GET',
        url: getDataUrl,
        dataType: 'JSON',
        success: function(data)
        {
          var status = data.status;
          var name = data.completeName;

          modal.find('.student_name').val(name);
          if(status == 1)
          {
            modal.find('.activeSectionStudent').prop('checked', true);
          }else{
            modal.find('.activeSectionStudent').prop('checked', false);
          }
        }
      })

      modal.find('#SectionStudentUpdate-form').attr('action', url);

    });


    $('#SectionUpdateSubjectModal').on('show.bs.modal', function(event){
      var button = $(event.relatedTarget)
      var url = button.data('url')
      var getDataUrl = button.data('send')
      var modal = $(this)
      var select = modal.find('.select-teachers-subject');

      select.html("<option value='' selected disabled> Selecciona un profesor </option>");

      $.ajax({
        type:'GET',
        url: getDataUrl,
        dataType: 'JSON',
        success: function(arr)
        {
          $.each(arr['content'], function(indexes, values){
            select.append("<option value='"+values['id']+"'>"+values['name']+" "+values['lastname']+"</option>");
          });
        }
      })
      modal.find('#SectionSubjectUpdate-form').attr('action', url);
    });


    $('#btn-submit-updateSubjectSection').click(function(e){
      if($('#select-teachers-subject').val() != null)
      {
        $('#SectionUpdateSubjectModal').modal('toggle');
      }
    });
  

    /* ----------- FULL CALENDAR ------------*/

    $('.draggable-event').draggable({
      revert: true,
      revertDuration: 0
    });




    if($('#full-calendar-container').length)
    {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      var scheduleCaldendar = $('#full-calendar-container').fullCalendar({
        eventClick: function(calEvent){
          scheduleCaldendar.fullCalendar('removeEvents', [calEvent._id]);
        },
        editable: true,
        defaultView: 'agendaWeek',
        header: false,
        allDaySlot: false,
        columnHeaderFormat: 'dddd',
        dayNames: [
          'DOMINGO', 'LUNES', 'MARTES', 'MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO'
        ],
        selectHelper: true,
        droppable: true
      }); 


      $('#btn-schedule-save').click(function(e){
        e.preventDefault();
        var events= scheduleCaldendar.fullCalendar('clientEvents');
        var url = $(this).data('url');
        var de = [];

        if(events.length)
        {
          $.each(events, function(index, value){
            de.push({
              id: value._id,
              Item: [{
                title: value.title,
                start: value.start.format(),
                end: value.end.format(),
                id: value.className[0]
              }],
            })
          })
  
          $.ajax({
            type:'POST',
            url: url,
            data: {events:de},
            dataType: 'JSON',
            success: function(ele)
            {
              if(ele.message == 'stored')
              {
                Swal.fire({
                  position: 'top-center',
                  icon: 'success',
                  title: 'Guardado',
                  showConfirmButton: false,
                  timer: 1000
                })
              }
            },
            error: function(e){
              console.log(e.responseText);
            }
          })
        }
      })

    }
 


});















  /* -----  EDIT Materias MODAL AJAX -------*/

    
  $(document).ready(function () {

    $('#EditarMateria').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget)
    var url = button.data('url')
    var getDataUrl = button.data('send') 
    var modal = $(this)
  
    $.ajax({
      type: 'GET',
      url: getDataUrl,
      dataType: 'JSON',
      success: function (data)
      {
        var subject_name = data.subject_name
        modal.find('.subject_name').val(subject_name)
      },
      error: function(response){
        
      }
    })
  
    modal.find('#edit-subject-form').attr('action', url)
    
    });

  });





  /* ----- -------*/


document.getElementById('url_img').addEventListener('change', function (e) {
    var file = e.target.files[0];
    var reader = new FileReader();
    
    reader.onload = function (event) {
      document.getElementById('previewImage').setAttribute('src', event.target.result);
    }
  
    reader.readAsDataURL(file);
  });

  ///////
  $('[type=date]').change( function() {
    $(this).css('white-space','normal')
  });


/////////////////
document.querySelectorAll(".modal_img img").forEach(e=>{
  e.addEventListener("click",function(e){
    e.stopPropagation();
    this.parentNode.classList.add("active");
  })
});
document.querySelectorAll(".modal_img").forEach(e=>{
  e.addEventListener("click",function(e){
    this.parentNode.classList.add("active");
    console.log("Click")
  })
});

  


