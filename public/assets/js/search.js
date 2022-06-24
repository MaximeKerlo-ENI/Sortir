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

// Recherche etat Passée
$(function() {
  $('input[type="checkbox"]').change(function() {
    // We check if one or more checkboxes are selected
    // If one or more is selected, we perform filtering
    if($('input[type="checkbox"]:checked').length > 0) {
      // Get values all checked boxes
      var vals = $('input[type="checkbox"]:checked').map(function() {
        return this.value;
      }).get();

      // Here we do two things to table rows
      // 1. We hide all
      // 2. Then we filter, show those whose value in first <td> matches checkbox value
      $('table tbody tr').hide().filter(function() {
        return vals.indexOf($(this).find('td:nth-child(5)').text()) > -1;
      }).show();
    } else {
      // Show all
      $('table tbody tr').show();
    }
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

  $('#tableSorties tbody tr').each(function(i, tr) {
    var val = $(tr).find("td:nth-child(2)").text();
    var dateVal = moment(val, "DD/MM/YYYY");
    var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
    $(tr).css('display', visible);
  });
}

$('#dateDebut').on("change", filterRows);
$('#dateCloture').on("change", filterRows);

$('#siteInput').change(function() {
  var curr = $(this).val();
  $("#tableSorties tbody tr td:nth-child()").each(function(){
      if(curr.indexOf($(this).text().substr(0,1)) != -1){  //Check if first letter exists in the drop down value
           $(this).parent().show();

      }else{
           $(this).parent().hide();
      }
  });

});