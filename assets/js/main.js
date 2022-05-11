// $(document).ready(function(){

//     // KORAK 2 - Popunjavanje forme za UPDATE

//     $(document).on('click', '.update-kategorija', function(e){
//         e.preventDefault();
//         // Nakon promene DOM sa novim HTML "osveziPrikazKategorija()" ->
//         // NECE RADITI OVAKO:
//         // $('.update-kategorija').click(function(e){ ... })

//         let id = $(this).data('id');

//         // Pogledati response u Network!!

//         $.ajax({
//             url: 'models/kategorije/get-one.php', // Dogledati kako URL izgleda u Network!
//             method: 'GET',
//             data: {
//                 id: id
//             },
//             dataType: 'json', // Provera da li PHP strana vraca JSON
//             success: function(kategorija){
//                 console.warn('USPESNO DOHVACENA KATEGORIJA');
//                 console.log(kategorija);

//                 // Popunjavanje forme
//                 fillForm(kategorija);
//             }, 
//             error: function(greska, status, statusText){
//                 console.error('GRESKA DOHVATANJE KATEGORIJE:');
                
//                 console.log(greska.parseJSON);
//                 alert(greska.parseJSON.poruka);
//             }
//         })
//     });

//     // UPDATE / INSERT
//     $("#btnSacuvaj").click(function(){
//         let id = $('#hdnId').val();

//         // KORAK 3 - UPDATE

//         if(id !== ''){

//             $.ajax({
//                 url: 'models/kategorije/update.php',
//                 method: 'POST',
//                 data: {
//                     id: id,
//                     naziv: $("#naziv").val()
//                 },
//                 dataType: 'json',
//                 success: function(podaci, status, ceoZahtev){
//                     console.warn('USPESNO SACUVANO');

//                     if(ceoZahtev.status == 204){
//                         console.log('USPESNO SACUVANO!');
//                     }
//                     // Ciscenje forme
//                     clearForm();

//                     // KORAK 4 - Ponovni prikaz kategorija iz baze u tabeli 
//                     osveziPrikazKategorija();
//                 }, 
//                 // Posto cemo greske uvek isto prihvatati, napravljena je genericka metoda!
//                 error: prikaziGreskeAjax
                
//                 // error: function(greska, status, statusText){
//                 //     console.error('GRESKA UPDATE KATEGORIJE:');
                    
//                 //     console.log(greska.parseJSON);
//                 //     alert(greska.parseJSON.poruka);
//                 // }
//             })      
//         } else {
            
//             // KORAK 5 - INSERT

//             $.ajax({
//                 url: 'models/kategorije/insert.php',
//                 method: 'POST',
//                 data: {
//                     naziv: $("#naziv").val()
//                 },
//                 dataType: 'json',
//                 success: function(podaci, status, ceoZahtev){
//                     console.warn('USPESNO SACUVANO');

//                     if(ceoZahtev.status == 201){
//                         // Citanje iz JSON koji smo vratiti sa PHP strane - Pogledati CONSOLE
//                         console.log('Poruka iz JSON: ' + podaci.uspeh);
//                     }
//                     // Ciscenje forme
//                     clearForm();

//                     // Ponovni prikaz kategorija iz baze u tabeli 
//                     osveziPrikazKategorija();
//                 }, 
//                 error: prikaziGreskeAjax
//             })      
//         }
//     });

//     // KORAK 6 - DELETE
//     $(document).on('click', '.delete-kategorija', function(e){
//         e.preventDefault();
//         let id = $(this).data('id');

//         $.ajax({
//             url: 'models/kategorije/delete.php',
//             method: 'GET',
//             data: {
//                 id: id
//             },
//             dataType: 'json',
//             success: function(podaci, status, ceoZahtev){
//                 console.warn('USPESNO OBRISANO');
//                 // Ponovni prikaz kategorija iz baze u tabeli 
//                 osveziPrikazKategorija();
//             }, 
//             error: prikaziGreskeAjax
//         })
//     })
// });


// function fillForm(kategorija){
//     $("#hdnId").val(kategorija.id);
//     $("#naziv").val(kategorija.name);
//     $("#forma-naslov").html("Izmeni kategoriju");
// }

// function clearForm(){
//     $('#hdnId').val('');
//     $("#naziv").val('');
//     $("#forma-naslov").html("Dodaj kategoriju");
// }


// function osveziPrikazKategorija(){
    
//     // KORAK 4 - Osvezenje prikaza kategorija

//     $.ajax({
//         url: 'models/kategorije/get-all.php',
//         method: 'GET',
//         dataType: 'json',
//         success: function(podaci, status, ceoZahtev){
//             printCategories(podaci);
//         }, 
//         error: prikaziGreskeAjax
//     })
// }

// function printCategories(kategorije){
//     let html = "", rb = 1;
//     for(let kategorija of kategorije){
//         html += printCategory(kategorija, rb);
//         rb++;
//     }
//     $("#kategorije").html(html);
// }

// function printCategory(kategorija, rb){
//     return `<tr>
//     <td>${ rb }</td>
//     <td>${ kategorija.name }</td>
//     <td>
//       <a href="#" class="update-kategorija" data-id="${ kategorija.id }">Izmeni</a>
//     </td>
//     <td>
//       <a href="#" class="delete-kategorija" data-id="${ kategorija.id }">Obrisi</a>
//     </td>
//   </tr>`;
// }

// function prikaziGreskeAjax(greska, status, statusText){
//     console.error('GRESKA AJAX: ');
//     console.log(status);
//     console.log(statusText);
//     if(greska.status == 500){
//         console.log(greska.parseJSON);
//         alert(greska.parseJSON.poruka);
//     }
//     else if(greska.status == 400){
//         alert('Niste poslali ispravno parametre!')
//     }
// }


let registerForm = document.getElementById('register-form');

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
                console.log(response);
                console.log(1);
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
