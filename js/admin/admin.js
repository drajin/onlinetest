
//select add answer button
let addAnswerBtn = document.querySelector('.addAnswer');


//add new answer
addAnswerBtn.addEventListener('click', (e)=> {
    e.preventDefault();
    createNewAnswer();
});


createNewAnswer = () => {
    let newAnswers= document.querySelectorAll('.newAnswers');
    let numAnswers = newAnswers.length;
    //checks the number of add new answers
    if(numAnswers > 1) {
        // disables button if it is larger then 3
        if(numAnswers > 2) {
            addAnswerBtn.classList.add("disabled");
            newAnswers = newAnswers[newAnswers.length - 1];
        } else {
            newAnswers = newAnswers[newAnswers.length - 1];
        }
    } else {
        newAnswers =  newAnswers[0]
    }
    // fetches the answers from file
    fetch('add_new_answer.php')
        .then((res)=>{
            return res.text();
        })
        .then((data) => {
            //generate ids dynamically
            numAnswers = numAnswers + 1;
            let dynamicId = data.replaceAll("dynamic", numAnswers.toString());
            newAnswers.innerHTML = dynamicId;
            //removeBtns(newAnswers); TODO remove btn functionality
        })
        .catch(err => console.log(err));
}















//remove btn functionality
// removeBtns = (newAnswers) => {
//     let removeBtn = document.querySelectorAll('.remove');
//     removeBtn.forEach((remove) =>{
//         remove.addEventListener('click',(e)=>{
//             e.preventDefault();
//             newAnswers.remove();
//             //this.parentNode.removeChild(this);
//             //console.log(this)
//
//         })
//     } )
// }
