//questions form

function createQuestionsForm(dbQuestions) {
    let text = ``;
    let numQuestions = dbQuestions.length;

    //creating questions form

    for(let i=0; i<numQuestions; i++) {
        text += `
                     <div class="wrap" id="q${dbQuestions[i].id}">
            <div class="h4 font-weight-bold">${dbQuestions[i].question_text}</div>
            <div class="pt-4">
                    <!--answers-->
                <form>
                    <label class="options">${dbQuestions[i].answer_1}
                        <input class="radio" type="radio" name="radio" value="${dbQuestions[i].answer_1}"> <span class="checkmark"></span>
                    </label>
                    <label class="options">${dbQuestions[i].answer_2}
                        <input class="radio" type="radio" name="radio" value="${dbQuestions[i].answer_2}"> <span class="checkmark"></span>
                    </label>
                    <label class="options">${dbQuestions[i].answer_3} 
                        <input class="radio" type="radio" name="radio" value="${dbQuestions[i].answer_3}"> <span class="checkmark"></span>
                     </label>
                    <label class="options">${dbQuestions[i].answer_4}
                        <input class="radio" type="radio" name="radio" value="${dbQuestions[i].answer_4}"> <span class="checkmark"></span>
                    </label>
                </form>
            </div>
            <div class="d-flex justify-content-end pt-2">`;
        let lastQuestion = dbQuestions[numQuestions - 1];

        if(dbQuestions[i] === lastQuestion) {
            text += `
            <button class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </div>
                    `;
        } else {
            text += `<button class="btn btn-primary next" id="next${dbQuestions[i].id}">Next <span class="fas fa-arrow-right"></span> </button>
            </div>
        </div>
        `;
        }



    }


    quizView.innerHTML = text;



    function validateQuestions() {
        let radios = document.querySelectorAll('.radio');
        let nextBtn = document.querySelector('#next1').disabled = true;
        let SubmitBtn = document.querySelector('#next1').disabled = true;

        for(let i=0; i<radios.length; i++) {
            radios[i].onclick = function() {
                nextBtn = document.querySelector('#next1').disabled = false;
            }

        }
    }


    let questionIds = [];
    let buttonIds = [];
    let sortedWords_Array = questionIds.slice(0);


    //select all questions and button IDs
    for(let i=0; i<numQuestions; i++) {
        questionIds.push('q'+dbQuestions[i].id);
        buttonIds.push('next'+dbQuestions[i].id);
    }




    //moving questions to left starting from question 2 starting from question 2
    function hideQuestions() {
        let removedElement = questionIds.shift();
        questionIds.forEach((questionIds)=>{
            let question = document.getElementById(questionIds);
            question.style.left = "650px";
        });
        questionIds.unshift(removedElement);
    }

    hideQuestions();


    let buttons = [];
    let questions = [];
    let answers = [];

    //makes buttons array
    buttonIds.forEach(makeBtnArr);
    function makeBtnArr(buttonId) {
        buttons.push(document.getElementById(buttonId));
    }




    //makes questions array
    questionIds.forEach(makeQuestionArr);
    function makeQuestionArr(questionId) {
        questions.push(document.getElementById(questionId));
    }

    answers = document.querySelectorAll('.radio');



    function enableButtons() {
        let buttons = document.querySelectorAll('.next');
        let submit = document.querySelector('#submit');
            for(let i=0; i<buttons.length; i++) {
                buttons[i].disabled = true;
                submit.disabled = true;

            }
        for(let i=0; i<answers.length; i++) {
            answers[i].onclick = () => {
                for(let i=0; i<buttons.length; i++) {
                    buttons[i].disabled = false;
                    submit.disabled = false;
                }
            }
        }

    }



    //makes answers array
    answers = document.querySelectorAll('.radio');

    let query = window.matchMedia("(max-width: 767px)");

    let counter = 0;
    if (query.matches) {
        let counter = 0;
        for(let i=0; i<(buttons.length-1); i++) {
            buttons[i].onclick = function() {
                questions[counter].style.left = "-650px";
                counter++;
                questions[counter].style.left = "15px";
            }
        }
    } else {
        for(let i=0; i<(buttons.length-1); i++) {
            buttons[i].onclick = function() {
                questions[counter].style.left = "-650px";
                counter++;
                questions[counter].style.left = "50px";
                enableButtons()
            }
        }

    }


    let submit = document.getElementById('submit');
    submit.addEventListener("click", function(){
        let selectedAnswers = document.querySelectorAll('input[name="radio"]:checked');
        let selectedAnswersArray = [];
        for(let i=0; i<selectedAnswers.length; i++) {
            selectedAnswersArray.push(selectedAnswers[i].value);
        }
        console.log(selectedAnswersArray);
    });




} //end create questions form


//TODO delete
// DB.getAllQuestions().then((questions)=>{
//     createQuestionsForm(questions);
// },(err)=>{
//     console.log('err');
// });
