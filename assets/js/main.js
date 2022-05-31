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

        $.ajax({
            url: './models/dogs/filter.php',
            type: 'POST',
            data: {
                searchValue: searchInput.value,
                sortValue: sortInput.value,
                submit: true,
            },
            dataType: "json",
            success: (response) => {
                createPagination(response.totalPages);
                console.log(response.dogs)
                let dogs = response.dogs;
                let dogsDiv = document.getElementById('dogs');
                dogsDiv.innerHTML = "";

                dogs.forEach(dog => {
                    dogsDiv.innerHTML += `<div class="col-md-4 mb-3">
                    <div class="card dog-card">
                        <a href="index.php?page=dogs&id=${dog.id}"><img class="img-thumbnail" width="100%" src="${dog.img}" class="card-img-top"></a>
                        <div class="card-body">
                            <a class="dog-name" href="index.php?page=dogs&id=${dog.id}">
                                <h5 class="card-title">${dog.name}</h5>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted">${dog.breed}</h6>
                            <p class="card-text">${dog.description.substring(0, 250)}....</p>
                            <a href="index.php?page=dogs&id=${dog.id}" class="btn btn-sm btn-secondary">Read more</a>
                        </div>
                    </div>
                </div>`;
                });
            },
            error: (response) => {
                console.log(response)
                console.log(response.responseText)
            }
        });
    })
}

let sortInput = document.querySelector('.sort-input');

if(sortInput){
    sortInput.addEventListener('change', (e) => {
        $.ajax({
            url: './models/dogs/filter.php',
            type: 'POST',
            data: {
                sortValue: sortInput.value,
                searchValue: searchInput.value,
                submit: true,
            },
            dataType: "json",
            success: (response) => {
                createPagination(response.totalPages);
                console.log(response.dogs)
                let dogs = response.dogs;
                let dogsDiv = document.getElementById('dogs');
                dogsDiv.innerHTML = "";

                dogs.forEach(dog => {
                    dogsDiv.innerHTML += `<div class="col-md-4 mb-3">
                    <div class="card dog-card">
                        <a href="index.php?page=dogs&id=${dog.id}"><img class="img-thumbnail" width="100%" src="${dog.img}" class="card-img-top"></a>
                        <div class="card-body">
                            <a class="dog-name" href="index.php?page=dogs&id=${dog.id}">
                                <h5 class="card-title">${dog.name}</h5>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted">${dog.breed}</h6>
                            <p class="card-text">${dog.description.substring(0, 250)}....</p>
                            <a href="index.php?page=dogs&id=${dog.id}" class="btn btn-sm btn-secondary">Read more</a>
                        </div>
                    </div>
                </div>`;
                });
            },
            error: (response) => {
                console.log(response)
                console.log(response.responseText)
            }
        });
    })
}