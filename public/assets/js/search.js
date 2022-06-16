$(document).ready(function(){
  $("#nomInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tableSorties tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

function filterRows() {
  var from = $('#dateDebut').val();
  var to = $('#dateCloture').val();

  if (!from && !to) { // no value for from and to
    return;
  }

  from = from || '1970-01-01'; // default from to a old date if it is not set
  to = to || '2999-12-31';

  var dateFrom = moment(from);
  var dateTo = moment(to);

  $('#tableSorties tr').each(function(i, tr) {
    var val = $(tr).find("td:nth-child(3)").text();
    var dateVal = moment(val, "DD/MM/YYYY");
    var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
    $(tr).css('display', visible);
  });
}

$('#dateDebut').on("change", filterRows);
$('#dateCloture').on("change", filterRows);