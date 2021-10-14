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


let validation = new Validation();
let user = new User();


//add events
submitRegisterBtn.addEventListener('click', user.registerNewUser);
submitLoginBtn.addEventListener('click', user.loginUser);
startBtn.addEventListener('click', user.quizStart);




function User() {

    // register user
    this.registerNewUser = (e) => {
        e.preventDefault();
        //set input values
        emailInput = document.querySelector('#emailRegister');
        passwordInput = document.querySelector('#passwordRegister');

        firstNameValue = firstNameInput.value.trim();
        lastNameValue = lastNameInput.value.trim();
        emailValue = emailInput.value.trim();
        passwordValue = passwordInput.value.trim();
        passwordConfirmValue = passwordConfirmInput.value.trim();

        validation.register();
        this.showLoader();
        setTimeout(()=>{
            if(validation.NoError) {
                let newUser = {
                    first_name : firstNameValue,
                    last_name : lastNameValue,
                    email : emailValue,
                    password :passwordValue,
                    password_confirm : passwordConfirmValue,
                };
                registerForm.reset();
                loginForm.reset();
                this.hideLoader();
                DB.register(newUser).then((response) => {
                    showView.login();
                    showAlert('alert-success', 'You are now registered, please login.');
                },(error)=>{
                    console.log(error);
                });

            } else {
                this.hideLoader();
            }
        },3000);

        validation.error = false;
    }


//Log in user
    this.loginUser = (e) => {
        e.preventDefault();

        registerForm.reset();

        //select different email and password input
        emailInput = document.querySelector('#emailLogin');
        passwordInput = document.querySelector('#passwordLogin');

        //set input values
        emailValue = emailInput.value.trim();
        passwordValue = passwordInput.value.trim();

        validation.login();
        if(validation.NoError) {
            let loginData = {
                email : emailInput.value,
                password :passwordInput.value,
            };
            loginForm.reset();

            DB.login(loginData).then((response) => {
                if(response) {
                    showView.rules();
                    this.showLogoutBtn();

                } else {
                    showAlert('alert-danger', 'Incorrect Email and Password Combination.');
                }


            },(error)=>{
                console.log(error);
            })
        }
        validation.error = false;
    }


    this.quizStart = () => {
        showView.quiz();
    }


    this.isLoggedIn = () => {
        DB.getSession().then((response) => {
            //TODO how to check true / false from php
            if(response === 'true') {
                this.showLogoutBtn();
                showView.rules();
            } else {
                showView.login();
            }
        },(error)=>{
            console.log('error');
        })

    }


     this.logOut = async() => {
        DB.sessionDestroy().then((response) => {
            if(response) {
                this.showLoginBtn();
                location.reload();
                showView.login();
            }
        },(error)=>{
            console.log('error');
        })
    }

    this.showLogoutBtn = () => {
        loginBtn.innerHTML = 'Logout';
        loginBtn.addEventListener('click', this.logOut);
        registerBtn.style.display='none';
    }

    this.showLoginBtn = () => {
        loginBtn.innerHTML = 'Login';
        loginBtn.addEventListener('click', this.loginUser);
        registerBtn.style.display='block';
    }

// creates loader image
    this.showLoader = () => {
        loader.innerHTML = '<img class="loader" src="img/loader.gif" alt="">';
    }

    this.hideLoader = () => {
        loader.innerHTML = '';
    }

}













