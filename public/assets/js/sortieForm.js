let ville = document.createElement("p");
let villeNom = document.getElementById("select_ville");

villeNom.addEventListener('change', (event)=>{
    ville.textContent = `${event.target.value}`;
    console.log(ville);
})


// let lieu = document.createElement("p");
// let lieuNom = document.getElementById("selelct_lieu");

// lieuNom.addEventListener('change', (event)=>{
//     lieu.textContent= `${event.target.value}`;
//     console.log(lieu);
// }
// )



// let selectElement = document.querySelector('#sortie_lieuNolieu');

// // let nomElement = selectElement.getAttribute('option');

// console.log(selectElement);

// // console.log(nomElement);

// console.log("On veut voir le résultat");

// selectElement.addEventListener('change', (event) => {

//     console.log("Petit flag");

//     let result = document.querySelector('#result');

//     result.textContent = `${event.target.value}`;

//     console.log(result);

// });