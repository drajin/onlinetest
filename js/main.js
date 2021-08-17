//select inputs
let firstNameInput = document.querySelector('[name="firstName"]');
let lastNameInput = document.querySelector('[name="lastName"]');
let emailRegisterInput = document.querySelector('#emailRegister');
let passwordRegisterInput = document.querySelector('#passwordRegister');
let passwordConfirmInput = document.querySelector('[name="passwordConfirm"]');








let submitRegisterBtn = document.querySelector('#submitRegister');
let submitLoginBtn = document.querySelector('#submitLogin');



function ShowView() {
    //select links
    this.loginLink = document.querySelectorAll('.loginLink');
    this.registerLink = document.querySelectorAll('.registerLink');

    //select views
    this.loginView = document.querySelector('#loginView');
    this.registerView = document.querySelector('#registerView');
    this.welcomeView = document.querySelector('#welcomeView');

    //add event listeners to links
    this.init = function() {
        for(let i=0; i<this.loginLink.length;  i++) {
            this.loginLink[i].addEventListener('click', this.login.bind(this));
            this.registerLink[i].addEventListener('click', this.register.bind(this));
        }
    };

    //show login view
    this.login = function() {
        this.registerView.style.display = 'none';
        this.loginView.style.display = 'block';
    };
    //show register view
    this.register = function(e) {
        e.preventDefault();
        this.registerView.style.display = 'block';
        this.loginView.style.display = 'none';
    };

    //show welcome view
    this.welcome = function() {
        this.welcomeView.style.display = 'block';
        this.registerView.style.display = 'none';
        this.loginView.style.display = 'none';
    }

}


let showView = new ShowView();
showView.init();


DB.getAll().then((data)=>{
    console.log(data);
},(error)=>{
    console.log(error);
});





submitRegisterBtn.addEventListener('click', registerNewUser);
submitLoginBtn.addEventListener('click', loginUser);

let validateForm = new ValidateForm();

function registerNewUser() {
    if(!validateRegisterForm()) {
        let newUser = {
            first_name : firstNameInput.value,
            last_name : lastNameInput.value,
            email : emailRegisterInput.value,
            password :passwordRegisterInput.value,
            password_confirm : passwordConfirmInput.value,
        };
        DB.register(newUser).then((response) => {
            showView.login();
            showAlert('alert-success', 'You are now registered, please login.');
            },(error)=>{
            console.log(error);
        })
    }

    }

function loginUser() {
        //validation
    validateForm.login()
    // if(!validateForm.login()) {
    //     let loginData = {
    //         email : emailInput.value,
    //         password :passwordInput.value,
    //     };
    //     DB.login(loginData).then((response) => {
    //         showView.welcome();
    //     },(error)=>{
    //         console.log(error);
    //     })
    // }


}

function ValidateForm() {

    this.hasError = false;

    this.login = function() {
        this.checkEmail();
        this.checkPassword();
        return this.hasError;
    };

    this.checkEmail = function() {
        this.emailLoginInput = document.querySelector('#emailLogin');
        this.passwordLoginInput = document.querySelector('#passwordLogin');

        this.emailValue = this.emailLoginInput.value.trim(); //ovde ne uvati
        this.passwordValue = this.passwordLoginInput.value.trim();
        if(this.emailValue === '') {
            this.setError(this.emailLoginInput, 'Email can\'t be blank');
            this.hasError = true;
        } else if (!this.isEmail(this.emailValue)) {
            this.setError(this.emailLoginInput, 'This is not a valid email address');
            this.hasError = true;
        } else {
            this.setSuccess(this.emailLoginInput);
        }
    };


    this.checkPassword = function() {
        if(this.passwordValue === '') {
            this.setError(this.passwordLoginInput, 'Password can\'t be blank');
            this.hasError = true;
        } else {
            this.setSuccess(this.passwordLoginInput);
        }
    };

    this.isEmail = function(email) {
        alert('poz');
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
    };

    //show error message
    this.setError = function (input, msg) {
        input.classList.add("is-invalid");
        input.nextElementSibling.innerText = msg ;
    };
    //show success
    this.setSuccess = function(input) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
    };


} //ValidateForm





function validateRegisterForm() {
    // get input values and trim to remove the whitespaces
    const firstNameValue = firstNameInput.value.trim();
    const lastNameValue = lastNameInput.value.trim();
    const emailValue = emailRegisterInput.value.trim();
    const passwordValue = passwordRegisterInput.value.trim();
    const passwordConfirmValue = passwordConfirmInput.value.trim();
    let  hasError = false;

    // check input value
    if(firstNameValue === '') {
        setError(firstNameInput, 'First Name can\'t be blank');
        hasError = true;
    } else {
        setSuccess(firstNameInput);
    }

    if(lastNameValue === '') {
        setError(lastNameInput, 'Last Name can\'t be blank');
        hasError = true;
    } else {
        setSuccess(lastNameInput);
    }

    if(emailValue === '') {
        setError(emailRegisterInput, 'Email can\'t be blank');
        hasError = true;
    } else if (!isEmail(emailValue)) {
        setError(emailRegisterInput, 'This is not a valid email address');
        hasError = true;
    } else {
        setSuccess(emailRegisterInput);
    }

    if(passwordValue === '') {
        setError(passwordRegisterInput, 'Password can\'t be blank');
        hasError = true;
    } else if(passwordValue.length < 6){
        setError(passwordRegisterInput, 'Your password must be at least 6 characters long.');
        hasError = true;
    } else {
        setSuccess(passwordRegisterInput);
    }

    if(passwordConfirmValue === '') {
        setError(passwordConfirmInput, 'Password Confirm can\'t be blank');
        hasError = true;
    } else if(passwordValue !== passwordConfirmValue){
        setError(passwordConfirmInput, 'Password doesen\'t match.');
        hasError = true;
    } else {
        setSuccess(passwordConfirmInput);
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
    return hasError;
}

function showAlert(alertType, msg) {
    let alertPlaceholder = document.querySelector('.alertPlaceholder');
    let alert = document.createElement('div');
    alert.className = 'alert ';
    alert.className += alertType;
    alert.setAttribute("role", "alert");
    alert.innerText = msg;
    alertPlaceholder.append(alert);
    setTimeout(() => {
        alertPlaceholder.removeChild(alert);
    },6000);


}