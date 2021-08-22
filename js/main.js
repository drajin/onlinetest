//select inputs
let firstNameInput = document.querySelector('[name="firstName"]');
let lastNameInput = document.querySelector('[name="lastName"]');
let emailInput = document.querySelector('#emailRegister');
let passwordInput = document.querySelector('#passwordRegister');
let passwordConfirmInput = document.querySelector('[name="passwordConfirm"]');

//select values
let firstNameValue;
let lastNameValue;
let emailValue;
let passwordValue;
let passwordConfirmValue;

//select buttons
let submitRegisterBtn = document.querySelector('#submitRegister');
let submitLoginBtn = document.querySelector('#submitLogin');

//select forms

let loginForm = document.getElementById("login");
let registerForm = document.getElementById("register");

//add events
submitRegisterBtn.addEventListener('click', registerNewUser);
submitLoginBtn.addEventListener('click', loginUser);



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
    this.register = function() {
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



//show views
let showView = new ShowView();
showView.init();
//initializes form class
let validateForm = new ValidateForm();


DB.getAll().then((data)=>{
    console.log(data);
},(error)=>{
    console.log(error);
});


function registerNewUser(e) {
    e.preventDefault();
    //set input values
    emailInput = document.querySelector('#emailRegister');
    passwordInput = document.querySelector('#passwordRegister');


    firstNameValue = firstNameInput.value.trim();
    lastNameValue = lastNameInput.value.trim();
    emailValue = emailInput.value.trim();
    passwordValue = passwordInput.value.trim();
    passwordConfirmValue = passwordConfirmInput.value.trim();

        if(validateForm.register()) {
            //console.log(validateForm.register);
            let newUser = {
                first_name : firstNameValue,
                last_name : lastNameValue,
                email : emailValue,
                password :passwordValue,
                password_confirm : passwordConfirmValue,
            };
            registerForm.reset();
            loginForm.reset();
            DB.register(newUser).then((response) => {
                showView.login();
                showAlert('alert-success', 'You are now registered, please login.');
                },(error)=>{
                console.log(error);
            })
            }
    }

function loginUser(e) {
    e.preventDefault();

    //select different email and password input
    emailInput = document.querySelector('#emailLogin');
    passwordInput = document.querySelector('#passwordLogin');

    //set input values
    emailValue = emailInput.value.trim();
    passwordValue = passwordInput.value.trim();
    if(validateForm.login()) {
        let loginData = {
            email : emailInput.value,
            password :passwordInput.value,
        };
        registerForm.reset();
        loginForm.reset();
        DB.login(loginData).then((response) => {
            //console.log(response);
            if(response) {
                showView.welcome();
            } else {
                showAlert('alert-danger', 'Incorrect Email and Password Combination.');
            }


        },(error)=>{
            console.log(error);
        })
    }


}

function ValidateForm() {

    this.uniqeEmail = '';
    let unii = '';

    this.login = function() {
        this.hasNoError = true;
        this.checkEmail();
        this.checkPassword();
        return this.hasNoError;
    };

    this.register = function() {
        this.hasNoError = true;
        this.checkFirstName();
        this.checkLastName();
        this.checkEmail();
        this.checkPassword();
        this.checkPasswordConfirm();
        return this.hasNoError;
    };


    this.checkFirstName = function() {

        if(firstNameValue === '') {
            this.setError(firstNameInput, 'First Name can\'t be blank');
        } else {
            this.setSuccess(firstNameInput);
        }
    };

    this.checkLastName = function() {
        if(lastNameValue === '') {
            this.setError(lastNameInput, 'Last Name can\'t be blank');
        } else {
            this.setSuccess(lastNameInput);
        }
    };


    this.checkEmail = function() {
        //console.log(this.emailUnique()); returns undefined
        if(emailValue === '') {
            this.setError(emailInput, 'Email can\'t be blank.');
        }
        else if (!this.isEmail(emailValue)) {
            this.setError(emailInput, 'This is not a valid email address.');
        }

        // else if (this.emailUnique()) {
        //     this.setError(emailInput, 'Email address is already registered.');
        // }
        else {
            this.setSuccess(emailInput);
        }


    }// end fun

    // this.emailExists = function() {
    //         DB.checkEmail(emailValue).then((user)=>{
    //             if(emailValue === user.email) {
    //                 this.setError(emailInput, 'Email address is already registered.');
    //             }
    //         },(err)=>{
    //            //
    //         })
    // };


    this.checkPassword = function() {
        if(passwordValue === '') {
            this.setError(passwordInput, 'Password can\'t be blank.');
        } else {
            this.setSuccess(passwordInput);
        }
    };

    this.checkPasswordConfirm = function() {
        if(passwordConfirmValue === '') {
            this.setError(passwordConfirmInput, 'Password Confirm can\'t be blank.');
        } else if(passwordValue !== passwordConfirmValue){
            this.setError(passwordConfirmInput, 'Passwords doesn\'t match.');
        } else {
            this.setSuccess(passwordConfirmInput);
        }
    };

    this.emailUnique = function() {
        let xml = new XMLHttpRequest();
        xml.open('POST', 'check_data.php');
        xml.onreadystatechange = () => {
            if(xml.readyState == 4 && xml.status == 200) {
                //xml.responseText
                //resolve(xml.responseText);

                let user = (JSON.parse(xml.responseText));
                let hej = 'hej';
                return hej;
                //return emailValue === user.email;

            }
        };
        xml.setRequestHeader("Content-type", "application/json"); //inform xml that json is coming
        xml.send(JSON.stringify(emailValue));
    }




    this.isEmail = function(email) {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
    };


    //show error message
    this.setError = function (input, msg) {
        this.hasNoError = false;
        input.classList.remove("is-valid");
        input.classList.add("is-invalid");
        input.nextElementSibling.innerText = msg ;
    };
    //show success
    this.setSuccess = function(input) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
        input.nextElementSibling.innerText = '' ;
    };


} //ValidateForm


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