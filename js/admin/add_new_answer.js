


let newAnswer =  `<div class="row form-group newAnswer" id="newAnswer-{{dynamic}}"> 
<!--                        checkbox-->
                    <div class="col-sm-2 mb-5">
                        <div class="form-check">
                            <input type="checkbox" name="checkbox[]" value="{{dynamic}}" class="form-check-input" id="{{dynamic}}">
                            <label class="form-check-label" for="{{dynamic}}">Correct</label>
                        </div>
                    </div>
<!--                    answer input-->
                    <div class="col-sm-8">
                        <input name="{{dynamic}}" id="{{dynamic}}" placeholder="Answer" class="form-control answerInput" value="">
                        <div class="invalid-feedback"></div>
                    </div>
                   <!--  remove btn functionality -->
                   <div class="col-sm-2 remove">
                       <a href="#" id="removeBtn-{{dynamic}}" class="btn btn-block">Remove</a>
                    </div>
                </div>`;


//select add answer button
let addAnswerBtn = document.querySelector('.addAnswer');
let numberOfAnswers = 2;

//add new answer
addAnswerBtn.addEventListener('click', (e)=> {
    e.preventDefault();
    createNewAnswer();
    changeDefaultQuestionDisplay()
});


createNewAnswer = () => {
    let generatedAnswers = document.querySelector('.generatedAnswers');

    generatedAnswers.innerHTML += newAnswer.replaceAll("{{dynamic}}", numberOfAnswers.toString());

    let genAnswersId = [2, 3, 4];

    genAnswersId.forEach((answerID) => {
        if(document.querySelector('#removeBtn-'+answerID)) {
            removeBtnFun(document.querySelector('#removeBtn-'+answerID));
        }
    });
    numberOfAnswers++;
    checkNumberOfAnswers();

};

checkNumberOfAnswers = () => {
    if(numberOfAnswers > 4) {
        addAnswerBtn.classList.add('disabled');
    } else {
        addAnswerBtn.classList.remove('disabled');
    }
};

removeBtnFun = (removeBtn) => {
    if(removeBtn.getAttribute('listener') !== 'true') {
        removeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            removeBtn.setAttribute('listener', 'true');
            removeAnswer(removeBtn.id);
        });
    }
};

removeAnswer = (removeBtn) => {
    let newAnswerClass = ('newAnswer-'+removeBtn.slice(-1));
    let newAnswer = document.getElementById(newAnswerClass);
    newAnswer.remove();
    numberOfAnswers--;
    checkNumberOfAnswers();
};

//TODO Refactor
changeDefaultQuestionDisplay = () => {
    let allCheckboxes = (document.querySelectorAll("input[type='checkbox']"));
    allCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener( 'change', function() {
            if(this.checked) {
                setQuestionDisplay(document.querySelectorAll("input[type='checkbox']:checked").length);
            } else {
                setQuestionDisplay(document.querySelectorAll("input[type='checkbox']:checked").length);
            }
        });
    })
}

changeDefaultQuestionDisplay()

setQuestionDisplay = (checkedNumber) => {
    let selectOption = document.querySelector('#question_display');
    if(checkedNumber > 1) {
        selectOption.selectedIndex = 'checkbox';
        selectOption.disabled = true;
        //show alert only once
        let alerted = localStorage.getItem('alerted') || '';
            if (alerted !== 'yes') {
            showAlert('alert-warning', 'If there is more then one correct answer, it will be displayed as checkboxes');
            localStorage.setItem('alerted','yes');
            }
    } else {
        selectOption.disabled = false;
    }
}


clearLocalStorage = () => {
    let logoutBtn = document.querySelector('.logoutBtn');
    logoutBtn.addEventListener('click', ()=> {
        localStorage.removeItem('alerted');
    });
}

clearLocalStorage();


