let token = JSON.parse(localStorage.getItem('token'));
let url = 'http://localhost/rapidkuantan-web/';
let loader = new bootstrap.Modal(document.getElementById('loader'));
let errors = {
    'email': 0,
    'password': 0,
    'bus': 0
};

$(document).ready(function () {

    $('#logout-btn').on('click', function () {
        localStorage.clear('token');
        location.replace('index.html');
    })

    // ajax jquery - login account
    $('#login-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: url + 'action.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                loader.show();
            },
            success: function (result) {
                if (result != 'false') {
                    localStorage.setItem('token', JSON.stringify(result));
                    location.replace('index.html');
                } else {
                    alert('Incorrect IC number or password.');
                }
            },
            error: function (e, s, t) {
                console.log(e);
                $('#info-container').html(
                    '<p class="text-danger p-2 bg-light">' +
                    '<i class="fas fa-exclamation-triangle fa-sm fa-fw"></i>' +
                    t +
                    '</p>'
                );
            },
            complete: function () {
                loader.hide();
            }
        });
    })

    // ajax jquery - create account | update account 
    $('#create-form, #profile-form').on('submit', function (e) {
        e.preventDefault();

        if (
            errors.email != 1 &&
            errors.password != 1
        )
            $.ajax({
                type: 'post',
                url: url + 'action.php',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    loader.show();
                },
                success: function (result) {
                    if (result != 'false') {
                        alert('Register your account success.');
                        localStorage.setItem('token', JSON.stringify(result));
                        location.replace('index.html');
                    } else {
                        alert('Failed to create or update your account, please try again.');
                    }
                },
                error: function (e, s, t) {
                    console.log(e);
                    $('#info-container').html(
                        '<p class="text-danger p-2 bg-light">' +
                        '<i class="fas fa-exclamation-triangle fa-sm fa-fw"></i>' +
                        t +
                        '</p>'
                    );
                },
                complete: function () {
                    loader.hide();
                }
            });
        else
            alert('Error creating account! Please check several form details below.');

    })

    // ajax jquery - update password 
    $('#password-form').on('submit', function (e) {
        e.preventDefault();

        if (
            errors.password != 1
        )
            $.ajax({
                type: 'post',
                url: url + 'action.php',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    loader.show();
                },
                success: function (result) {
                    if (result != 'false') {
                        alert('Password change success.');
                        location.replace('index.html');
                    } else {
                        alert('Failed to change your password, please try again.');
                    }
                },
                error: function (e, s, t) {
                    console.log(e);
                    $('#info-container').html(
                        '<p class="text-danger p-2 bg-light">' +
                        '<i class="fas fa-exclamation-triangle fa-sm fa-fw"></i>' +
                        t +
                        '</p>'
                    );
                },
                complete: function () {
                    loader.hide();
                }
            });
        else
            alert('Error changing password! Please check several form details below.');

    })

    // ajax jquery - check existing email 
    $('#email').on('keyup', function () {
        $.ajax({
            type: 'post',
            url: url + 'action.php',
            data: {
                action: 'check-email',
                email: this.value
            },
            dataType: 'json',
            success: function (result) {
                if (result != 'false') {
                    $('#email').addClass("border border-danger border-1");
                    errors.email = 1;
                } else {
                    $('#email').removeClass("border border-danger border-1");
                    errors.email = 0;
                }
            },
            error: function (e, s, t) {
                console.log(e);
                $('#info-container').html(
                    '<p class="text-danger p-2 bg-light">' +
                    '<i class="fas fa-exclamation-triangle fa-sm fa-fw"></i>' +
                    t +
                    '</p>'
                );
            },
        })
    })

    // compare password 
    $('#password, #confirmpassword').on('keyup', function () {
        if ($('#password').val() != $('#confirmpassword').val()) {
            $('#confirmpassword').addClass("border border-danger border-1");
            errors.password = 1;
        } else {
            $('#confirmpassword').removeClass("border border-danger border-1");
            errors.password = 0;
        }
    })

    // ajax jquery - create driver
    $('#driver-form').on('submit', function (e) {
        e.preventDefault();

        if (
            errors.email != 1
        )
            $.ajax({
                type: 'post',
                url: url + 'action.php',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    loader.show();
                },
                success: function (result) {
                    if (result != 'false') {
                        alert('Adding driver account success.');
                        location.reload();
                    } else
                        alert('Failed to add driver account, please try again.');
                },
                error: function (e, s, t) {
                    console.log(e);
                    $('#info-container').html(
                        '<p class="text-danger p-2 bg-light">' +
                        '<i class="fas fa-exclamation-triangle fa-sm fa-fw"></i>' +
                        t +
                        '</p>'
                    );
                },
                complete: function () {
                    loader.hide();
                }
            });
        else
            alert('Error adding driver account! Email address already existed, please try again with another email.');
    })

    // ajax jquery - create bus
    $('#bus-form').on('submit', function (e) {
        e.preventDefault();

        if (
            errors.bus != 1
        )
            $.ajax({
                type: 'post',
                url: url + 'action.php',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    loader.show();
                },
                success: function (result) {
                    if (result != 'false') {
                        alert('Adding bus success.');
                        location.reload();
                    } else
                        alert('Failed to add bus, please try again.');
                },
                error: function (e, s, t) {
                    console.log(e);
                    $('#info-container').html(
                        '<p class="text-danger p-2 bg-light">' +
                        '<i class="fas fa-exclamation-triangle fa-sm fa-fw"></i>' +
                        t +
                        '</p>'
                    );
                },
                complete: function () {
                    loader.hide();
                }
            });
        else
            alert('Error adding bus! Bus already existed, choose another route.');

    })

    // ajax jquery - check existing bus 
    $('#bus').on('keyup', function () {
        $.ajax({
            type: 'post',
            url: url + 'action.php',
            data: {
                action: 'check-bus',
                bus: this.value
            },
            dataType: 'json',
            success: function (result) {
                if (result != 'false') {
                    $('#bus').addClass("border border-danger");
                    errors.bus = 1;
                } else {
                    $('#bus').removeClass("border border-danger");
                    errors.bus = 0;
                }
            },
            error: function (e, s, t) {
                console.log(e);
                $('#info-container').html(
                    '<p class="text-danger p-2 bg-light">' +
                    '<i class="fas fa-exclamation-triangle fa-sm fa-fw"></i>' +
                    t +
                    '</p>'
                );
            },
        })
    })

    // ajax jquery - delete bus 
    $('body').on('click', '.delete-bus-btn', function () {
        $.ajax({
            type: 'post',
            url: url + 'action.php',
            data: {
                action: 'delete-bus',
                busid: this.value
            },
            dataType: 'json',
            success: function (result) {
                if (result != 'false')
                    location.reload();
                else
                    alert('Error while deleting bus.');
            },
            error: function (e, s, t) {
                console.log(e);
                $('#info-container').html(
                    '<p class="text-danger p-2 bg-light">' +
                    '<i class="fas fa-exclamation-triangle fa-sm fa-fw"></i>' +
                    t +
                    '</p>'
                );
            },
        })
    })

    // ajax jquery - delete driver 
    $('body').on('click', '.delete-driver-btn', function () {
        $.ajax({
            type: 'post',
            url: url + 'action.php',
            data: {
                action: 'delete-driver',
                driverid: this.value
            },
            dataType: 'json',
            success: function (result) {
                if (result != 'false')
                    location.reload();
                else
                    alert('Error while deleting driver.');
            },
            error: function (e, s, t) {
                console.log(e);
                $('#info-container').html(
                    '<p class="text-danger p-2 bg-light">' +
                    '<i class="fas fa-exclamation-triangle fa-sm fa-fw"></i>' +
                    t +
                    '</p>'
                );
            },
        })
    })

    // ============++++++++++==========+++++++++=========+++++++++==
    // swap display on profile view and update button
    $('#update-btn').on('click', function () {
        console.log(this);
        $('#profile-view, #profile-update').fadeToggle('fast', 'linear');
        $('#fullname').val(token.full_name);
        $('#icnumber').val(token.ic_number);
        $('#email').val(token.email);
        $('#uid-profile').val(token.id);
    });

    // swap display on profile view and password update button
    $('#back-btn').on('click', function () {
        $('#profile-view, #profile-update').fadeToggle('fast', 'linear');
    });

    // swap display on profile view and password update button
    $('#cancel-btn').on('click', function () {
        $('#profile-view, #password-update').fadeToggle('fast', 'linear');
    });

    // swap display on profile update and password update button
    $('#change-password-btn').on('click', function () {
        $('#profile-update, #password-update').fadeToggle('fast', 'linear');
        $('#uid-password').val(token.id);
    });

});