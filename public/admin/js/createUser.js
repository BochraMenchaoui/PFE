window.addEventListener('name-updated', event => {
    if (event.detail.badge == 0) {
        $('#badge').addClass("bg-danger");
        $('#badgeRole').empty();
        $('#badgeRole').append('Admin');
    }
    if (event.detail.badge == 1) {
        $('#badge').addClass("bg-warning");
        $('#badgeRole').empty();
        $('#badgeRole').append('Collaborator');
    }
    if (event.detail.badge == 2) {
        $('#badge').addClass("bg-success");
        $('#badgeRole').empty();
        $('#badgeRole').append('User');
    }
});

window.addEventListener('user-created', event => {
    Swal.fire({
        showConfirmButton: false,
        title: event.detail.title,
        icon: event.detail.icon,
    });
});