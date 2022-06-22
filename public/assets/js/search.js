$('#nomInput').keyup(function(){
  var search = $(this).val();

  $('table tbody tr').hide();
  var len = $('table tbody tr:not(.notfound) td:nth-child(1):contains("'+search+'")').length;

  if(len > 0){
    $('table tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
      $(this).closest('tr').show();
    });
  }else{
    $('.notfound').show();
  }
});

$.expr[":"].contains = $.expr.createPseudo(function(arg) {
  return function( elem ) {
    return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
  };
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

  $('#tableSorties tbody tr').each(function(i, tr) {
    var val = $(tr).find("td:nth-child(2)").text();
    var dateVal = moment(val, "DD/MM/YYYY");
    var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
    $(tr).css('display', visible);
  });
}

$('#dateDebut').on("change", filterRows);
$('#dateCloture').on("change", filterRows);