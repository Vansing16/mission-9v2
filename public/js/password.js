$(document).ready(function() {
    $('#newPassword, #confirmNewPassword').on('keyup', function () {
        if ($('#newPassword').val() === $('#confirmNewPassword').val()) {
            $('#confirmNewPassword').removeClass('is-invalid').addClass('is-valid');
        } else {
            $('#confirmNewPassword').removeClass('is-valid').addClass('is-invalid');
        }
    });
});