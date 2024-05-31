// Retrieve checkbox state from local storage
var checkbox = document.getElementById('menu-collapse');
var isChecked = localStorage.getItem('checkboxState') === 'true';

// Set checkbox state
checkbox.checked = isChecked;

// Listen for changes and update local storage
checkbox.addEventListener('change', function () {
    localStorage.setItem('checkboxState', checkbox.checked);
});

// pop up activation function
function activateForm(name) {
    const formContainer = document.querySelector(`.${name}PopUp`);

    formContainer.classList.add('active');
}