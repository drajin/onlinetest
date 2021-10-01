validate = (e) => {
    e.preventDefault();
}




submit = document.querySelector('#submitLogin');
submit.addEventListener('click', validate);


function ValidateForm() {
    this.NoError = true;

    this.login = function() {
        this.NoError = true;
        this.checkEmailLogin();
        this.checkPassword();
    };

    this.register = function() {
        this.NoError = true;
        this.checkFirstName();
        this.checkLastName();
        this.checkEmailReg();
        this.checkPassword();
        this.checkPasswordConfirm();
    };


    this.checkFirstName = function() {

        if(firstNameValue === '') {
            this.setError(firstNameInput, 'First Name can\'t be blank');
        } else {
            this.setSuccess(firstNameInput);
        }
    };

    this.checkLastName = function() {
        if(lastNameValue === '') {
            this.setError(lastNameInput, 'Last Name can\'t be blank');
        } else {
            this.setSuccess(lastNameInput);
        }
    };

    this.checkEmailReg = function() {

        if(emailValue === '') {
            return this.setError(emailInput, 'Email can\'t be blank.');
        }
        else if (!this.isEmail(emailValue)) {
            return this.setError(emailInput, 'This is not a valid email address.');
        }
        this.emailUnique().then((response)=>{
            if(response === 'true') {
                this.setSuccess(emailInput);
            } else {
                this.setError(emailInput, 'Email in use.');
            }
        },(err)=>{
            //
        });

    };

    this.checkEmailLogin = function() {

        if(emailValue === '') {
            return this.setError(emailInput, 'Email can\'t be blank.');
        }
        else if (!this.isEmail(emailValue)) {
            return this.setError(emailInput, 'This is not a valid email address.');
        } else {
            this.setSuccess(emailInput);
        }

    };

    this.emailUnique = function() {
        return DB.isEmailUnique(emailValue);
        // console.log('email Uniqe function', emailUniqueValue);
        // setTimeout(()=>{
        //     if (!emailUniqueValue) {
        //         this.setError(emailInput, 'Email address is already registered.');
        //     }
        //     else {
        //         this.setSuccess(emailInput);
        //     }
        //
        //     hideLoader();
        // },2000)

    };

    this.checkPassword = function() {
        if(passwordValue === '') {
            this.setError(passwordInput, 'Password can\'t be blank.');
        } else {
            this.setSuccess(passwordInput);
        }
    };

    this.checkPasswordConfirm = function() {
        if(passwordConfirmValue === '') {
            this.setError(passwordConfirmInput, 'Password Confirm can\'t be blank.');
        } else if(passwordValue !== passwordConfirmValue){
            this.setError(passwordConfirmInput, 'Passwords doesn\'t match.');
        } else {
            this.setSuccess(passwordConfirmInput);
        }
    };

    this.isEmail = function(email) {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
    };

    // this.emailUniqueCheck = function() {
    //     DB.isEmailUnique(emailValue).then((response)=>{
    //         console.log('if unique true', response);
    //         if(response === 'true') {
    //             emailUniqueValue = true;
    //         } else {
    //             emailUniqueValue = false;
    //         }
    //     },(err)=>{
    //         //
    //     })
    // };

    //show error message
    this.setError = function (input, msg) {
        this.NoError = false;
        input.classList.remove("is-valid");
        input.classList.add("is-invalid");
        input.nextElementSibling.innerText = msg ;
    };
    //show success
    setTimeout( () =>   this.setSuccess = function(input) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
        input.nextElementSibling.innerText = '' ;
    } ,3000 );


} //ValidateForm
