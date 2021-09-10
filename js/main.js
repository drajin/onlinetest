//select inputs
let firstNameInput = document.querySelector('[name="firstName"]');
let lastNameInput = document.querySelector('[name="lastName"]');
let emailInput = '';
let passwordInput = '';
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
let loginBtn = document.querySelector('#loginBtn');
let registerBtn = document.querySelector('#registerBtn');
let startBtn = document.querySelector('.startBtn');

//select forms
let loginForm = document.getElementById("login");
let registerForm = document.getElementById("register");

let loader = document.querySelector('#loader');


//add events
submitRegisterBtn.addEventListener('click', registerNewUser);
submitLoginBtn.addEventListener('click', loginUser);
startBtn.addEventListener('click', quizStart);

let isLoggedInUser;





// function ShowWelcomeView()  {
//     isLoggedIn();
//     setTimeout(function(){
//     if(isLoggedInUser) {
//         showView.quiz();
//     } else {
//         showView.login();
//         showAlert('alert-danger', 'Log in error, you have to logged in to view this page.');
//
//     }
//          }, 3000);
// }


//show views

//initializes form class

let validateForm = new ValidateForm();


// register user
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

    validateForm.register();
    if(validateForm.error === false) {
        setTimeout(()=>{
            let newUser = {
                first_name : firstNameValue,
                last_name : lastNameValue,
                email : emailValue,
                password :passwordValue,
                password_confirm : passwordConfirmValue,
            };
            loginForm.reset();
            DB.register(newUser).then((response) => {
                showView.login();
                showAlert('alert-success', 'You are now registered, please login.');
            },(error)=>{
                console.log(error);
            });
        },3000);
    } else {
        //
    }

    validateForm.error = false;
}


//Log in user
function loginUser(e) {
    e.preventDefault();
    registerForm.reset();

    //select different email and password input
    emailInput = document.querySelector('#emailLogin');
    passwordInput = document.querySelector('#passwordLogin');

    //set input values
    emailValue = emailInput.value.trim();
    passwordValue = passwordInput.value.trim();

    validateForm.login();
    if(validateForm.error === false) {
        let loginData = {
            email : emailInput.value,
            password :passwordInput.value,
        };
        DB.login(loginData).then((response) => {
            console.log(response);
            if(response) {
                showView.rules();
                showLogoutBtn();

            } else {
                showAlert('alert-danger', 'Incorrect Email and Password Combination.');
            }


        },(error)=>{
            console.log(error);
        })
    }
    validateForm.error = false;
}



function ValidateForm() {

    this.error = false;

    this.login = function() {
        this.checkEmailLogin();
        this.checkPassword();
    };

    this.register = function() {
        this.checkFirstName();
        this.checkLastName();
        this.checkEmailReg();
        this.checkPassword();
        this.checkPasswordConfirm();
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

    this.checkEmailReg = function() {

        if(emailValue === '') {
            return this.setError(emailInput, 'Email can\'t be blank.');
        }
        else if (!this.isEmail(emailValue)) {
            return this.setError(emailInput, 'This is not a valid email address.');
        }
        this.emailUnique().then((response)=>{
            if(response === 'true') {
                this.setSuccess(emailInput);
            } else {
                this.setError(emailInput, 'Email in use.');
            }
        },(err)=>{
            //
        });

    };

    this.checkEmailLogin = function() {

        if(emailValue === '') {
            return this.setError(emailInput, 'Email can\'t be blank.');
        }
        else if (!this.isEmail(emailValue)) {
            return this.setError(emailInput, 'This is not a valid email address.');
        } else {
            this.setSuccess(emailInput);
        }

    };

    this.emailUnique = function() {
        return DB.isEmailUnique(emailValue);
        // console.log('email Uniqe function', emailUniqueValue);
        // setTimeout(()=>{
        //     if (!emailUniqueValue) {
        //         this.setError(emailInput, 'Email address is already registered.');
        //     }
        //     else {
        //         this.setSuccess(emailInput);
        //     }
        //
        //     hideLoader();
        // },2000)

    };

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

    this.isEmail = function(email) {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
    };

    // this.emailUniqueCheck = function() {
    //     DB.isEmailUnique(emailValue).then((response)=>{
    //         console.log('if unique true', response);
    //         if(response === 'true') {
    //             emailUniqueValue = true;
    //         } else {
    //             emailUniqueValue = false;
    //         }
    //     },(err)=>{
    //         //
    //     })
    // };

    //show error message
    this.setError = function (input, msg) {
        this.error = true;
        input.classList.remove("is-valid");
        input.classList.add("is-invalid");
        input.nextElementSibling.innerText = msg ;
    };
    //show success
    setTimeout( () =>   this.setSuccess = function(input) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
        input.nextElementSibling.innerText = '' ;
    } ,3000 );


} //ValidateForm

function quizStart() {
    showView.quiz();
}

function showAlert(alertType, msg) {
    let alertPlaceholder = document.querySelector('.alerts');
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



async function isLoggedIn() {
    DB.getSession().then((response) => {
        isLoggedInUser = response;
        return isLoggedInUser;
        // if(response == 'true') {   //TODO  true / false
        //     return true;
        // } else {
        //     return false;
        // }
    },(error)=>{
        console.log('error');
    })

}

async function logOut() {
    DB.sessionDestroy().then((response) => {
        if(response) {
            showLoginBtn();
            showView.login();
        }
    },(error)=>{
        console.log('error');
    })
}

function showLogoutBtn() {
    loginBtn.innerHTML = 'Logout';
    loginBtn.addEventListener('click', logOut);
    registerBtn.style.display='none';
}

function showLoginBtn() {
    loginBtn.innerHTML = 'Login';
    loginBtn.addEventListener('click', loginUser);
    registerBtn.style.display='block';
}

// creates loader image
function showLoader() {
    loader.innerHTML = '<img class="loader" src="img/loader.gif" alt="">';
}

function hideLoader() {
    loader.innerHTML = '';
}









