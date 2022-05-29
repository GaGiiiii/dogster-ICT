let registerForm = document.getElementById('register-form');
let loginForm = document.getElementById('login-form');

if(registerForm){
    registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
    
        let username = (document.querySelector(`input[name="username"]`)).value;
        let email = (document.querySelector(`input[name="email"]`)).value;
        let password = (document.querySelector(`input[name="password"]`)).value;
        let confirmPassword = (document.querySelector(`input[name="password2"]`)).value;
        let birthday = (document.querySelector(`input[name="birthday"]`)).value;
    
        $.ajax({
            url: './models/users/insert.php',
            type: 'POST',
            data: {
                username,
                email,
                password,
                confirmPassword,
                birthday,
                register: true,
            },
            dataType: "json",
            success: (response) => {
                alert("Registration successful");
                window.location.href = './index.php';
            },
            error: (response) => {
                console.log(response)
                console.log(response.responseText)
                let errorsDiv = document.getElementById('register-errors');
                let responseTextParsed = JSON.parse(response.responseText);
                let errors = responseTextParsed['errors'];
                let errorKeys = Object.keys(responseTextParsed["errors"]);
    
                errorsDiv.innerHTML = "";
    
                errorKeys.forEach(err => {
                    errorsDiv.innerHTML += errors[err];
                });
            }
        });
    })
}

if(loginForm){
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
    
        let usernameOrEmail = (document.querySelector(`input[name="usernameOrEmail"]`)).value;
        let password = (document.querySelector(`input[name="password"]`)).value;
    
        $.ajax({
            url: './models/users/login.php',
            type: 'POST',
            data: {
                usernameOrEmail,
                password,
                login: true,
            },
            dataType: "json",
            success: (response) => {
                alert("Login successful");
                window.location.href = './index.php';
            },
            error: (response) => {
                console.log(response)
                console.log(response.responseText)
                let errorsDiv = document.getElementById('login-errors');
                let responseTextParsed = JSON.parse(response.responseText);
                let errors = responseTextParsed['errors'];
                let errorKeys = Object.keys(responseTextParsed["errors"]);
    
                errorsDiv.innerHTML = "";
    
                errorKeys.forEach(err => {
                    errorsDiv.innerHTML += errors[err];
                });
            }
        });
    })
}


let searchInput = document.querySelector('.search-input');

if(searchInput){
    searchInput.addEventListener('keyup', (e) => {
        console.log(searchInput.value)
    })
}