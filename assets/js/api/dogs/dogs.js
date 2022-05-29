let submitNewDogForm = document.getElementById('submit-new-dog-form');

if(submitNewDogForm){
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

let editDogForm = document.getElementById('edit-dog-form');

if(editDogForm){
    editDogForm.addEventListener('submit', (e) => {
        e.preventDefault();
    
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
}

let deleteDogBtn = document.querySelector('.delete-dog');

if(deleteDogBtn){
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
