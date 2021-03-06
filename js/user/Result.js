

    class Result {



        // saves result in DB
        static save = (result) => {
            DB.sendResults(result).then((response) => {
                this.showResult(result);
            }), (error) => {
                console.log(error);
            }
        };

        static showHistoryResults = () => {
            DB.getHistoryResults().then((response) => {
                showView.resultsHistory(response);
            }), (error) => {
                console.log(error);
            }
        };

        //shows results
        static showResult = (result) => {
            if(result.points >= 90) {
                let outcome = {
                    'title' : '<i class="far fa-check-circle"></i>  Success You\'ve Passed!',
                    'message' : 'Excellent work! Your Knowledge is outstanding!',
                    'result' : result.points,
                    'color' : "rgba(148, 254, 134, 0.8)",
                    'badge' : 'bg-success',
                };
                showView.result(outcome);
            } else if (result.points < 90 && result.points >= 80 ) {
                let outcome = {
                    'title' : '<i class="far fa-check-square"></i> Success You\'ve Passed!(barely)',
                    'message' : 'You barely passed... Your Knowledge is average, you can do better!',
                    'result' : result.points,
                    'color' : "rgba(246, 255, 127, 0.8)",
                    'badge' : 'bg-warning',
                };
                showView.result(outcome);

            } else {
                let outcome = {
                    'title' : '<i class="far fa-times-circle"></i> FAILED!',
                    'message' : 'You Have Failed Miserably! Do something about it!',
                    'result' : result.points,
                    'color' : "rgba(224, 155, 124, 0.8)",
                    'badge' : 'bg-danger',
                };
                showView.result(outcome);
            }

        }


    }


