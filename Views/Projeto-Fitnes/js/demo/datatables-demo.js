// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable({
    "bJQueryUI": true,
    "oLanguage": {
      "sProcessing": "Processando...",
      "sLengthMenu": "Mostrar MENU registros",
      "sZeroRecords": "Não foram encontrados resultados",
      "sInfo": "Mostrando de START até END de TOTAL registros",
      "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
      "sInfoFiltered": "",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "oPaginate": {
        "sFirst": "Primeiro",
        "sPrevious": "Anterior",
        "sNext": "Seguinte",
        "sLast": "Último"
      }
    }
  });
});