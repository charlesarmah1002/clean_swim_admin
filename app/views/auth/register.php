<?php 

/* if (isset($_SESSION['email'])) {
    header('location: test');
} */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth</title>

    <link rel="stylesheet" href="../css/auth.css">
</head>

<body>

    <div id="container">
        <div class="form-container">
            <h1>Sign Up</h1>
            <p class="errorText"></p>
            <form action="" id="signUpForm">
                <input type="text" name="fname" id="fname" placeholder="First Name" required>
                <input type="text" name="lname" id="lname" placeholder="Last Name" required>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="text" name="country-code" id="country-code" placeholder="eg +233" value="+" required>
                <input type="tel" name="phone" id="phone" placeholder="Phone Number" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                <button>Sign Up</button>
            </form>
            <p>Already have an account? <a href="index">Log in</a></p>
        </div>
    </div>
</body>

<script>
    // location.href = '../home/';

    function createUser() {
        const form = document.getElementById('signUpForm'),
            submitButton = form.querySelector('button'),
            errorText = document.querySelector('.errorText');

        form.onsubmit = (e) => {
            e.preventDefault();

            let xhr = new XMLHttpRequest();

            xhr.open('POST', 'create', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText); // Response from the PHP controller

                        const response = JSON.parse(xhr.responseText);

                        if (response.success == true) {
                            location.reload();
                            location.href = '../';

                        } else {
                            // Display error message
                            errorText.innerHTML = response.message;
                        }
                    } else {
                        console.error('Request failed:', xhr.status);
                    }
                }
            };

            let formData = new FormData(form);
            xhr.send(formData);
        };
    }

    createUser();
</script>

</html>