
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