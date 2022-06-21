let $select_ville = document.getElementById("select_ville")
function returnLieux(event) {
    event.preventDefault()
    const url = 'http://127.0.0.1:8000/api/' + $select_ville.value
    console.log(url)
    axios.get(url).then(function (response) {
        $liste_lieux = response.data
        console.log($liste_lieux)
        $select = '<select id="select_lieu" name="sorties[lieuxNolieu]">'
        for (let index = 0; index < $liste_lieux.length; index++) {
            $select += '<option value="' + $liste_lieux[index].noLieu + '">' + $liste_lieux[index].nomLieu + '</option>'
        }
        $select+='</select>'
    document.getElementById('select_lieu').innerHTML = $select
    console.log("Nom : " + response.data[0].nom)
})
}
$select_ville.addEventListener("change", returnLieux)