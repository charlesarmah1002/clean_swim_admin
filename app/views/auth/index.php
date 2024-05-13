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
            <h1>Welcome Back!</h1>
            <p class="errorText"></p>
            <form action="" id="logInForm">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <button>Log In</button>
            </form>
            <p>Don't have an account? <a href="register">Create an account</a> </p>
        </div>
    </div>
</body>

<script>
    function validateUser(){
        const form = document.getElementById('logInForm'),
            submitButton = form.querySelector('button'),
            errorText = document.querySelector('.errorText');

        form.onsubmit = (e) => {
            e.preventDefault();

            let xhr = new XMLHttpRequest();

            xhr.open('POST', 'validateUser', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText); // Response from the PHP controller

                        const response = JSON.parse(xhr.responseText);

                        if (response.success === true) {
                            location.href = '../../public/';
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

    validateUser();
</script>

</html>