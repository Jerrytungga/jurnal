// Call the dataTables jQuery plugin

$(document).ready(function() {
  $('#dataTable').DataTable( {
      scrollY : 500,
      scrollX : true,
      scrollCollapse: true,
      paging: true
  } );
} );

