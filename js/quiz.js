



function Quiz(response) {

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
    this.questions = response.questions;


    //this.questions = this.shuffle(response.questions);


    //shuffle answers
    this.answers = this.shuffle(response.answers);
    //this.answers = response.answers;



    this.numQuestions = this.questions.length;
    this.lastQuestion = this.numQuestions;


    this.createQuizForm = function() {
        let questionsCounter = 0;
        this.text += ``;
        this.questions.forEach((question) => {
            let answersCounter = 0;
            questionsCounter++;

            let ans = [];
                this.text += `
                    <div class="wrap q" id="q${question.q_id}"> 
                    <div class="h4 font-weight-bold">${question.question_text}</div>
                    <div class="pt-4">
                    <form>
                    `;
            this.answers.forEach((answer) => {
                if(question.q_id === answer.question_id) {
                    ans.push(answer);
                    answersCounter++;
                }

            });

            //choose what will be in which form
            if(answersCounter === 2) {
                this.text += this.createSelectOption(ans);
            } else if (answersCounter === 3) {
                this.text += this.createRadioBtns(ans);
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
                this.text += `<button class="btn btn-primary next" id="next${question.q_id}">Next <span class="fas fa-arrow-right"></span> </button>
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
        this.questionIds.push('q'+i);
        this.buttonIds.push('next'+i);
    }





    //hiding questions to left starting from question 2
    this.hideQuestions = function() {
        let removedElement = this.questionIds.shift();
        this.questionIds.forEach((questionId)=>{
            let question = document.getElementById(questionId);
            console.log('ba')
        });
        this.questionIds.unshift(removedElement);
    }

    this.createSelectOption = function(answer) {
        let text = ` <select class="form-select" >`;
            text += ` <option disabled selected value> -- select an option -- </option>`;
        for(i=0; i<answer.length; i++) {
            text += `<option class="answer" value="${answer[i].id}">${answer[i].answer_text}</option>`;
        }
        text += `</select>`;
        return text;
    }

    this.createRadioBtns = function(answer) {
        let text = '';
        for(i=0; i<answer.length; i++) {
            text += `                
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="${answer[i].id}" value="${answer[i].id}">
                        <label class="form-check-label" for="${answer[i].id}">${answer[i].answer_text}</label>
                    </div>`;
        }
        return text;
    }

    this.createCheckboxBtns = function(answer) {
        let text = '';
        for(i=0; i<answer.length; i++) {
            text += `                
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="${answer[i].id}" id="${answer[i].id}">
                  <label class="form-check-label" for="${answer[i].id}">${answer[i].answer_text}</label>
                </div> `;
        }
        return text;
    }

    // hide questions and answers to the left
    this.hideQuestions = function() {
        let removedElement = this.questionIds.shift();
        for (question in this.questionIds) {
            let questionBox = document.getElementById(this.questionIds[question]);
            questionBox.style.left = "650px";
        }
        this.questionIds.unshift(removedElement);
    }



    // buttons
    this.disableBtns = () => {
        this.buttons = document.querySelectorAll('.next');
        this.submit = document.querySelector('#submit');
        this.answers = document.querySelectorAll('.answer');
        for(let i=0; i<this.buttons.length; i++) {
            this.buttons[i].disabled = true;
            this.submit.disabled = true;

        }
        this.validateForm(this.buttons, this.submit);

    }




    let counter = 0;

    this.activateBtns = () => {
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
        this.submit.addEventListener("click", function(){
            // let selectedAnswers = document.querySelectorAll('input[name="radio"]:checked');
            // let selectedAnswersArray = [];
            // for(let i=0; i<selectedAnswers.length; i++) {
            //     selectedAnswersArray.push(selectedAnswers[i].value);
            // }
            console.log('true, false array');
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




    // var shuffledQuestionArray = shuffle(yourQuestionArray);
    // var shuffledTopicArray = shuffle(yourTopicArray);







}  //class end





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

