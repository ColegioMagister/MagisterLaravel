

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
  
//''''ajax formulario registar usuario

$(function() {
  $('#submitBtn').click(function(e) {
      e.preventDefault();
      $(this).html('Sendig..');

      var password = $('#password').val();
      var passwordConfirmation = $('#password-confirm').val();

      if (password === passwordConfirmation) {
          $.ajax({
              type: "POST",
              url: "{{ route('index.store') }}",
              data: $('#userRegister').serialize(),
              dataTipe:'json',
              success: function(data) { 
                $('#userRegister').trigger("reset");
                $('#ModRegUsuario').modal('hide');
                table.draw();
                
              },
              error:function(data){
                console.log('Error:',data);
                $('#submitBtn').html('Guarda changes')
              }
          });
      }
  });
});
