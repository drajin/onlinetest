function ShowView() {

    //select links
    this.loginLink = document.querySelectorAll('.loginLink');
    this.registerLink = document.querySelectorAll('.registerLink');

    //select views
    this.loginView = document.querySelector('#loginView');
    this.registerView = document.querySelector('#registerView');
    this.rulesView = document.querySelector('#rulesView');
    this.quizView = document.querySelector('#quizView');

    //add event listeners to links
    this.init = function() {
        for(let i=0; i<this.loginLink.length;  i++) {
            this.loginLink[i].addEventListener('click', this.login.bind(this));
            this.registerLink[i].addEventListener('click', this.register.bind(this));
        }
    };

    //show login view
    this.login = () => {
            this.registerView.style.display = 'none';
            this.loginView.style.display = 'block';
            this.rulesView.style.display = 'none';
            this.quizView.style.display = 'none';
    };

    //show register view
    this.register = function() {
        this.registerView.style.display = 'block';
        this.loginView.style.display = 'none';
        this.rulesView.style.display = 'none';
        this.quizView.style.display = 'none';
    };

    //rules view
    this.rules = function() {
            this.registerView.style.display = 'none';
            this.loginView.style.display = 'none';
            this.rulesView.style.display = 'block';
            this.quizView.style.display = 'none';
    };

    //quiz view
    this.quiz = function() {
            this.registerView.style.display = 'none';
            this.loginView.style.display = 'none';
            this.rulesView.style.display = 'none';
            this.quizView.style.display = 'block';
    };


}


let showView = new ShowView();

showView.init();
isLoggedIn();
