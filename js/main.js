
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

let inputFirstName = document.querySelector('[name="firstName"]');
let inputLastName = document.querySelector('[name="lastName"]');
let inputEmail = document.querySelector('[name="email"]');
let inputPassword = document.querySelector('[name="password"]');
let inputPasswordConfirm = document.querySelector('[name="passwordConfirm"]');

let submitBtn = document.querySelector('#submitBtn');

submitBtn.addEventListener('click', registerNewUser);

function registerNewUser() {
    // validation
    let newUser = {
        first_name : inputFirstName.value,
        last_name : inputLastName.value,
        email : inputEmail.value,
        password :inputPassword.value,
        password_confirm : inputPasswordConfirm.value,
    };
    DB.save(newUser);
}
