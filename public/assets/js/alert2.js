
$('.alertDelete').submit(function(e){
    e.preventDefault();

    Swal.fire({
    title: 'Estas Seguro?',
    text: "No podrás revertir esto!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminarlo!'
    }).then((result) => {
    if (result.isConfirmed) {
        this.submit();
    }
    })
})
$('.alertEdits').submit(function(e){
    e.preventDefault();

    Swal.fire({
    title: 'Confirmar Cambios?',
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Actualizar!'
    }).then((result) => {
    if (result.isConfirmed) {
        this.submit();
    }
    })
})


