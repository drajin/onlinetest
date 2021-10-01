
class DB {

    static postQuestionAnsw(data) {
        // return new Promise((resolve, reject) => {
        // fetch('http://localhost/onlinetest/backend/post_question_answ.php',{
        //         method: 'POST',
        //         headers: {
        //             'Content-type': 'application/json',
        //         },
        //         body: JSON.stringify(data)
        //     })
        //         .then(resolve => resolve)
        //         .then(data => resolve(data))
        //         .catch(err => reject(err));
        // });


        return new Promise((resolve, reject)=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState === 4 && xml.status === 200) {
                    //console.log(xml.responseText);
                    resolve(xml.responseText);
                }
            };
            xml.open('POST','http://localhost/onlinetest/backend/post_question_answ.php');
            xml.setRequestHeader("Content-type", "application/json"); //inform xml that json is coming
            xml.send(JSON.stringify(data));
        })


    }

}