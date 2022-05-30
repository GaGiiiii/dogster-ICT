let profileHeader = document.querySelector('.profile-header');
let commentsNumber = document.querySelector('.comments-number');
let commentsList = document.querySelector('.comments-list');
let favoritesNumber = document.querySelector('.favorites-number');
let favoritesList = document.querySelector('.favorites-list');
let userJoined = document.querySelector('.user-joined');

$.ajax({
    url: './models/users/profile.php',
    type: 'GET',
    success: (response) => {
        profileHeader.innerHTML = `<i class="fa fa-user" aria-hidden="true"></i>
        ${response.user.username} | ${response.user.email}`

        commentsNumber.innerHTML = response.comments.length;

        response.comments.forEach(comment => {
            commentsList.innerHTML += `<li>${comment.body}</li>`;
        });

        favoritesNumber.innerHTML = response.favorites.length;

        response.favorites.forEach(favorite => {
            favoritesList.innerHTML += `<li><a class="text-decoration-none" href="index.php?page=dogs&id=${favorite.dog_id}">${favorite.name} (${favorite.breed})</a></li>
            `;
        });

        userJoined.innerHTML = `Joined on: ${response.user.created_at}h`;
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