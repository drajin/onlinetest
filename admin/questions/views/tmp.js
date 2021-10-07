//pre nego sto sjebem create ceo
let submitNew = document.querySelector('#newQuestionAnsw');
let submitEdit = document.querySelector('#editQuestionAnsw')

function ValidateQuestionAnsw() {
    // this.questionInput = [];
    // this.checkboxesInput = [];
    // this.answersInput = [];


    this.reselectElements = () => {
        this.questionInput = document.querySelector('[name="question_text"]');
        this.displayQuestionValue = document.querySelector('[name="question_display"]').value;
        this.checkboxesInput = document.querySelectorAll('[name="checkbox[]"]:checked');
        //this.checkboxesInput = document.querySelectorAll('[name="checkbox[]"]');
        this.answersInput = document.querySelectorAll('.answerInput');
    }

    this.noError = true;

    this.question = () => {
        this.noError = true;
        this.reselectElements();
        this.questionText();
        this.checkBoxes();
        this.answersText();
    };


    this.questionText = () => {
        if(this.questionInput.value === '') {
            this.setError(this.questionInput, 'Question can\'t be blank');
        } else {
            this.setSuccess(this.questionInput);
        }
    };

    this.checkBoxes = () => {
        if(!(this.checkboxesInput.length)){
            showAlert('alert-danger', 'At least one answer must be correct');
            this.noError = false;
        }

    }

    this.answersText = () => {
        this.answersInput.forEach((answer) => {
            if(answer.value === '') {
                this.setError(answer, 'Answer can\'t be blank');
            } else {
                this.setSuccess(answer);
            }
        })


    };


    //show error message
    this.setError = function (input, msg) {
        this.noError = false;
        input.classList.remove("is-valid");
        input.classList.add("is-invalid");
        input.nextElementSibling.innerText = msg ;
    };
    //show success
    this.setSuccess = function(input) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
        input.nextElementSibling.innerText = '' ;
    };


} //ValidateForm

// on crete is false edit true
let question_id = (document.querySelector('#question_id')) ? document.querySelector('#question_id').value : false;
let answer_ids = (document.querySelectorAll('.answer_id')) ? document.querySelectorAll('.answer_id') : false;
//let answer_ids = document.querySelectorAll('.answer_id');
let validation = new ValidateQuestionAnsw();


submitQuestionAnswers = () => {
    if(validation.noError) {
        let questionAnswerData = {
            question_id : question_id,
            question : validation.questionInput.value.trim(),
            display : validation.displayQuestionValue,
            correct : [],
            answers : [],
            answer_id : [],
        };
        validation.checkboxesInput.forEach((checkbox) =>{
                questionAnswerData.correct.push(checkbox.id);
            }
        );
        validation.answersInput.forEach((answer) =>{
                questionAnswerData.answers.push(answer.value.trim());
            }
        );
        answer_ids.forEach((answer_id) =>{
                questionAnswerData.answer_id.push(answer_id.value);
            }
        );
        console.log(questionAnswerData);
        //send to php
        DB.postQuestionAnsw(questionAnswerData).then((response) => {
            if(response === 'true') {
                window.location.replace("http://localhost/onlinetest/admin/questions/index.php");

            }
        },(error)=>{
            console.log(error);
        });


    } else {
        console.log('error')
    }
};


//
// submitNew.addEventListener('click',(e)=> {
//     e.preventDefault();
//     validation.question();
//     submitQuestionAnswers();
// });

submitEdit.addEventListener('click',(e)=> {
    e.preventDefault();
    validation.question();
    submitQuestionAnswers();
});
