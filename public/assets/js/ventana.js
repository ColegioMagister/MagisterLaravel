import { valTeacher,valUser } from "./validaciones.js";


$(document).ready(function () {
  const Password=/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[@_+!#$%^&*()])[^\s]{3,}$/;

  $('#submitBtn').click(function(e) {

      e.preventDefault();
      var id_employee = $('#id_employee').val();
      var username = $('#username').val();
      var password = $('#password').val();
      var passwordConfirmation = $('#password-confirm').val();

      var validPass=Password.test(password);

      valUser(username,function(repitUser){
        if(repitUser) {
          $('#user_repit').show();
          $('#user_invalid').hide();
          $('#ModRegUsuario').modal('show');
        }else{
            if ((password === passwordConfirmation) && (password.length >= 8) && id_employee !=null && validPass) {
              $('#userRegister').submit();
            }else {
              (password != passwordConfirmation)? $('#password-lenght-message').hide() + $('#password-coincide-message').show():
                $('#password-coincide-message').hide();
              (password.length < 8 || !validPass ) ? $('#password-coincide-message').hide()+$('#password-lenght-message').show():
              $('#password-lenght-message').hide();
              (username.length<3) ? $('#user_repit').hide() + $('#user_invalid').show(): $('#user_invalid').hide()+$('#user_repit').hide();
              (id_employee==null) ? $('#employee_null').show(): $('#employee_null').hide();
            }
          }
      });
  });
})


  const Email=/^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
  const Letras=/^[A-Za-z\s]+$/;  
  const Numeros = /^[0-9]+$/; //num enteros

$(document).ready(function () {

  $('#btnTeacher').click(function(e){
    e.preventDefault();
    
    var id_role=$('#id_role').val();
    var name=$('#name').val();
    var lastname=$('#lastname').val();
    var email=$('#email').val();
    var phone=$('#phone_number').val();

    var validName= Letras.test(name);
    var validLastname= Letras.test(lastname);
    var validPhone= Numeros.test(phone);
    var validEmail= Email.test(email);

    (id_role ===""|| name==="" || lastname==="" || email==="" || phone ==="") ? $('#complet_campos').show():
    valTeacher(email,  function(repitEmail){
        repitEmail ? $('#email_repit').show() + $('#email_invalid').hide() + $('#ModRegTeacher').modal('show'):
          (id_role != null && validEmail && validName && validLastname && validPhone && phone.length===9) ? $('#teacher_register').submit():
            (id_role === null)?$('#rol_null').show():$('#rol_null').hide();
            ((!validName) || (name === "")) ? $('#name_invalid').show(): $('#name_invalid').hide();
            ((!validLastname) || (lastname === "")) ? $('#lastname_invalid').show(): $('#lastname_invalid').hide();
            ((!validPhone) || (phone ==="")) ? $('#phone_invalid').show() + $('#phone_lenthg').hide():$('#phone_invalid').hide();
            (phone.length!=9) ? $('#phone_lenthg').show() + $('#phone_invalid').hide(): $('#phone_lenthg').hide();
            ((!validEmail) || (email === "")) ? $('#email_invalid').show() + $('#email_repit').hide():$('#email_invalid').hide();
            if(repitEmail===false ){
              $('#email_repit').hide()
            }
            $('#complet_campos').hide()
    });

  })
 
    /* -----  EDIT PROFESOR MODAL AJAX -------*/

  $('#EditarProfesor').on('show.bs.modal', function(event){
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
        var id_role=data.id_role
        var role_name =data.role_name
        var name = data.name
        var lastname = data.lastname
        var phone_number = data.phone_number
        var email = data.email
        var url_img = data.url_img

        modal.find('.email').data('original-value', email);
        modal.find('.role_name').val(id_role)
        modal.find('.role_name').text(role_name)
        modal.find('.name').val(name)
        modal.find('.lastname').val(lastname)
        modal.find('.email').val(email)
        modal.find('.phone_number').val(phone_number)
        modal.find('#previewImage').attr('src', url_img)
      },
      error: function(response){
  
      }
    })
  
    modal.find('#edit-teacher-form').attr('action', url)
    
    }); 

    /* -----  VAlidar PROFESOR MODAL AJAX -------*/

    $('#btnEditTeacher').click(function(e) {
      e.preventDefault();
      var id_role = $('#id_role_edit').val();
      var name = $('#name_edit').val();
      var lastname = $('#lastname_edit').val();
      var email = $('#email_edit').val();
      var phone = $('#phone_number_edit').val();
      var modal = $('#EditarProfesor');
      var valorOriginal = modal.find('#email_edit').data('original-value');

      var validName = Letras.test(name);
      var validLastname = Letras.test(lastname);
      var validPhone = Numeros.test(phone);
      var validEmail = Email.test(email);

   

      if(id_role === "" || name === "" || lastname === "" || email === "" || phone === ""){
        $('#complet_campos_edit').show();
      }else {
        valTeacher(email,function(repitEmail){
              if(id_role != null && validEmail && validName && validLastname && validPhone && phone.length===9 && email==valorOriginal){
                $('#edit-teacher-form').submit()
                }else if(email!=valorOriginal && repitEmail){
                      $('#email_repit_edit').toggle() ;
                      $('#EditarProfesor').modal('show');
              } else{
                  (id_role === null) ? $('#rol_null_edit').toggle():
                  ((!validName) || (name === "")) ? $('#name_invalid_edit').toggle():
                  ((!validLastname) || (lastname === "")) ? $('#lastname_invalid_edit').toggle(): 
                  ((!validPhone) || (phone ==="")) ? $('#phone_invalid_edit').toggle():
                  (phone.length!=9) ? $('#phone_lenthg_edit').toggle():
                  ((!validEmail) || (email === "")) ? $('#email_invalid_edit').toggle():$('#edit-teacher-form').submit();
              }
              
        });
        
    }   
    //   }else if(id_role != null && validEmail && validName && validLastname && validPhone && phone.length===9 && email===valorOriginal){
    //     $('#edit-teacher-form').submit()
    //   }else{
    //     (id_role === null) ? $('#rol_null_edit').show():$('#rol_null_edit').hide();
    //     ((!validName) || (name === "")) ? $('#name_invalid_edit').show(): $('#name_invalid_edit').hide();
    //     ((!validLastname) || (lastname === "")) ? $('#lastname_invalid_edit').show(): $('#lastname_invalid_edit').hide();
    //     ((!validPhone) || (phone ==="")) ? $('#phone_invalid_edit').show() + $('#phone_lenthg_edit').hide():$('#phone_invalid_edit').hide();
    //     (phone.length!=9) ? $('#phone_lenthg_edit').show() + $('#phone_invalid_edit').hide(): $('#phone_lenthg_edit').hide();
    //     ((!validEmail) || (email === "")) ? $('#email_invalid_edit').show() + $('#email_repit_edit').hide():$('#email_invalid_edit').hide();
       
    //    if(email!=valorOriginal){
    //     valTeacher(email, function(repitEmail) {
    //       if(repitEmail) {
    //         $('#email_repit_edit').show() ;
    //         $('#email_invalid_edit').hide() ;
    //         $('#EditarProfesor').modal('show');
    //     }else{
    //       $('#edit-teacher-form').submit()
    //     }
    //   });
      
    // }   
     
  });

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


  /* -----  EDIT AÑO ESCOLAR MODAL AJAX -------*/

