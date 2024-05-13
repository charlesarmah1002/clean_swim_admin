function createUser() {
    const form = document.getElementById('signUpForm'),
        submitButton = form.querySelector('button');

    form.onsubmit = (e) => {
        e.preventDefault();

        window.alert('this is the form')
    }
}

createUser();

/* 
 i will do a post to the create function on the controller 
 i should be able to handle the post request with the function 
 and but I wish I could probably make it better
*/