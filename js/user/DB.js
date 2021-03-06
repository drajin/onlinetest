
class DB {

    static getQuizQuestions() {
        return new Promise((resolve, reject)=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState == 4 && xml.status == 200) {
                    //xml.responseText
                    //console.log((xml.responseText));
                    resolve(JSON.parse(xml.responseText));
                }
            };
            xml.open('GET','backend/get_questions_answers.php', true);
            xml.send();
        })
    }

    static getSession() {
        return new Promise((resolve, reject)=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState == 4 && xml.status == 200) {
                    resolve(xml.responseText);
                }
            };
            xml.open('GET','backend/get_session.php');
            xml.send();
        })
    }

    static register(newUser) {
        return new Promise((resolve, reject)=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState === 4 && xml.status === 200) {
                    //console.log(xml.responseText);
                    resolve(xml.responseText);
                }
            };
            xml.open('POST','backend/login_register.php');
            xml.setRequestHeader("Content-type", "application/json"); //inform xml that json is coming
            xml.send(JSON.stringify(newUser));
        })

    }

    static login(existingUser) {
        return new Promise((resolve, reject)=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState === 4 && xml.status === 200) {
                    resolve(xml.responseText); //true success or false
                }
            };
            xml.open('POST','backend/login_register.php');
            xml.setRequestHeader("Content-type", "application/json"); //inform xml that json is coming
            xml.send(JSON.stringify(existingUser));
        })

    }

    static sessionDestroy() {
        return new Promise((resolve, reject)=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState == 4 && xml.status == 200) {
                    resolve(xml.responseText);
                    //console.log(xml.responseText);

                }
            };
            xml.open('GET','backend/logout.php');
            xml.send();
        })
    }


    static isEmailUnique(email) {
        return new Promise((resolve, reject)=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState == 4 && xml.status == 200) {
                   resolve(xml.responseText);
                   // console.log(xml.responseText);
                }
            };
            xml.open('POST','backend/check_email.php');
            xml.setRequestHeader("Content-type", "application/json"); //inform xml that json is coming
            xml.send(JSON.stringify(email));
        })
    }

    static sendResults(points) {
        return new Promise((resolve, reject)=>{

            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState == 4 && xml.status == 200) {
                    resolve(xml.responseText);

                }
            };
            xml.open('POST','backend/post_results.php');
            xml.setRequestHeader("Content-type", "application/json"); //inform xml that json is coming
            xml.send(JSON.stringify(points));
        })
    }

    static getHistoryResults() {
        return new Promise((resolve, reject)=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState == 4 && xml.status == 200) {
                    resolve(JSON.parse(xml.responseText));
                    //console.log(resolve);
                }
            };
            xml.open('GET','backend/get_history_results.php');
            xml.send();
        })
    }




}