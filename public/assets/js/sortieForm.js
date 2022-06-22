let $select_ville = document.getElementById("select_ville");

$select_ville.addEventListener("change", returnLieux);

function returnLieux(event) {
  event.preventDefault();
  const url = "https://127.0.0.1:8000/api/" + $select_ville.value;
  console.log(url);
  axios.get(url).then(function (response) {

    let data = response.data;
    let selectLieu = document.getElementById("select_lieu");

    for (i = 0; i < data.length; i++) {
        console.log(data[i].nomLieu);
        var optionLieu = document.createElement("option");
        optionLieu.innerHTML = data[i].nomLieu;
        optionLieu.value = data[i].noLieu;
        console.log(optionLieu);
        selectLieu+=optionLieu;
    }
    selectLieu+="</select>";
    console.log(selectLieu);

    // for (const element of response.data) {
    //   //console.log(element.nomLieu);
    //   optionLieu.innerHTML = element.nomLieu;
    //   optionLieu.value = element.noLieu;
    //   //console.log(optionLieu);
    //   selectLieu.appendChild(optionLieu);
    // }

    //console.log(selectLieu);

    document.getElementById("resultat").innerText = response.data[0].nomLieu;
  });
}
