function logoutSubmit() {
    Swal.fire({
        toast: true,
        position: 'top',
        icon: 'success',
        title: 'Logout berhasil',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fef2f2',
        color: document.documentElement.classList.contains('dark') ? '#f8fafc' : '#991b1b',
        showClass: { popup: '' },
        hideClass: { popup: '' },
        willClose: () => {
            document.getElementById('logout-form').submit();
        }
    });
}
