window.addEventListener('delete', event => {
    Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.icon,
        showCancelButton: true,
        confirmButtonText: event.detail.confirmButtonText,
        cancelButtonText: event.detail.cancelButtonText,
        reverseButtons: true
    })
        .then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('delete');
            }
        });
})

window.addEventListener('documented-imported', event => {
    Swal.fire({
        showConfirmButton: false,
        title: event.detail.title,
        icon: event.detail.icon,
    });
});

window.addEventListener('word-published', event => {
    Swal.fire({
        showConfirmButton: false,
        title: event.detail.title,
        icon: event.detail.icon,
    });
});

window.addEventListener('delete-comment', event => {
    Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.icon,
        showCancelButton: true,
        confirmButtonText: event.detail.confirmButtonText,
        cancelButtonText: event.detail.cancelButtonText,
        reverseButtons: true
    })
        .then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('deleteSelected');
            }
        });
})