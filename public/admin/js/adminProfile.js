window.addEventListener('password-incorrect', event => {
    Swal.fire({
        icon: event.detail.icon,
        title: event.detail.title,
        text: event.detail.text,
        showConfirmButton: false,
    })
});

window.addEventListener('success', event => {
    Swal.fire({
        showConfirmButton: false,
        title: event.detail.title,
        icon: event.detail.icon,
    });
});

window.addEventListener('get-password', event => {
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
            if (event.detail.option == 0) {
                livewire.emit('logoutDevices', password);
            }
            else {
                livewire.emit('isEnabled', password, event.detail.enable);
            }
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