let pagesStat = document.querySelector('.pages-stat');
let activeUsers = document.querySelector('.active-users');

$.ajax({
    url: './models/users/admin.php',
    type: 'GET',
    success: (response) => {
        let pages = Object.keys(response.pages);

        pages.forEach(page => {
            pagesStat.innerHTML += ` <tr>
            <td>${page}</td>
            <td>${response.pages[page].total} (${Math.round(response.pages[page].total / response.total * 100 * 100) / 100}%)</td>
            <td>${response.pages[page].last24} (${Math.round(response.pages[page].last24 / response.total24 * 100 * 100) / 100}%)</td>
        </tr>`
        });

        activeUsers.innerHTML = `Number of users in last 24h: ${response.users.length}`
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