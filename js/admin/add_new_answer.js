
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
    //makes outer div to prevent content to be serialized
    let dvi = document.createElement('div', );
    dvi.innerHTML += newAnswer.replaceAll("{{dynamic}}", numberOfAnswers.toString());
    generatedAnswers.appendChild(dvi);

    let genAnswersId = [2, 3, 4];

    genAnswersId.forEach((answerID) => {
        if(document.querySelector('#removeBtn-'+answerID)) {
            removeBtnFun(document.querySelector('#removeBtn-'+answerID));
        }
    });
    numberOfAnswers++;
    checkNumberOfAnswers();

};

// createNewAnswer = () => {
//     let generatedAnswers = document.querySelector('.generatedAnswers');
//
//     generatedAnswers.innerHTML += newAnswer.replaceAll("{{dynamic}}", numberOfAnswers.toString());
//
//     let genAnswersId = [2, 3, 4];
//
//     genAnswersId.forEach((answerID) => {
//         if(document.querySelector('#removeBtn-'+answerID)) {
//             removeBtnFun(document.querySelector('#removeBtn-'+answerID));
//         }
//     });
//     numberOfAnswers++;
//     checkNumberOfAnswers();
//
// };

//disables add new button if there is more then 5 answers
checkNumberOfAnswers = () => {
    if(numberOfAnswers > 4) {
        addAnswerBtn.classList.add('disabled');
    } else {
        addAnswerBtn.classList.remove('disabled');
    }
};

removeBtnFun = (removeBtn) => {
    console.log(removeBtn)
    if(removeBtn.getAttribute('listener') !== 'true') {
        removeBtn.addEventListener('click', (e) => {
            console.log(removeBtn)
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
};

changeDefaultQuestionDisplay();

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
};


clearLocalStorage = () => {
    let logoutBtn = document.querySelector('.logoutBtn');
    logoutBtn.addEventListener('click', ()=> {
        localStorage.removeItem('alerted');
    });
};

clearLocalStorage();


