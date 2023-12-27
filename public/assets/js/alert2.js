$('.alertDelete').submit(function (e) {
    e.preventDefault();

    Swal.fire({
        title: '¡Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, eliminarlo!'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    })
})

$('.alertEdits').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    if (form.valid()) {
        form.closest('.modal').modal('toggle');
        Swal.fire({
            title: 'Confirmar cambios',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, Actualizar!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    }


})


