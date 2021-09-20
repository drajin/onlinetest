



function Quiz(response) {
    this.text = ``;
    this.questions = response.questions;
    this.answers = response.answers;

    this.createQuizForm = function() {
        this.text += `<form>`;
        this.questions.forEach((question) => {
            let counter = 0;
            let ans = [];
                this.text += question.question_text;

            this.answers.forEach((answer) => {
                if(question.q_id === answer.question_id) {
                    ans.push(answer);
                    counter++;
                }

            });
            if(counter === 2) {
                this.text += this.createSelectOption(ans);
            } else if (counter === 3) {
                this.text += this.createRadioBtns(ans);
            } else {
                this.text += this.createCheckboxBtns(ans);
            }
        });
        this.text += `  <button type="submit" class="btn btn-primary">Submit</button></form>`;
        return this.text;
    }


    this.createSelectOption = function(answer) {
        let text = ` <select class="form-select" >`;
        for(i=0; i<answer.length; i++) {
            text += `<option value="${answer[i].id}">${answer[i].answer_text}</option>`;
        }
        text += `</select>`;
        return text;
    }

    this.createRadioBtns = function(answer) {
        let text = '';
        for(i=0; i<answer.length; i++) {
            text += `                
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="${answer[i].id}" checked>
                        <label class="form-check-label" for="exampleRadios1">${answer[i].answer_text}</label>
                    </div>`;
        }
        return text;
    }

    this.createCheckboxBtns = function(answer) {
        let text = '';
        for(i=0; i<answer.length; i++) {
            text += `                
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="${answer[i].id}" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">${answer[i].answer_text}</label>
                </div> `;
        }
        return text;
    }

}



// foreach($questions as $question) {
//     echo $question->question_text . '<br>';
//     echo ('<ul>');
//     foreach($answers as $answer) {
//         if($question->q_id === $answer->question_id) {
//             echo '<li>' . $answer->answer_text . '</li><br>';
//         }
//     }
//     echo ('</ul>');
//
// }

let quiz;


DB.getQuizQuestions().then((response)=>{
    quiz = new Quiz(response);
    quizView.innerHTML = quiz.createQuizForm();
},(err)=>{
    console.log('err');
});

