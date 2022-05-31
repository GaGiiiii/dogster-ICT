// EDIT DOGS =======================================================================================
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

// ADD DOGS =======================================================================================

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

// DELETE DOGS =======================================================================================

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

// SHOW ALL DOGS HOME =======================================================================================

let dogsDivG = document.getElementById('dogs');

if (dogsDivG) {
    $.ajax({
        url: './models/dogs/getAll.php?page=1',
        type: 'GET',
        success: (response) => {
            createPagination(response.totalPages);

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
        }
    });
}

function createPagination(totalPages) {
    let pagination = document.querySelector('.pagination');
    let html = ``;

    for(let i = 0; i < totalPages; i++){
        html += `<li class="page-item"><a data-page="${(i+1)}" class="page-link" href="#">${(i+1)}</a></li>`;
    }

    pagination.innerHTML = html;

    let lis = document.querySelectorAll('.page-link');

    lis.forEach(li => {
        li.addEventListener('click', (e) => {
            $.ajax({
                url: './models/dogs/getAll.php?page=' + li.getAttribute('data-page'),
                type: 'GET',
                success: (response) => {     
                    dogsDivG.innerHTML = "";   
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
                }
            });
        })
    })
}

// SHOW DOGS =======================================================================================

let data = document.querySelector('.data');

