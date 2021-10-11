function ShowView() {

    //select links
    this.loginLink = document.querySelectorAll('.loginLink');
    this.registerLink = document.querySelectorAll('.registerLink');

    //select views
    this.loginView = document.querySelector('#loginView');
    this.registerView = document.querySelector('#registerView');
    this.rulesView = document.querySelector('#rulesView');
    this.quizView = document.querySelector('#quizView');

    this.resultView = document.querySelector('#resultView');

    this.showResults = `
    <div class="my-3 p-3 transparent rounded shadow-sm">
        <h1 id="title" class="display-4 text-center m-3 p-3"><i class="far fa-check-circle"></i>Success You've Passed!(barely)</h1>
        <h2 id="message" class="text-center">You barely passed... Your Knowledge is average, you can do better!</h2>
        <br>
        <div class="result row">
            <div class="col-md-6 text-center totalScore d-flex align-items-center flex-column justify-content-center">
                <p>Your total score:</p>
                <span class="badge score">{{result}}%</span>
            </div>
            <div class="col-md-6 d-flex align-items-start flex-column justify-content-center">
                <ul>
                    <li id="numQuestions"></li>
                    <li id="correctAnswers"></li>
                    <li>Passing score: 80%</li>
                </ul>
            </div>
        </div>
        <div class="buttons d-flex flex-row justify-content-center mt-4">
            <div class="mid">
                <a href="#" class="btn btn-secondary btn-lg me-3 test" role="button">Retake the Quiz</a>
            </div>
            <div class="mid">
                <a href="#" class="btn btn-secondary btn-lg ms-3" role="button">View all Results</a>
            </div>
        </div>
    </div>
    `;
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
            //this.resultView.style.display = 'none';
    };

    //show register view
    this.register = function() {
        this.registerView.style.display = 'block';
        this.loginView.style.display = 'none';
        this.rulesView.style.display = 'none';
        this.quizView.style.display = 'none';
        //this.resultView.style.display = 'none';
    };

    //rules view
    this.rules = function() {
            this.registerView.style.display = 'none';
            this.loginView.style.display = 'none';
            this.rulesView.style.display = 'block';
            this.quizView.style.display = 'none';
            //this.resultView.style.display = 'none';

    };

    //quiz view
    this.quiz = function() {
            this.registerView.style.display = 'none';
            this.loginView.style.display = 'none';
            this.rulesView.style.display = 'none';
            this.quizView.style.display = 'block';
            //this.resultView.style.display = 'none';

    };

    // result view
    this.result = function(outcome) {
            this.registerView.style.display = 'none';
            this.loginView.style.display = 'none';
            this.rulesView.style.display = 'none';
            this.quizView.style.display = 'none';

            this.resultView.innerHTML = this.showResults.replace("{{result}}", outcome.result);
            document.getElementById('title').innerHTML = outcome.title;
            document.getElementById('message').innerHTML = outcome.message;
            document.querySelector('.result').style.background = outcome.color;
            document.querySelector('.far').style.color = outcome.color;
            document.querySelector('.badge').classList.add(outcome.badge);
            document.querySelector('.result').classList.add('blue');
            document.getElementById('numQuestions').innerHTML ='Questions in total: '+ quiz.numQuestions;
            document.getElementById('correctAnswers').innerHTML ='Correct answers: '+ quiz.numCorrectAnswers;

    };


}


let showView = new ShowView();

showView.init();
isLoggedIn();
