// const Toast = Swal.mixin({
//     toast: true,
//     position: 'top-end',
//     showConfirmButton: false,
//     timer: 3000,
//     timerProgressBar: true,
//     didOpen: (toast) => {
//         toast.addEventListener('mouseenter', Swal.stopTimer)
//         toast.addEventListener('mouseleave', Swal.resumeTimer)
//     }
// }) TODO: ken thelket toasts nahi comment

window.addEventListener('added', event => {
    Toast.fire({
        icon: 'success',
        title: 'Zedneha fel favori'
    });
});

window.addEventListener('removed', event => {
    Toast.fire({
        icon: 'warning',
        title: 'Tna7at mel favori'
    })
});

$('#like').click(function () {
    $(this).addClass("fas fa-2x fa-thumbs-up vote");
    $('#dislike').removeClass("fas fa-2x fa-thumbs-down vote");
    $('#dislike').addClass("far fa-2x fa-thumbs-down vote");
});

$('#dislike').click(function () {
    $(this).addClass("fas fa-2x fa-thumbs-down vote");
    $('#like').removeClass("fas fa-2x fa-thumbs-up vote");
    $('#like').addClass("far fa-2x fa-thumbs-up vote");
});

$(document).ready(function () {
    $(".delete").hover(
        function () {
            $(this).removeClass("far fa-2x fa-trash-alt");
            $(this).addClass("fas fa-2x fa-trash-alt");
        },
        function () {
            $(this).removeClass("fas fa-2x fa-trash-alt");
            $(this).addClass("far fa-2x fa-trash-alt");
        }
    );
});
