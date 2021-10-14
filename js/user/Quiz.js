

//TODO if no checkbox is selected
//TODO option value must be selected

function Quiz(response) {

    //this.answers = [];

    //shuffle answers
    this.shuffle = function(sourceArray) {
        for (let i = 0; i < sourceArray.length - 1; i++) {
            let j = i + Math.floor(Math.random() * (sourceArray.length - i));

            let temp = sourceArray[j];
            sourceArray[j] = sourceArray[i];
            sourceArray[i] = temp;
        }
        return sourceArray;
    }


    this.text = ``;
    this.userAnswers = [];
    this.numCorrectAnswers = 0;
    this.questions = response.questions;

    //comment out for question random questions
    //this.questions = this.shuffle(response.questions);

    //questions wont be changed
    //this.answers = response.answers;

    //comment out for question random questions
    this.answers = this.shuffle(response.answers);




    this.numQuestions = this.questions.length;
    this.lastQuestion = this.numQuestions;
    this.counter = 0;
    this.userCorrectAnswCounter = 0;

    this.createQuizForm = function() {

        let questionsCounter = 0;
        this.text += ``;
        this.questions.forEach((question) => {
            questionsCounter++;

            let ans = [];
                this.text += `
                    <div class="wrap q" id="q${question.id}"> 
                    <div class="h4 font-weight-bold">${question.question_text}</div>
                    <div class="pt-4">
                    <form>
                    `;
                //make array with answers sorted on question ids
            this.answers.forEach((answer) => {
                if(question.id === answer.question_id) {
                    ans.push(answer);
                }
            });

            //choose what will be in which form
            if(question.display === 'option') {
                this.text += this.createSelectOption(ans);
            } else if (question.display === 'radio') {
                this.counter++;
                this.text += this.createRadioBtns(ans, this.counter);
            } else {
                this.text += this.createCheckboxBtns(ans);
            }

            //display next button or submit on last button
            if(questionsCounter === this.lastQuestion) {
                this.text += `
            <button class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </div>
                    `;
            } else {
                this.text += `<button class="btn btn-primary next" id="next${question.id}">Next <span class="fas fa-arrow-right"></span> </button>
            </div>
        </div>
        `;

            }

        });
        // this.text += `  <button type="submit" class="btn btn-primary">Submit</button></form>`;

        return this.text;
    }


    this.questionIds = [];
    this.buttonIds = [];


    //select all questions and button IDs
    for(let i=1; i<this.numQuestions+1; i++) {
        this.buttonIds.push('next');
    }





    //hiding questions to left starting from question 2
    this.hideQuestions = function() {
        let removedElement = this.questionIds.shift();
        this.questionIds.forEach((questionId)=>{
            let question = document.getElementById(questionId);
        });
        this.questionIds.unshift(removedElement);
    }

    // creating dropdown select option question
    this.createSelectOption = function(answer) {
        let text = ` <select class="form-select" >`;
            text += ` <option disabled selected value> -- select an option -- </option>`;
        for(i=0; i<answer.length; i++) {
            text += `<option class="answer" value="${answer[i].answer_text}">${answer[i].answer_text}</option>`;
        }
        text += `</select>`;
        text += `<br>`;

        return text;
    }

    // creating radio buttons question
    this.createRadioBtns = function(answer, counter) {
        let text = '';
        for(i=0; i<answer.length; i++) {
            text += `                
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="${counter}" value="${answer[i].answer_text}" id="${answer[i].id}">
                        <label class="form-check-label" for="${answer[i].id}">${answer[i].answer_text}</label>
                    </div>`;
        }
        return text;
    }

    // creating checkbox buttons question
    this.createCheckboxBtns = function(answer) {
        let text = '';
        for(i=0; i<answer.length; i++) {
            text += `                
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="${answer[i].answer_text}" id="${answer[i].id}">
                  <label class="form-check-label" for="${answer[i].id}">${answer[i].answer_text}</label>
                </div> `;
        }
        return text;
    }

    // hide questions and answers to the left
    this.hideQuestions = function() {
        let questionIds = [];
       let allQuestions = document.querySelectorAll('.q');
        allQuestions.forEach(question=>{
            questionIds.push(question.id);
        });
        let removedElement = questionIds.shift();
        for (const question in questionIds) {
            let questionBox = document.getElementById(questionIds[question]);
            questionBox.style.left = "650px";
        }
        questionIds.unshift(removedElement);
    }



    // buttons
    this.disableBtns = () => {
        this.buttons = document.querySelectorAll('.next');
        this.submit = document.querySelector('#submit');
        //this.answers = document.querySelectorAll('.answer'); TODO if this is necessary
        for(let i=0; i<this.buttons.length; i++) {
            this.buttons[i].disabled = true;
            this.submit.disabled = true;

        }
        this.validateForm(this.buttons, this.submit);

    }




    //add event listener on buttons
    this.activateBtns = () => {
        let counter = 0;
        let query = window.matchMedia("(max-width: 767px)");
        let questions = document.querySelectorAll('.q');
        if(query.matches) {
            let counter = 0;
            for(let i=0; i<(this.buttons.length); i++) {
                this.buttons[i].onclick = (e) => {
                    e.preventDefault();
                    this.disableBtns();
                    questions[counter].style.left = "-650px";
                    counter++;
                    questions[counter].style.left = "15px";
                }
            }
        } else {
            for(let i=0; i<(this.buttons.length); i++) {
                this.buttons[i].onclick = (e) => {
                    e.preventDefault();
                    this.disableBtns();
                    questions[counter].style.left = "-650px";
                    counter++;
                    questions[counter].style.left = "50px";

                }
            }

        }

        //submit button functionality
        this.submit = document.getElementById('submit');
        this.submit.addEventListener("click", () => {
            this.getAnswers();
        });
    }

    //validate forms
    this.validateForm = function(buttons, submit) {
        this.selects = document.querySelectorAll('select');
        this.radios = document.querySelectorAll('input[type=radio]');
        this.checkboxes = document.querySelectorAll('input[type=checkbox]');
        this.selects.forEach((selects)=>{
            selects.addEventListener('click',() => {
                this.enableBtns(buttons, submit);
            })
        });
        this.radios.forEach((radios)=>{
            radios.addEventListener('click',() => {
                this.enableBtns(buttons, submit);
            })
        });
        this.checkboxes.forEach((checkbox)=>{
            checkbox.addEventListener('click',() => {
                this.enableBtns(buttons, submit);
            })
        });
    }

    // if answer is selected enable next and submit btn
    this.enableBtns = (buttons, submit) => {
        for(let i=0; i<buttons.length; i++) {
            buttons[i].disabled = false;
            submit.disabled = false;
        }
    }

    //getting all users answers from the from
    this.getAnswers = () => {
        this.selectOption = document.querySelectorAll('.form-select');
        this.checkBoxes = document.querySelectorAll('.form-check-input:checked');

        for(let i=0; i<this.checkBoxes.length; i++) {
            this.userAnswers.push(this.checkBoxes[i].value);
        }
        for(let i=0; i<this.selectOption.length; i++) {
            this.userAnswers.push(this.selectOption[i].value);
        }


        this.calculateScore()

    }


    //counts all quiz's existing correct answers

        let counter = 0;
        this.answers.forEach((answer) =>{
            if(answer.correct == 1) {
                counter++
            }
        });
        this.numCorrectAnswers = counter;


    //looping trough user answers and comparing with existing answers
    this.calculateScore = () => {
        let correctAnswers= [];
        this.userAnswers.forEach((userAnswer) => {
            this.answers.forEach((answer) => {
                if(userAnswer === answer.answer_text) {
                    correctAnswers.push(answer.correct);
                }
            })

        })

        this.userCorrectAnswCounter = correctAnswers.filter(correct => correct==1).length;
        //every correct answer multiplied by the worth of one correct answer    //how much is one correct answer worth in percent
        let result = {
            'points' : this.userCorrectAnswCounter * Math.round(100/(this.numCorrectAnswers)),
            'correct_answ' : this.numCorrectAnswers,
            'correct_answ_user' : this.userCorrectAnswCounter,
        };
        Result.save(result);

    }




}  //end of class





let quiz;



DB.getQuizQuestions().then((response)=>{
    quiz = new Quiz(response);
    quizView.innerHTML = quiz.createQuizForm();
    quiz.hideQuestions();
    quiz.disableBtns();
    quiz.activateBtns();

},(err)=>{
    console.log('err');
});

