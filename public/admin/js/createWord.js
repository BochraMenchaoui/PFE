window.addEventListener('word-created', event => {
    Swal.fire({
        showConfirmButton: false,
        title: event.detail.title,
        icon: event.detail.icon,
    });
});