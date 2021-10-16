//show results view
let showResults = `
    <div class="my-3 p-3 transparent rounded shadow-sm">
        <h1 id="title" class="display-4 text-center m-3 p-3"><i class="far fa-check-circle"></i>Success You've Passed!(barely)</h1>
        <h2 id="message" class="text-center">You barely passed... Your Knowledge is average, you can do better!</h2>
        <br>
        <div class="result resultBg row">
            <div class="col-md-6 text-center totalScore d-flex align-items-center flex-column justify-content-center">
                <p>Your total score:</p>
                <span class="badge score">{{result}}%</span>
            </div>
            <div class="col-md-6 d-flex align-items-start flex-column justify-content-center">
                <ul>
                    <li id="numQuestions"></li>
                    <li id="correctQuestions"></li>
                    <li>Passing score: 80%</li>
                </ul>
            </div>
        </div>
        <div class="buttons d-flex flex-row justify-content-center mt-4">
            <div class="mid">
                <a href="#" class="btn btn-secondary btn-lg me-3 test retakeQuiz" role="button">Retake the Quiz</a>
            </div>
            <div class="mid">
                <a href="#" class="btn btn-secondary btn-lg ms-3 allResults" role="button">View all your Results</a>
            </div>
        </div>
    </div>
    `;

let showResultsHistory = `
            <div class="my-3 p-3 transparent rounded shadow-sm">
                <h1 class="display-4 text-center m-3 p-3">{{name}}</h1>
                    <div class="resultBg">
                        <div class="table-responsive">
                            <table class="table table-striped text-white text-center"">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Score</th>
                                    <th scope="col">Correct Answers</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{results}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                <div class="buttons d-flex flex-row justify-content-center mt-4">
                    <div class="mid">
                        <a href="#" class="btn btn-secondary btn-lg me-3 test retakeQuizBtn" role="button">Retake the Quiz</a>
                    </div>
                    <div class="mid">
                        <a href="#" class="btn btn-secondary btn-lg ms-3 logOutBtn" role="button">Exit</a>
                    </div>
                </div>
            </div>
    `;

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