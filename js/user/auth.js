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
    showLoader();
    //set input values
    emailInput = document.querySelector('#emailRegister');
    passwordInput = document.querySelector('#passwordRegister');

    firstNameValue = firstNameInput.value.trim();
    lastNameValue = lastNameInput.value.trim();
    emailValue = emailInput.value.trim();
    passwordValue = passwordInput.value.trim();
    passwordConfirmValue = passwordConfirmInput.value.trim();

    validateForm.register();
    if(validateForm.NoError) {
        setTimeout(()=>{
            let newUser = {
                first_name : firstNameValue,
                last_name : lastNameValue,
                email : emailValue,
                password :passwordValue,
                password_confirm : passwordConfirmValue,
            };
            registerForm.reset();
            loginForm.reset();
            hideLoader();
            DB.register(newUser).then((response) => {
                showView.login();
                showAlert('alert-success', 'You are now registered, please login.');
            },(error)=>{
                console.log(error);
            });
        },3000);
    } else {
        hideLoader();
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
    if(validateForm.NoError) {
        let loginData = {
            email : emailInput.value,
            password :passwordInput.value,
        };
        loginForm.reset();

        DB.login(loginData).then((response) => {
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







function quizStart() {
    showView.quiz();
}





function isLoggedIn() {
  DB.getSession().then((response) => {
      //TODO how to check true / false from php
        if(response === 'true') {
            showLogoutBtn();
            showView.rules();
        } else {
            showView.login();
        }
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












