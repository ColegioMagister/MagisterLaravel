@if (session('flash_message') == 'deleted!')
    <script>
        Swal.fire(
            'Eliminado!',
            'Correctamente',
            'success'
        )
    </script>
@endif
@if (session('flash_message') == 'Addedd!')
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Guardado',
            showConfirmButton: false,
            timer: 1000
        })
    </script>
@endif
@if (session('flash_message') == 'Updated!')
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Actualizado',
            showConfirmButton: false,
            timer: 1000
        })
    </script>
@endif
@if (session('error_message') == 'Error!')
    <script>
        Swal.fire(
            'Error!',
            'Ya ha sido registrado',
            'error'
        )
    </script>
@endif
