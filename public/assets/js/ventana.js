document.getElementById('url_img').addEventListener('change', function (e) {
    var file = e.target.files[0];
    var reader = new FileReader();
    
    reader.onload = function (event) {
      document.getElementById('previewImage').setAttribute('src', event.target.result);
    }
    
    reader.readAsDataURL(file);
  });

  $('[type=date]').change( function() {
    $(this).css('white-space','normal')
  });