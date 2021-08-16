
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
            xml.open('GET','get_data.php');
            xml.send();
        })

    }

    static register(newUser) {
        return new Promise((resolve, reject)=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState === 4 && xml.status === 200) {
                    //xml.responseText
                    //console.log(xml.responseText);
                    resolve(xml.responseText); //returns success or error
                }
            };
            xml.open('POST','save_data.php');
            xml.setRequestHeader("Content-type", "application/json"); //inform xml that json is coming
            xml.send(JSON.stringify(newUser));
        })

    }

    static login(existingUser) {
        return new Promise((resolve, reject)=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState === 4 && xml.status === 200) {
                    //xml.responseText
                    //console.log(xml.responseText);
                    resolve(xml.responseText); //returns success or error
                }
            };
            console.log(existingUser);
            xml.open('POST','save_data.php');
            xml.setRequestHeader("Content-type", "application/json"); //inform xml that json is coming
            xml.send(JSON.stringify(existingUser));
        })

    }

}