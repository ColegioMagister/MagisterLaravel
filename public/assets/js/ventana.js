
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
  
  
});




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

  


