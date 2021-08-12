
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