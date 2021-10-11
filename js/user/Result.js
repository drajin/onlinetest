

    class Result {

         //this.message = 'cong';

        static save = (result) => {
            DB.sendResults(result).then((response) => {
                this.showResult(result);


            }), (error) => {
                console.log(error);
            }
        }

        static showResult = (result) => {
            if(result >= 90) {
                this.outcome = {
                    'title' : '<i class="far fa-check-circle"></i>  Success You\'ve Passed!',
                    'message' : 'Excellent work! Your Knowledge is outstanding!',
                    'result' : result,
                    'color' : "var(--green)",
                    'badge' : 'bg-success',
                }
                showView.result(this.outcome);
            } else if (result <90 && result >= 80 ) {
                this.outcome = {
                    'title' : '<i class="far fa-check-square"></i> Success You\'ve Passed!(barely)',
                    'message' : 'You barely passed... Your Knowledge is average, you can do better!',
                    'result' : result,
                    'color' : "#FFFF99",
                    'badge' : 'bg-warning',
                }
                showView.result(this.outcome);

            } else {
                this.outcome = {
                    'title' : '<i class="far fa-times-circle"></i> FAILED!',
                    'message' : 'You Have Failed Miserably! Do something about it!',
                    'result' : result,
                    'color' : "var(--red)",
                    'badge' : 'bg-danger',
                }
                showView.result(this.outcome);
            }
        }


    }


