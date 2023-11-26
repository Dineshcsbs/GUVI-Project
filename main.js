$(document).ready(function () {
    $('#registerForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'register.php',
            data: $('#registerForm').serialize(),
            success: function (response) {
                alert(response);
                if (response!=null) {
                   
                    // Redirect to index.html after successful registration
                    window.location.href= 'index.html';
                }
            }
        });
    });

    $('#loginForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'login.php',
            data: $('#loginForm').serialize(),
            success: function (response) {
                alert(response);

                if (response === 'Login successful!') {
                    // Redirect to profile.html after successful login
                    window.location.href = 'profile.php';
                }
            }
        });
   
    });
    $('#profileform').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'registerprofile.php',
            data: $('#profileform').serialize(),
            success: function (response) {
                alert(response);

                if (response === 'Registration successful!') {
                    window.location.href = 'profile.php';
                }
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    });
 // Fetch Profile Details
 $.ajax({
    type: 'GET',
    url: 'profile.php',
    success: function (response) {
       
    }
});
});