if (data) {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    $.ajax({
        url: './models/dogs/show.php?id=' + id,
        type: 'GET',
        success: (response) => {
            generateHTML(response, data);
            generateDeleteEventListeners();
            generateEditEventListeners();

            let submitNewCommentForm = document.getElementById('submit-new-comment-form');

            submitNewCommentForm.addEventListener('submit', (e) => {
                e.preventDefault();

                let comment = (document.querySelector(`textarea[name="comment"]`)).value;
                let dog_id = (document.querySelector(`input[name="dog_id"]`)).value;

                $.ajax({
                    url: './models/comments/insert.php',
                    type: 'POST',
                    data: {
                        comment,
                        dog_id,
                        submit: true,
                    },
                    dataType: "json",
                    success: (response) => {
                        console.log(response)
                        alert("Comment Added Successfully");
                        let allCommentsDIV = document.querySelector('.all-comments');

                        let newComment = document.createElement('div');
                        newComment.classList.add('comment');
                        newComment.classList.add('mb-2');
                        newComment.setAttribute('data-div-comment-id', response.comment.id);

                        newComment.innerHTML = `<div class="d-flex justify-content-between mb-2">
                                <div>
                                    <i class="fa fa-user" aria-hidden="true"></i> ${response.comment.username} &nbsp;
                                    <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample_${response.comment.id}" aria-expanded="false" aria-controls="collapseExample_${response.comment.id}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </button>
                                    <button data-comment-id="${response.comment.id}" class="btn btn-sm btn-outline-danger delete-comment"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </div>
                                <div>Created at: ${response.comment.created_at} </div>
                            </div>
                            <p data-comment-id="${response.comment.id}" class="card-text">${response.comment.body}</p>
                            <div class="collapse" id="collapseExample_${response.comment.id}">
                                <textarea data-comment-id="${response.comment.id}" class="form-control" placeholder="Leave a comment here" style="height: 100px">${response.comment.body}</textarea>
                                <button data-comment-id="${response.comment.id}" class="btn btn-warning mt-3 edit-comment">Edit</button>
                            </div>
                            <hr>`;
                        allCommentsDIV.prepend(newComment);

                        let spanNumberOfComments = document.querySelector('.number-of-comments');
                        let numberOfComments = spanNumberOfComments.innerHTML;
                        spanNumberOfComments.innerHTML = ++numberOfComments;

                        generateDeleteEventListeners();
                        generateEditEventListeners();
                        (document.querySelector(`textarea[name="comment"]`)).value = "";
                    },
                    error: (response) => {
                        console.log(response)
                        console.log(response.responseText)
                        let errorsDiv = document.getElementById('comment-errors');
                        let responseTextParsed = JSON.parse(response.responseText);
                        let errors = responseTextParsed['errors'];
                        let errorKeys = Object.keys(responseTextParsed["errors"]);

                        errorsDiv.innerHTML = "";

                        errorKeys.forEach(err => {
                            errorsDiv.innerHTML += errors[err];
                        });
                    }
                });
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

function generateHTML(response, data) {
    let html = `<img src="${response.dog.img}" class="card-img-top">
    <div class="card dog-card-show">
        <div class="card-body">
            <div class="text-center">
                <i class="fa fa-user" aria-hidden="true"></i>
                Admin &nbsp;
                <i class="fa fa-calendar" aria-hidden="true"></i>
                Created at: ${response.dog.created_at}h &nbsp;
                <i class="fa fa-comments" aria-hidden="true"></i>
                <span class="number-of-comments"> ${response.comments.length}</span> comments &nbsp;
                <i class="fa fa-heart" aria-hidden="true"></i>
                <span class="number-of-favorites"> ${response.favorites.length}</span> favorites
            </div>
            ${response.admin ? `<div class="text-center mt-2">
            <a class="btn btn-sm btn-warning" href="index.php?page=dogs-edit&id=${response.dog.id}">Edit</a>
            <button data-dog-id="${response.dog.id}" class="btn btn-sm btn-danger delete-dog">Delete</button>
        </div>` : ``}
            <hr>
            <h4 class="card-title">${response.dog.name}</h4>
            <h6 class="card-subtitle mb-2 text-muted">${response.dog.breed}</h6>

            <p class="card-text">${response.dog.description}</p>
            <hr>
            <div data-favorite="${response.favorite} data-dog-id="${response.dog.id}" class="text-center add-to-favorites">
            ${response.favorite ?
            `<i class="fa fa-heart" aria-hidden="true"></i> Remove from favorites <i class="fa fa-heart" aria-hidden="true"></i>` : `${response.user ? `<i class="fa fa-heart" aria-hidden="true"></i> Add to favorites <i class="fa fa-heart" aria-hidden="true"></i>
                ` : `<!-- Button trigger modal -->
                <button style="border: none; background-color: transparent;" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa fa-heart" aria-hidden="true"></i> Add to favorites <i class="fa fa-heart" aria-hidden="true"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Info</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                You need to be <a href="index.php?page=login">logged</a> in to like dogs :)
                            </div>
                        </div>
                    </div>
                </div>`}`}
            </div>
        </div>
    </div>

    <div id="comments" class="mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="mt-1">
                    <i class="fa fa-comment" aria-hidden="true"></i> Comments
                </div>
                <div>
                    <button class="btn btn-sm btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Add New Comment
                    </button>

                </div>
            </div>
            <div class="collapse" id="collapseExample">
            ${response.user ? `  <div class="card card-body">
            <div id="comment-errors" class="mb-3"></div>
            <form id="submit-new-comment-form">
                <input type="hidden" name="dog_id" value="${response.dog.id}">
                <div class="mb-4">
                    <label class="form-label">Comment <strong class="text-danger">*</strong></label>
                    <textarea class="form-control" name="comment" placeholder="Enter comment" id="floatingTextarea2" style="height: 100px"></textarea>
                </div>
                <button type="submit" class="btn btn-secondary w-100">Submit</button>
            </form>
        </div>` : ` <div class="card card-body card-please-login">
        <p class="mb-0">Please <a href="index.php?page=login">login</a> to leave a comment.</p>
    </div>`}
            </div>
            <div class="card-body all-comments">`

    response.comments.forEach(comment => {
        html += `<div data-div-comment-id="${comment.id}" class="comment mb-2">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <i class="fa fa-user" aria-hidden="true"></i> ${comment.username} &nbsp;
                            ${(response.user && response.user.id == comment.UID) || response.admin ? `<button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample_${comment.id}" aria-expanded="false" aria-controls="collapseExample_${comment.id}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button>
                        <button data-comment-id="${comment.id}" class="btn btn-sm btn-outline-danger delete-comment"><i class="fa fa-trash" aria-hidden="true"></i></button>` : ``}
                        </div>
                        <div>Created at: ${comment.created_at}</div>
                    </div>
                    <p data-comment-id="${comment.id}" class="card-text">${comment.body}</p>
                    <div class="collapse" id="collapseExample_${comment.id}">
                        <textarea data-comment-id="${comment.id}" class="form-control" placeholder="Leave a comment here" style="height: 100px">${comment.body}</textarea>
                        <button data-comment-id="${comment.id}" class="btn btn-warning mt-3 edit-comment">Edit</button>
                    </div>
                    <hr>
                </div>`;
    })

    html += `
            </div>
        </div>
    </div>`

    data.innerHTML = html;
}



function generateDeleteEventListeners() {
    let deleteCommentBtns = document.querySelectorAll('.delete-comment');

    deleteCommentBtns.forEach(deleteCommentBtn => {
        deleteCommentBtn.removeEventListener('click', handleCommentDeleteClick);
        deleteCommentBtn.addEventListener('click', handleCommentDeleteClick);
    });
}

function handleCommentDeleteClick() {
    let commentID = this.getAttribute('data-comment-id');

    $.ajax({
        url: './models/comments/delete.php',
        type: 'POST',
        data: {
            commentID,
            submit: true,
        },
        dataType: "json",
        success: (response) => {
            alert("Comment Deleted Successfully");
            let element = document.querySelector(`[data-div-comment-id="${commentID}"]`);
            element.remove();
            let spanNumberOfComments = document.querySelector('.number-of-comments');
            let numberOfComments = spanNumberOfComments.innerHTML;
            spanNumberOfComments.innerHTML = --numberOfComments;
        },
        error: (response) => {
            console.log(response)
            console.log(response.responseText)
        }
    });
}

function generateEditEventListeners() {
    let editCommentBtns = document.querySelectorAll('.edit-comment');

    editCommentBtns.forEach(editCommentBtn => {
        editCommentBtn.removeEventListener('click', handleCommentEditClick);
        editCommentBtn.addEventListener('click', handleCommentEditClick);
    });
}

function handleCommentEditClick() {
    let commentID = this.getAttribute('data-comment-id');
    let comment = (document.querySelector(`textarea[data-comment-id="${commentID}"]`)).value;

    $.ajax({
        url: './models/comments/update.php',
        type: 'POST',
        data: {
            commentID,
            comment,
            submit: true,
        },
        dataType: "json",
        success: (response) => {
            console.log(response)
            alert("Comment Edited Successfully");
            (document.querySelector(`p[data-comment-id="${commentID}"]`)).innerHTML = comment;
        },
        error: (response) => {
            console.log(response)
            console.log(response.responseText)
        }
    });
}

