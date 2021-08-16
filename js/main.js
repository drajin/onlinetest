
function RegisterLoginForm() {
    //select links
    this.loginLink = document.querySelectorAll('.loginLink');
    this.registerLink = document.querySelectorAll('.registerLink');

    //select views
    this.loginView = document.querySelector('#loginView');
    this.registerView = document.querySelector('#registerView');

    //add event listeners to links
    this.init = function() {
        for(let i=0; i<this.loginLink.length;  i++) {
            this.loginLink[i].addEventListener('click', this.showLogin.bind(this));
            this.registerLink[i].addEventListener('click', this.showRegister.bind(this));
        }
    };

    //show login view
    this.showLogin = function(e) {
        e.preventDefault();
        this.registerView.style.display = 'none';
        this.loginView.style.display = 'block';
    };
    //show register view
    this.showRegister = function(e) {
        e.preventDefault();
        this.registerView.style.display = 'block';
        this.loginView.style.display = 'none';
    };

}


let RegisterLogin = new RegisterLoginForm();
RegisterLogin.init();


DB.getAll().then((data)=>{
    console.log(data);
},(error)=>{
    console.log(error);
});

let firstNameInput = document.querySelector('[name="firstName"]');
let lastNameInput = document.querySelector('[name="lastName"]');
let emailInput = document.querySelector('[name="email"]');
let passwordInput = document.querySelector('[name="password"]');
let passwordConfirmInput = document.querySelector('[name="passwordConfirm"]');

let submitBtn = document.querySelector('#submitBtn');

submitBtn.addEventListener('click', registerNewUser);

function registerNewUser() {

    if(validateRegisterForm()) {
        let newUser = {
            first_name : firstNameInput.value,
            last_name : lastNameInput.value,
            email : emailInput.value,
            password :passwordInput.value,
            password_confirm : passwordConfirmInput.value,
        };
        DB.save(newUser);
    }

    }


function validateRegisterForm() {
    // get input values and trim to remove the whitespaces
    const firstNameValue = firstNameInput.value.trim();
    const lastNameValue = lastNameInput.value.trim();
    const emailValue = emailInput.value.trim();
    const passwordValue = passwordInput.value.trim();
    const passwordConfirmValue = passwordConfirmInput.value.trim();
    let formValid = false;

    // check input value
    if(firstNameValue === '') {
        setError(firstNameInput, 'First Name can\'t be blank');
        formValid = false;
    } else {
        setSuccess(firstNameInput);
        formValid = true;
    }

    if(lastNameValue === '') {
        setError(lastNameInput, 'Last Name can\'t be blank');
        formValid = false;
    } else {
        setSuccess(lastNameInput);
        formValid = true;
    }

    if(emailValue === '') {
        setError(emailInput, 'Email can\'t be blank');
        formValid = false;
    } else if (!isEmail(emailValue)) {
        setError(emailInput, 'This is not a valid email address');
        formValid = false;
    } else {
        setSuccess(emailInput);
        formValid = true;
    }

    if(passwordValue === '') {
        setError(passwordInput, 'Password can\'t be blank');
        formValid = false;
    } else if(passwordValue.length < 6){
        setError(passwordInput, 'Your password must be at least 6 characters long.');
        formValid = false;
    } else {
        setSuccess(passwordInput);
        formValid = true;
    }

    if(passwordConfirmValue === '') {
        setError(passwordConfirmInput, 'Password Confirm can\'t be blank');
        formValid = false;
     } else if(passwordValue !== passwordConfirmValue){
        setError(passwordConfirmInput, 'Password doesen\'t match.');
        formValid = false;
    } else {
        setSuccess(passwordConfirmInput);
        formValid = true;
    }

    function isEmail(email) {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
    }
    //show error message
    function setError(input, msg) {
        input.classList.add("is-invalid");
        input.nextElementSibling.innerText = msg ;


    }
    //show success
    function setSuccess(input) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
    }
    return formValid;
}

