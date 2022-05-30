let editDiv = document.querySelector('.edit-dog');

if (editDiv) {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    $.ajax({
        url: './models/dogs/get.php?id=' + id,
        type: 'GET',
        success: (response) => {
            editDiv.innerHTML = `<h1 class="mb-1">Edit "${response.dog.name}" &#128021;</h1>
            <p class="mb-4">Fields marked with <strong class="text-danger">*</strong> are required.</p>
            
            <div id="edit-dog-errors" class="mb-3"></div>
            
            <form id="edit-dog-form">
                <div class="mb-4">
                    <label class="form-label">Breed <strong class="text-danger">*</strong></label>
                    <input name="breed" type="text" class="form-control" placeholder="Enter breed" value="${response.dog.breed}">
                </div>
            
                <div class="mb-4">
                    <label class="form-label">Name <strong class="text-danger">*</strong></label>
                    <input name="name" type="text" class="form-control" placeholder="Enter name" value="${response.dog.name}">
                </div>
            
                <div class="mb-4">
                    <label class="form-label">Description <strong class="text-danger">*</strong></label>
                    <textarea class="form-control" name="description" placeholder="Enter description" id="floatingTextarea2" style="height: 100px">${response.dog.description}</textarea>
                </div>
            
                <input type="hidden" name="dogID" value="${response.dog.id}">
            
                <div class="mb-4">
                    <label class="form-label">Upload Image</label> <br>
                    <input type="file" name="file">
                </div>
            
                <button type="submit" class="btn btn-secondary w-100">Submit</button>
            </form>`;

            let editDogForm = document.getElementById('edit-dog-form');


            editDogForm.addEventListener('submit', (e) => {
                e.preventDefault();
                console.log("A");


                let formData = new FormData();
                formData.append('dogID', (document.querySelector(`input[name="dogID"]`)).value);
                formData.append('breed', (document.querySelector(`input[name="breed"]`)).value);
                formData.append('name', (document.querySelector(`input[name="name"]`)).value);
                formData.append('breedDescription', (document.querySelector(`textarea[name="description"]`)).value);
                formData.append('breedImage', (document.querySelector(`input[name="file"]`)).files[0]);
                formData.append('submit', true);

                $.ajax({
                    url: './models/dogs/update.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: (response) => {
                        alert("Dog Updated Successfully");
                        window.location.href = './index.php';
                    },
                    error: (response) => {
                        console.log(response)
                        console.log(response.responseText)
                        let errorsDiv = document.getElementById('edit-dog-errors');
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

        },
        error: (response) => {
            console.log(response)
            console.log(response.responseText)
            let errorsDiv = document.getElementById('add-new-dog-errors');
            let responseTextParsed = JSON.parse(response.responseText);
            let errors = responseTextParsed['errors'];
            let errorKeys = Object.keys(responseTextParsed["errors"]);

            errorsDiv.innerHTML = "";

            errorKeys.forEach(err => {
                errorsDiv.innerHTML += errors[err];
            });
        }
    });
}

let submitNewDogForm = document.getElementById('submit-new-dog-form');

if (submitNewDogForm) {
    submitNewDogForm.addEventListener('submit', (e) => {
        e.preventDefault();

        let formData = new FormData();
        formData.append('breed', (document.querySelector(`input[name="breed"]`)).value);
        formData.append('name', (document.querySelector(`input[name="name"]`)).value);
        formData.append('breedDescription', (document.querySelector(`textarea[name="description"]`)).value);
        formData.append('breedImage', (document.querySelector(`input[name="file"]`)).files[0]);
        formData.append('submit', true);

        $.ajax({
            url: './models/dogs/insert.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: (response) => {
                alert("Dog Added Successfully");
                window.location.href = './index.php';
            },
            error: (response) => {
                console.log(response)
                console.log(response.responseText)
                let errorsDiv = document.getElementById('add-new-dog-errors');
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

let deleteDogBtn = document.querySelector('.delete-dog');

if (deleteDogBtn) {
    deleteDogBtn.addEventListener('click', (e) => {
        let dogID = deleteDogBtn.getAttribute('data-dog-id');

        $.ajax({
            url: './models/dogs/delete.php',
            type: 'POST',
            data: {
                dogID,
                submit: true,
            },
            dataType: "json",
            success: (response) => {
                alert("Dog Deleted Successfully");
                window.location.href = './index.php';
            },
            error: (response) => {
                console.log(response)
                console.log(response.responseText)
            }
        });
    });
}

let dogsDivG = document.getElementById('dogs');

if(dogsDivG){
    $.ajax({
        url: './models/dogs/getAll.php',
        type: 'GET',
        success: (response) => {
            response.dogs.forEach(dog => {
                dogsDivG.innerHTML += `
                <div class="col-md-4 mb-3">
                    <div class="card dog-card">
                        <a href="index.php?page=dogs&id=${dog.id}"><img class="img-thumbnail" width="100%" src="${dog.img}" class="card-img-top"></a>
                        <div class="card-body">
                            <a class="dog-name" href="index.php?page=dogs&id=${dog.id}">
                                <h5 class="card-title">${dog.name}</h5>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted">${dog.breed}</h6>
                            <p class="card-text">${dog.description.substring(0, 250)}....</p>
                            <a href="index.php"?page=dogs&id=${dog.id}" class="btn btn-sm btn-secondary">Read more</a>
                        </div>
                    </div>
                </div>`
            });
        },
        error: (response) => {
            console.log(response)
            console.log(response.responseText)
            let errorsDiv = document.getElementById('add-new-dog-errors');
            let responseTextParsed = JSON.parse(response.responseText);
            let errors = responseTextParsed['errors'];
            let errorKeys = Object.keys(responseTextParsed["errors"]);
    
            errorsDiv.innerHTML = "";
    
            errorKeys.forEach(err => {
                errorsDiv.innerHTML += errors[err];
            });
        }
    });
}