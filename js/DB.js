
class DB {


    static getAll() {
        return new Promise((resolve, reject)=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState == 4 && xml.status == 200) {
                    //xml.responseText
                    //resolve(JSON.parse(xml.responseText));
                    //console.log(JSON.parse(xml.responseText));
                }
            };
            xml.open('GET','backend/get_data.php');
            xml.send();
        })

    }

    static getAllQuestions() {
        return new Promise((resolve, reject)=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState == 4 && xml.status == 200) {
                    //xml.responseText
                    //resolve(JSON.parse(xml.responseText));
                    resolve(JSON.parse(xml.responseText));
                }
            };
            xml.open('GET','backend/get_all_questions.php', true);
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
                    //console.log(xml.responseText); //konzoluje sta vraca php
                    resolve(xml.responseText); //returns success or error
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
                    //console.log(xml.responseText);
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

                }
            };
            xml.open('POST','backend/check_data.php');
            xml.setRequestHeader("Content-type", "application/json"); //inform xml that json is coming
            xml.send(JSON.stringify(email));
        })
    }


}