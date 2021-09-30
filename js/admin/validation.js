


function ValidateQuestionAnsw() {
    // this.questionInput = [];
    // this.checkboxesInput = [];
    // this.answersInput = [];
    // this.displayQuestionValue = [];

    this.selectElements = () => {
        this.questionInput = document.querySelector('[name="question_text"]');
        //this.checkboxesInput = document.querySelectorAll('[name="checkbox[]"]');
        this.answersInput = document.querySelectorAll('.answerInput');
    }

    this.error = false;

    this.question = () => {
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
        if(!(this.checkboxesInput = document.querySelectorAll('[name="checkbox[]"]:checked').length)){
            showAlert('alert-danger', 'At list one Answer must be correct');
            this.error = true;
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
        this.error = true;
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


let validation = new ValidateQuestionAnsw();

let submitBtn = document.querySelector('#submitLogin');

submitBtn.addEventListener('click',(e)=> {
    e.preventDefault();
    validation.selectElements();
    validation.question();
});
