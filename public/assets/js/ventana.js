//''''ajax formulario registar usuario

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

  


