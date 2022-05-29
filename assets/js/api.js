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

let submitNewCommentForm = document.getElementById('submit-new-comment-form');

if(submitNewCommentForm){
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
    })
}

function generateDeleteEventListeners(){
    let deleteCommentBtns = document.querySelectorAll('.delete-comment');

    deleteCommentBtns.forEach(deleteCommentBtn => {
        deleteCommentBtn.removeEventListener('click', handleCommentDeleteClick);
        deleteCommentBtn.addEventListener('click', handleCommentDeleteClick);
    });
}

function handleCommentDeleteClick(){
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

generateDeleteEventListeners();

function generateEditEventListeners(){
    let editCommentBtns = document.querySelectorAll('.edit-comment');

    editCommentBtns.forEach(editCommentBtn => {
        editCommentBtn.removeEventListener('click', handleCommentEditClick);
        editCommentBtn.addEventListener('click', handleCommentEditClick);
    });
}

function handleCommentEditClick(){
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

generateEditEventListeners();


let addToFavorites = document.querySelector('.add-to-favorites');

if(addToFavorites){
    addToFavorites.addEventListener('click', (e) => {
        let favorite = addToFavorites.getAttribute('data-favorite');

        $.ajax({
            url: favorite == "" ? './models/favorites/insert.php' : './models/favorites/delete.php',
            type: 'POST',
            data: {
                dogID: addToFavorites.getAttribute('data-dog-id'),
                submit: true,
            },
            dataType: "json",
            success: (response) => {
                if(favorite == ""){
                    alert("Dog Added To Favorites Successfully");
                    addToFavorites.innerHTML = `<i class="fa fa-heart" aria-hidden="true"></i> Remove from favorites <i class="fa fa-heart" aria-hidden="true"></i>`;
                    addToFavorites.setAttribute('data-favorite', 1);
                    let spanNumberOfFavorites = document.querySelector('.number-of-favorites');
                    let numberOfFavorites = spanNumberOfFavorites.innerHTML;
                    spanNumberOfFavorites.innerHTML = ++numberOfFavorites;

                    return;
                }

                alert("Dog Removed From Favorites Successfully");
                addToFavorites.innerHTML = `<i class="fa fa-heart" aria-hidden="true"></i> Add to favorites <i class="fa fa-heart" aria-hidden="true"></i>`;
                addToFavorites.setAttribute('data-favorite', "");  
                let spanNumberOfFavorites = document.querySelector('.number-of-favorites');
                let numberOfFavorites = spanNumberOfFavorites.innerHTML;
                spanNumberOfFavorites.innerHTML = --numberOfFavorites;          
            },
            error: (response) => {
                console.log(response)
                console.log(response.responseText)
            }
        });
    })
}