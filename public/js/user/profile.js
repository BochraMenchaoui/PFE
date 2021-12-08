window.addEventListener('profile-updated', event => {
    Swal.fire({
        showConfirmButton: false,
        title: event.detail.title,
        icon: event.detail.icon,
    });
});

window.addEventListener('new-password', event => {
    (async () => {

        const {
            value: password
        } = await Swal.fire({
            title: event.detail.title,
            input: event.detail.input,
            inputLabel: event.detail.inputLabel,
            showConfirmButton: false,
            inputAttributes: {
                maxlength: 255,
                autocapitalize: 'off',
                autocorrect: 'off'
            }
        })

        if (password) {
            livewire.emit('newPassword', password);
        }

    })()
});

window.addEventListener('password-incorrect', event => {
    Swal.fire({
        icon: event.detail.icon,
        title: event.detail.title,
        text: event.detail.text,
        showConfirmButton: false,
    })
});

window.addEventListener('profile-delete', event => {
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