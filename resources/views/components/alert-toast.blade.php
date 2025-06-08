@if (session('success'))
<script>
    Swal.fire({
        toast: true,
        position: 'top',
        icon: 'success',
        title: 'Berhasil!',
        text: @json(session('success')),
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        customClass: {
            popup: 'swal2-custom-toast'
        },
        showClass: {
            popup: ''
        },
        hideClass: {
            popup: ''
        }
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        toast: true,
        position: 'top',
        icon: 'error',
        title: 'Oops!',
        text: @json(session('error')),
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        customClass: {
            popup: 'swal2-custom-toast'
        },
        showClass: {
            popup: ''
        },
        hideClass: {
            popup: ''
        }
    });
</script>
@endif