// let select_ville = document.getElementById("select_ville");

// function returnLieux(event) {
//   event.preventDefault();
//   const url = "https://127.0.0.1:8000/api/" + select_ville.value;
//   console.log(url);
//   axios.get(url).then(function (response) {
//     let data = response.data;
//     console.log(data);

//     select = document.getElementById("select_lieu");
//     select.innerHTML = "";

//     for (let i = 0; i < data.length; i++) {
//       option = document.createElement("option");
//       option.setAttribute("value",data[i].noLieu);
//       option.innerHTML = data[i].nomLieu;
//       select.appendChild(option);
//     }
//     console.log(select);
//   });
// }

// select_ville.addEventListener("change", returnLieux);

// document.addEventListener("DOMContentLoaded", function () {
//   let elems = document.querySelectorAll("select");
//   let instances = M.FormSelect.init(elems, options);
// });

let select_lieu = document.getElementById("select_lieu");

function detailsLieu(event){
  event.preventDefault();
  const url = "https://127.0.0.1:8000/api/details/" + select_lieu.value;
  axios.get(url).then(function(response){
    let data = response.data;
    console.log(data);
    rueElement = document.getElementById("maDiv5");
    rueElement.innerHTML = "<label for=''>Rue : </label>"+data.rue;
    console.log(rueElement);
    codePostalElement = document.getElementById("maDiv6");
    codePostalElement.innerHTML = "<label for='maDiv6'>Code postal : </label>"+data.villesNoVille.codePostal;
    latitudeElement = document.getElementById("maDiv7");
    latitudeElement.innerHTML = "<label for='maDiv7'>Latitude : </label>"+data.latitude;
    longitudeElement = document.getElementById("maDiv8");
    longitudeElement.innerHTML = "<label for='maDiv8'>Longitude : </label>"+data.longitude;
  })
}

select_lieu.addEventListener("change", detailsLieu);