$('#EditarAñoEs').on('show.bs.modal', function(event){
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
      var id = data.id
      var period_name = data.period_name
      var start_date = data.start_date
      var end_date = data.end_date
      var status = data.status

      modal.find('.period_select').val(id)
      modal.find('.period_select').text(period_name)
      modal.find('.start_date').val(start_date)
      modal.find('.end_date').val(end_date)
      modal.find('.status').val(status)
    },
    error: function(response){

    }
  })

  modal.find('#edit-school_period-form').attr('action', url)
  
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




    /* ------ EDIT ASSESSMENT TYPE MODAL  ----------*/



    $('#AssessmentEditModal').on('show.bs.modal', function(event){
      var button = $(event.relatedTarget)
      var url = button.data('url')
      var getDataUrl = button.data('send')
      var modal = $(this)

      $.ajax({
        type: 'GET',
        url: getDataUrl,
        dataType: 'JSON',
        success: function(data)
        {
          var name = data.name
          var value = data.value
          modal.find('.name').val(name);
          modal.find('.value').val(value)
        }
      })
      modal.find('#editAssessmentForm').attr('action', url)

    })



  

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

      var calendarContainer = $('#full-calendar-container');
      var getEventsUrl = calendarContainer.data('url');
      var scheduleCaldendar = calendarContainer.fullCalendar({
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
        droppable: true,
        slotDuration: '00:20:00',
        events: getEventsUrl
      }); 

      $('#btn-schedule-save').click(function(e){
        e.preventDefault();
        var events= scheduleCaldendar.fullCalendar('clientEvents');
        var url = $(this).data('url');
        var gif_url = $(this).data('gif');
        var de = [];

        if(events.length)
        {
          Swal.fire({
            imageUrl: gif_url,
            title: 'Guardando...',
            text: 'Por favor, espere',
            showConfirmButton: false,
            allowOutsideClick: false
          });

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


    if($('#assessYearSelect').length)
    {
      $('#assessYearSelect').on('change', function(e){

        var getDataUrl = $(this).data('send');
        var year = $(this).val();
        var monthSelect = $('#assessMonthSelect');
        var daysSelect = $('#assessDaySelect');
        monthSelect.html("<option value='' selected disabled> Selecciona un mes </option>");
        daysSelect.html("<option value='' selected disabled> Selecciona un día </option>");

        $.ajax({
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: getDataUrl,
          dataType: 'JSON',
          data: {
            "year": year,
            "type": "loadYear"
          },
          success: function(e)
          {
            $.each(e, function(indexes, values){
              monthSelect.append('<option value="'+values+'">'+ values +'</option>')
            })
          }
        })
      });

      $('#assessMonthSelect').on('change', function(e){
        var getDataUrl = $(this).data('send');
        var month = $(this).val();
        var year = $('#assessYearSelect').val();
        var daysSelect = $('#assessDaySelect');
        daysSelect.html("<option value='' selected disabled> Selecciona un día </option>");

        $.ajax({
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: getDataUrl,
          dataType: 'JSON',
          data: {
            "month": month,
            "year": year,
            "type": "loadMonth"
          },
          success: function(e)
          {
            $.each(e, function(indexes, values){
              daysSelect.append('<option value="'+values+'">'+ values +'</option>')
            })
          }
        })

      });
    }


















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


    
    $('#AssesstUpdateStudentModal').on('show.bs.modal', function(event){
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
          var grade = data.grade;
          var name = data.nameStudent;

          modal.find('.student_name').val(name);
          modal.find('.grade').val(grade);
        }
      })

      modal.find('#AssesstUpdateStudentModal-form').attr('action', url);

    });


    $('#SubjectTeacherModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var url = button.data('url');
      var getDataUrl = button.data('send');
      var modal = $(this);

      $.ajax({
        type: 'GET',
        url: getDataUrl,
        dataType: 'JSON',
        success: function(data) {
            if (data.error_message) {
                alert(data.error_message);
                return;
            }
            
            var teacherName = data.teacher_name;

            modal.find('.teacher_name').val(teacherName);
        }
    });
          

      modal.find('#SubjectTeacherModal-form').attr('action', url);
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



  


