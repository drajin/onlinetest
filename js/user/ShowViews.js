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
    this.resultHistoryView = document.querySelector('#resultHistoryView');

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
            this.resultHistoryView.style.display = 'none';
            this.resultView.style.display = 'none';
    };

    //show register view
    this.register = function() {
        this.registerView.style.display = 'block';
        this.loginView.style.display = 'none';
        this.rulesView.style.display = 'none';
        this.quizView.style.display = 'none';
        // this.resultHistoryView.style.display = 'none';
        // this.resultView.style.display = 'none';
    };

    //rules view
    this.rules = function() {
            this.registerView.style.display = 'none';
            this.loginView.style.display = 'none';
            this.rulesView.style.display = 'block';
            this.quizView.style.display = 'none';
            //this.resultHistoryView.style.display = 'none';
            //this.resultView.style.display = 'none';

    };

    //quiz view
    this.quiz = function() {
            this.registerView.style.display = 'none';
            this.loginView.style.display = 'none';
            this.rulesView.style.display = 'none';
            this.quizView.style.display = 'block';
            //this.resultHistoryView.style.display = 'none';
            //this.resultView.style.display = 'none';

    };

    // result view
    this.result = function(outcome) {
            this.registerView.style.display = 'none';
            this.loginView.style.display = 'none';
            this.rulesView.style.display = 'none';
            this.quizView.style.display = 'none';
            this.resultView.style.display = 'block';

        this.resultView.innerHTML = showResults.replace("{{result}}", outcome.result);
            document.getElementById('title').innerHTML = outcome.title;
            document.getElementById('message').innerHTML = outcome.message;
            document.querySelector('.result').style.background = outcome.color;
            document.querySelector('.far').style.color = outcome.color;
            document.querySelector('.badge').classList.add(outcome.badge);
            document.querySelector('.result').classList.add('blue');
            document.getElementById('numQuestions').innerHTML ='Questions in Total: '+ quiz.numQuestions;
            document.getElementById('correctQuestions').innerHTML ='Correct Answers: '+quiz.userCorrectAnswCounter +'/'+quiz.numCorrectAnswers;

            this.allResultsBtn = document.querySelector('.allResults');
            this.retakeQuiz = document.querySelector('.retakeQuiz');
            this.allResultsBtn.addEventListener('click', () => {
                Result.showHistoryResults();
            });
            this.retakeQuiz.addEventListener('click', ()=> {
                location.reload();
            });

    };

    //results history view
    this.resultsHistory = function(data) {
        this.registerView.style.display = 'none';
        this.loginView.style.display = 'none';
        this.rulesView.style.display = 'none';
        this.quizView.style.display = 'none';
        this.resultView.style.display = 'none';
        this.resultHistoryView.style.display = 'block';
        let table = '';
        let counter = 1;
        data.history.forEach((results) => {
        table += `
                <tr class="text-white">
                    <th>${counter}</th>
                    <td>${results.taken_at}</td>
                    <td>${results.points}</td>
                    <td>${results.correct_answ_user}/${results.correct_answ}</td>
                </tr>
                `
            counter++
        });

        this.resultHistoryView.innerHTML =
            showResultsHistory.replace("{{results}}", table).replace("{{name}}", data.user.first_name +' '+data.user.last_name);;

        this.logOut = document.querySelector('.logOutBtn');
        this.retakeQuiz = document.querySelector('.retakeQuizBtn');
        this.logOut.addEventListener('click', user.logOut);
        this.retakeQuiz.addEventListener('click', ()=> {
            location.reload();
        });


    }


}


let showView = new ShowView();

showView.init();
user.isLoggedIn();
